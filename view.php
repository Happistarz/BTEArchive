<?php
// require("controllers/Projet.php");
// require("controllers/Builder.php");
// require('controllers/RelationPB.php');
// require('models/functions.php');
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
//   require('vue/loader.php');
//   require('vue/header.php');

//   if (isset($_GET['p'])) {
//     $id = $_GET['p'];

//     // $db = new Connexion();
//     // $res = $db->read(PROJET_TABLE, array("ID = $id"));

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
//   }



  ?>
  <div class="mainproj">
    <!-- <h1 >Anché</h1> -->
    <div class="content" >

        <div class="col">
            <div class="row">
                <div class="projet">
                    <img src="test1a.jpg" alt="" class="logodep" width="200" heigth="200">
                    <div class="infoproj">
                        <h1 class="title">Anché</h1>
                        <p>86 Vienne</p>
                    </div>
                </div>
                <p class='descri'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora velit architecto nostrum veniam, distinctio, vero tenetur doloremque nihil beatae facilis quas delectus laborum eos, tempore necessitatibus sapiente totam voluptatibus? Est!</p>
            </div>
            <div class="row frame">
                <div style='width:542px;height:375px;background:yellow;border-radius:1.625rem'></div> <!-- A REPLACE PAR L'IFRAME -->
            </div>
        </div>
    </div>
  </div>

</body>

</html>