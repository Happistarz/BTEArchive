<?php
require "controllers/Projet.php";
require "cotrollers/Builder.php";
require "controllers/Warp.php";
define(
  "PROJET_TYPE",
  array(
    'COMMUNE' => 0,
    'PROJET' => 1,
    'WARP' => 2
  )
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $nom = htmlspecialchars($_POST['nom']);
  $desc = htmlspecialchars($_POST['desc']);
  $etat = htmlspecialchars($_POST['etat']);
  $warp = htmlspecialchars($_POST['warp']);
  $type = PROJET_TYPE[$_POST['type']];

  //// cURL SESSION

  $curl = curl_init("https://geo.api.gouv.fr/communes?nom=Poitiers&fields=code,nom,mairie,centre,siren,codeDepartement,departement,codeRegion,codesPostaux,population,region");

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
  var_dump($data);
  $coords = $data[0]['centre']['coordinates'][0] . "," . $data[0]['centre']['coordinates'][1];
  $deparement = $data[0]['codeDepartement'];

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

  $projet = new Projet($nom, $desc, $type, $coords, $deparement, $etat, date("Y-m-d"));
  $id = $projet->insertProject();

  //// CREATION DU WARP

  $warp = new Warp($id,$warp,$coords);
  $warp->insertWarp();

  //// CREATION DES BUILDERS

  for ($i = 0; $i < count($_POST); $i++) {
    if (isset($_POST[$i])) {
      $builder = json_decode($_POST[$i], true);
      $BNOM = $builder['buildernom'];
      $BICON = $builder['buildericon'];
      $b = new Builder($BNOM, $BICON, $id);
      $b->insertBuilder();
      // $sql = "INSERT INTO `BUILDER` (`idproject`, `nom`, `icon`) VALUES ($id, '$BNOM', '$BICON')";
      // echo $sql;
    }
  }


  echo '{success: true}';
  echo '{success:false}';

  // header("Location: view.php?id=$name");
  // header("Location: index.php");
}
?>