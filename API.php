<?php
require('controllers/RelationPB.php');
require('controllers/Warp.php');
if (isset($_GET['nom']) && isset($_GET['codedep'])) {
    if (isset($_GET['type'])) {
        $type = strtoupper($_GET['type']);
    } else {
        $type = "COMMUNE";
    }
    $nom = $_GET['nom'];
    $codedep = $_GET['codedep'];

    $json = array();
    $conn = new Connexion();
    $res = $conn->read("PROJET", array("NOM = '$nom'", "CODEDEP = '$codedep'", "TYPE = '$type'"))[0];
    $builer_ct = count(RelationPB::getAllProjectBuilders($res['ID']));
    $warp_ct = $conn->count("WARPS", "IDPROJET", $res['ID']);
    if ($res) {
        $json['NOM'] = $res['NOM'];
        $json['CODEDEP'] = $res['CODEDEP'];
        $json['DESCRI'] = $res['DESCRI'];
        switch ($type) {
            case 'COMMUNE':
                $json['TYPE'] = array(
                    "TYPE" => "COMMUNE",
                    "DEPARTEMENT" => $res['DEPARTEMENT'],
                    "REGION" => $res['REGION'],
                    "POPULATION" => $res['POPULATION'],
                );
                break;
            case 'MONUMENT':
                $json['TYPE'] = array(
                    "TYPE" => "MONUMENT",
                    "DEPARTEMENT" => $res['DEPARTEMENT'],
                    "REGION" => $res['REGION']
                );
                break;
            case 'WARP':
                $json['TYPE'] = array(
                    "TYPE" => "WARP",
                    "DEPARTEMENT" => $res['DEPARTEMENT'],
                    "REGION" => $res['REGION']
                );
                break;
            default:
                # code...
                break;
        }
        $json['COORDS'] = $res['COORDS'];
        $json['BANNER'] = $res['URLBANNER'];
        $json['URLIMG'] = $res['SRCIMG'];
        $json['BUILDER_COUNT'] = $builer_ct;
        $json['WARP_COUNT'] = $warp_ct;
    } else {
        $json['error'] = "Pas de résultat";
    }

    header('Content-Type: application/json');
    echo json_encode($json);
} else {
    http_response_code(400); // Bad request
    echo json_encode(array("error" => "Paramètres invalides"));
}
/*
Ex JSON REPLY:
{
    "NOM":"Anché",
    "CODEDEP":"86",
    "DESCRI": " Anché est une commune du Centre-Ouest de la France",
    "TYPE": {
        "TYPE":"Commune",
        "DEPARTEMENT":"Vienne",
        "REGION":"Nouvelle-Aquitaine",
        "POPULATION":"500",
    }
    "COORDS":"46.8667,0.1333",
    "BANNER":"https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Blason_ville_fr_Anch%C3%A9_%2886%29.svg/1200px-Blason_ville_fr_Anch%C3%A9_%2886%29.svg.png",
    "URLIMG":" https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Blason_ville_fr_Anch%C3%A9_%2886%29.svg/1200px-Blason_ville_fr_Anch%C3%A9_%2886%29.svg.png",
    "BUILDER_COUNT": 2,
    "WARP_COUNT": 3,
}
*/
?>