<?php require('controllers/liste.php');
require('models/functions.php') ?>
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

  $l = new Liste();
  $search = $_GET['search'];
  $projets = $l->getProjets("NOM LIKE '%$search%' OR REGION LIKE '%$search%'");
  ?>
  <main class="listemain">
    <?php
    $doc = [];
    if (sizeof($projets) == 0) {
      $doc[] = "<h1>Aucun projet trouvé</h1>";
    } else {

      foreach ($projets as $projet) {
        $warps = $l->count("WARPS", "idPROJET", $projet['ID']);
        $doc[] = "
      <a href='#' class=\"searchcard\">
        <img src=\"src/voulon.png\" alt=\"\">
        <div class=\"text\">
          <h1>" . $projet['NOM'] . "   <i class='compact-item'><strong>" . $projet['REGION'] . "</strong></i> • <i class='compact-item'>" . ETAT[$projet['ETAT']] . "</i></h1>
          <p>" . convertDESC($projet['DESC'], 200) . "</p>
          <p class='PROJET-TAG'>Warps: $warps</p>
          </div>
          </a>";
      }
    }
    echo join(getSeparator(), $doc)
      ?>
  </main>
</body>

</html>