<?php
require("controllers/Projet.php");
require("controllers/Builder.php");
require('controllers/RelationPB.php');
require('models/functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>

<body>
  <?php

  if (isset($_GET['p'])) {
    $id = $_GET['p'];

    $db = new Connexion();
    $res = $db->read(PROJET_TABLE, array("ID = $id"));

    if ($res) {
      $projet = new Projet($res[0]["NOM"], $res[0]["DESCRI"], $res[0]["TYPE"], $res[0]["COORDS"], $res[0]['CODEDEP'], $res[0]["ETAT"], $res[0]['URLBANNER'], $res[0]['SRCIMG'], $res[0]["DATE"]);
    } else {
      echo "<main class='listemain'><h1> Pas de projet trouvé </h1></main>";
      die();
    }

    //     // if ($res) {
//     //   $projet = new Projet($res[0]["NOM"], $res[0]["DESCRI"], $res[0]["TYPE"], $res[0]["COORDS"], $res[0]['CODEDEP'], $res[0]["ETAT"], $res[0]['URLBANNER'], $res[0]['SRCIMG'], $res[0]["DATE"]);
//     //   $builders = RelationPB::getAllProjectBuilders($id);
//     //   foreach ($builders as $builder) {
//     //     $builder = new Builder($builder[$i]["NOM"], $builder[$i]["ICONURL"], $builder[$i]["ID"]);
//     //   }
//     //   echo "<main class='listemain'><h1>" . $projet->getnom() . "</h1>";
//     //   echo convertGEO($projet->getDep());
//     //   // convertGEO($res[0]["CODEDEP"]);
//     // } else {
//     //   echo "<main class='listemain'><h1> Pas de projet trouvé </h1></main>";
//     // }
//   } else {
//     echo "<main class='listemain'><h1> Pas de projet trouvé </h1></main>";
  }


  require('vue/loader.php');
  require('vue/header.php');
  ?>
  <div class="mainproj">
    <!-- <h1 >Anché</h1> -->
    <div class="content">

      <div class="col">
        <div class="row">
          <div class="projet">
            <img src="<?php echo convertGEO($projet->getDep()); ?>" alt="" class="logodep" width="200" heigth="200">
            <div class="infoproj">
              <h1 class="title">
                <?php echo $projet->getnom(); ?>
              </h1>
              <h4>
                <?php echo $projet->getDep() . " " . convertDEP($projet->getDep()); ?>
              </h4>
            </div>
          </div>
          <p class='descri'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora velit architecto nostrum
            veniam, distinctio, vero tenetur doloremque nihil beatae facilis quas delectus laborum eos, tempore
            necessitatibus sapiente totam voluptatibus? Est!</p>
        </div>
        <div class="row frame">
          <div style='width:542px;height:375px;background:yellow;border-radius:1.625rem'></div>
          <!-- <iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
            sandbox="allow-forms allow-scripts allow-same-origin"
            src="https://www.geoportail.gouv.fr/embed/visu.html?c=<?php //echo $projet->getCoords(); ?>&z=16&v0=PLAN.IGN::GEOPORTAIL:GPP:TMS(1;s:classique)&l1=GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2::GEOPORTAIL:OGC:WMTS(0.87)&permalink=yes"
            allowfullscreen></iframe> -->
          <!-- A REPLACE PAR L'IFRAME -->
        </div>
      </div>
      <div class="warps-container">
        <h1>Warps</h1>
        <div class="warps">
          <h3 class="libelle">/warp Loudun</h3>
        </div>
        <div class="warp">
          <h3 class="libelle">/warp Loudun:Eglise</h3>
        </div>
      </div>
    </div>
  </div>

</body>

</html>