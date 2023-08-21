<?php
require("controllers/Projet.php");
require("controllers/Builder.php");
require('controllers/RelationPB.php');
require('models/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  require('vue/loader.php');
  require('vue/header.php');

  if (isset($_GET['p'])) {
    $id = $_GET['p'];

    $db = new Connexion();
    $res = $db->read(PROJET_TABLE, array("ID = $id"));

    if ($res) {
      $projet = new Projet($res[0]["NOM"], $res[0]["DESCRI"], $res[0]["TYPE"], $res[0]["COORDS"], $res[0]['CODEDEP'], $res[0]["ETAT"], $res[0]['URLBANNER'], $res[0]['SRCIMG'], $res[0]["DATE"]);
      $builders = RelationPB::getAllProjectBuilders($id);
      foreach ($builders as $builder) {
        $builder = new Builder($builder[$i]["NOM"], $builder[$i]["ICONURL"], $builder[$i]["ID"]);
      }
      echo "<main class='listemain'><h1>" . $projet->getnom() . "</h1>";
      echo convertGEO($projet->getDep());
      // convertGEO($res[0]["CODEDEP"]);
    } else {
      echo "<main class='listemain'><h1> Pas de projet trouvé </h1></main>";
    }
  } else {
    echo "<main class='listemain'><h1> Pas de projet trouvé </h1></main>";
  }



  ?>

</body>

</html>