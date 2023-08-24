<?php require('models/Database.php');
require_once('models/functions.php');
require_once('controllers/RelationPB.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php require('vue/loader.php');
  require('vue/header.php');

  $l = new Connexion();
  $search = $_GET['search'];
  // search peut etre un code de dep donc il a des exceptions comme: 2A, 2B, 971, 972, 973, 974, 976
  if (strlen($search) == 2 || (strlen($search) == 3 && is_numeric($search))) {
    // DEP CODE
    $projets = $l->read(PROJET_TABLE, array("CODEDEP LIKE '%$search%'"));
  } else if (strlen($search) == 5) {
    // INSEE CODE
    $projets = $l->read(COMMUNE_TABLE, array("INSEE LIKE '%$search%'"));
  } else {
    // NOM
    $projets = $l->read(PROJET_TABLE, array("NOM LIKE '%$search%'"));
  }


  ?>
  <main class="listemain">
    <?php
    $doc = [];
    if (sizeof($projets) == 0) {
      $doc[] = "<h1>Aucun projet trouvé</h1>";
    } else {

      foreach ($projets as $projet) {
        $warps = $l->count("WARPS", "idPROJET", $projet['ID']);
        $builders = count(RelationPB::getAllProjectBuilders($projet['ID']));
        $doc[] = "
          <a href='view?p=" . $projet["ID"] . "' class=\"searchcard\">
            <img src=\"src/voulon.png\" alt=\"\">
            <div class=\"text\">
              <h1>" . $projet['NOM'] . "   <i class='compact-item'><strong>" . convertDEP($projet['CODEDEP']) . "</strong></i> • <i class='compact-item'>" . ETAT[$projet['ETAT']] . "</i></h1>
              <p>" . convertDESC($projet['DESCRI'], 200) . "</p>
              <div style='display:flex;flex-direction:row;width:100%;gap:20px'>
                <p class='PROJET-TAG'>Warps: $warps</p>
                <p class='PROJET-TAG'>Builders: $builders</p>
              </div>
            </div>
          </a>";
      }
    }
    echo join(getSeparator(), $doc)
      ?>
  </main>
</body>

</html>