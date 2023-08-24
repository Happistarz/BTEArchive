<?php
require('controllers/RelationPB.php');
require('controllers/Projet.php');
require('models/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['tag'])) {

    $tag = $_GET['tag'];
    $sort = $_GET['sort'];

    $sql = "SELECT p.*,(SELECT COUNT(*) FROM " . RELATIONPB_TABLE . " rp WHERE rp.IDPROJET = p.ID) AS NB_BUILDEURS FROM " . PROJET_TABLE . " p";
    switch ($tag) {
      case 'TOUT':
        break;
      case 'ETAT':
        $sql .= " ORDER BY ETAT " . $sort;
        break;
      case 'TYPE':
        $sql .= " ORDER BY TYPE " . $sort;
        break;
      case 'DEPARTEMENT':
        $sql .= " ORDER BY CODEDEP " . $sort;
        break;
      case 'NOMBRE DE BUILDEURS':
        $sql .= " ORDER BY NB_BUILDEURS " . $sort;
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
      <p>" . $resu['CODEDEP'] . " " . convertDEP($resu['CODEDEP']) . "</p>
      <p>👷‍♂️" . $resu['NB_BUILDEURS'] . "</p>
      </div>
      </a>";
      }
      $nextbutton = "<button class=\\\"next\\\" onclick=\\\"next()\\\">V</button>";
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