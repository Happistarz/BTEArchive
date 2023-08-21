<?php
require('controllers/RelationPB.php');
require('controllers/Projet.php');
require('models/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['tag'])) {

    $tag = $_GET['tag'];

    $sql = "SELECT * FROM " . PROJET_TABLE;
    switch ($tag) {
      case 'TOUT':
        break;
      case 'ETAT':
        $sql .= " ORDER BY ETAT DESC";
        break;
      case 'TYPE':
        $sql .= " ORDER BY TYPE DESC";
        break;
      case 'DEPARTEMENT':
        $sql .= " ORDER BY CODEDEP DESC";
        break;
      case 'NOMBRE DE BUILDEURS':
        $sql .= " ORDER BY NB_BUILDEURS DESC";
        break;
      default:
        break;
    }
    $sql .= " LIMIT " . $_GET['limit'] . " OFFSET " . $_GET['start'] . ";";
    // echo $sql;
    $db = new Connexion();
    $res = $db->query($sql);

    $card = [];

    if (count($res) > 0) {

      foreach ($res as $resu) {
        $card[] = "    
      <a class=\"card\" href='view.php?p=" . $resu['ID'] . "'>
      <div class=\"card-header\">
      <h1>" . $resu['NOM'] . "</h1>
      </div>
      <div class=\"card-main\">
      <img src=\"src/voulon.png\" alt=\"\" loading='lazy'>
      <h4>" . convertDESC($resu['DESCRI'], 115) . "</h4>
      </div>
      <div class=\"card-footer\">
      <p>" . ETAT[$resu['ETAT']] . "</p>
      <p>" . $resu['CODEDEP'] . " " . convertDEP((int) $resu['CODEDEP']) . "</p>
      <p>👷‍♂️" . count(RelationPB::getAllProjectBuilders($resu['ID'])) . "</p>
      </div>
      </a>";
      }
      $nextbutton = "<button class=\"next\" onclick=\"next()\">Suivant</button>";
      echo '{"success": true, "card": ' . json_encode($card) . ', "nextbutton": "' . $nextbutton . '"}';
    } else {
      echo '{"success": false, "error": "no project found"}';
    }
  } else {
    echo '{"success": false, "error": "tag not found"}';
  }
} else {
  header("Location: index.php");
}

?>