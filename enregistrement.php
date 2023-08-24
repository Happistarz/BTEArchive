<?php
require "controllers/Projet.php";
require "controllers/Builder.php";
require "controllers/Warp.php";
require "controllers/RelationPB.php";

define(
  "PROJET_TYPE",
  array(
    'COMMUNE' => 0,
    'MONUMENT' => 1,
    'WARP' => 2
  )
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['REQUEST'])) {

    $nom = htmlspecialchars($_POST['nom']);
    $desc = htmlspecialchars($_POST['desc']);
    $etat = htmlspecialchars($_POST['etat']);
    $warp = htmlspecialchars($_POST['warp']);
    $codep = htmlspecialchars($_POST['dep']);
    $bannerimg = $_FILES['bannerimg'];
    $srcimg = htmlspecialchars($_POST['urlimg']);
    $type = PROJET_TYPE[$_POST['type']];

    //// cURL SESSION

    $curl = curl_init("https://geo.api.gouv.fr/communes?nom=$nom+$codep&fields=code,nom,mairie,centre,siren,codeDepartement,departement,codeRegion,codesPostaux,population,region");

    # Set options on the session
    curl_setopt_array($curl, [
      CURLOPT_CAINFO => dirname(__FILE__) . '/geo_cert.crt',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT_MS => 2000
    ]);

    # exec the session and get the results
    $data = curl_exec($curl);
    if ($data === false) {
      var_dump(curl_error($curl));
    } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
      # decode the json string to an object
      $data = json_decode($data, true);
      // print_r($data);
    } else {
      var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
    }

    # close the session
    curl_close($curl);
    // var_dump($data);
    $coords = $data[0]['centre']['coordinates'][0] . "," . $data[0]['centre']['coordinates'][1];
    $codedep = $data[0]['codeDepartement'];

    //////// CREER UNE NOUVELLE TABLE QUI CONTIENT: 
    /*RelationPB:
    ID
    IDPROJET
      IDBUILDEUR
      
    permet de joindre une relation N:N 
    pour x builder-> x projet
    pour x projet-> x builder
    */

    //// CREATION DU PROJET
    $srcbanner = "banner/banner_" . strtolower($nom) . "_$codep.png";
    $projet = new Projet($nom, $desc, $coords, $type, $codedep, $etat, $srcbanner, $srcimg, date("Y-m-d"));
    try {
      $idP = $projet->insertProject();
      echo '{"success": true, "id": "' . $idP . '"}';
    } catch (Exception $e) {
      echo '{"success":false, "error": "' . $e->getMessage() . '"}';
      die();
    }

    //// CREATION DU WARP

    $warp = new Warp($warp, $idP, $coords);
    $warp->insertWarp();

    //// CREATION DES BUILDERS

    for ($i = 0; $i < count($_POST); $i++) {
      if (isset($_POST[$i])) {
        $builder = json_decode($_POST[$i], true);
        $BNOM = $builder['buildernom'];
        $BICON = $builder['buildericon'];
        $b = new Builder($BNOM, $BICON);
        $idB = $b->insertBuilder();

        //// CREATION DE LA RELATION
        $r = new RelationPB($idP, $idB);
        $r->insertRelationPB();
      }
    }

    //// CREATION DE LA BANNIERE
    if ($bannerimg['type'] == "image/png") {
      $banner = imagecreatefrompng($bannerimg['tmp_name']);
      $banner = imagescale($banner, 1920, 1080);
      imagepng($banner, $srcbanner);
    } else if ($bannerimg['type'] == "image/jpeg") {
      $banner = imagecreatefromjpeg($bannerimg['tmp_name']);
      $banner = imagescale($banner, 1920, 1080);
      imagejpeg($banner, $srcbanner);
    } else {
      echo '{"success":false, "error": "banner is not a png"}';
      die();
    }

  } else {
    header("Location: index.php");
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['count']) && $_GET['count']) {
    $db = new Connexion();
    $res = $db->exec("SELECT * FROM " . PROJET_TABLE . " ORDER BY RAND() LIMIT 1;");
    echo '{"success": true, "projet": ' . json_encode($res) . '}';
  } else {
    header("Location: index.php");
  }
} else {
  // header("Location: index.php");
}

?>