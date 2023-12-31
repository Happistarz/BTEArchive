<?php
require_once('models/Database.php');


class Liste extends Connexion
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getProjets($condition = null)
  {
    $res = $this->read("PROJET", array($condition));
    return $res;
  }
  public function getProjetsByRegion($region)
  {
    $condition = array("REGION = '$region'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByEtat($etat)
  {
    $condition = array("ETAT = '$etat'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByRegionEtat($region, $etat)
  {
    $condition = array("REGION = '$region' AND ETAT = '$etat'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByRegionEtatNom($region, $etat, $nom)
  {
    $condition = array("REGION = '$region' AND ETAT = '$etat' AND NOM LIKE '%$nom%'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByRegionNom($region, $nom)
  {
    $condition = array("REGION = '$region' AND NOM LIKE '%$nom%'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByEtatNom($etat, $nom)
  {
    $condition = array("ETAT = '$etat' AND NOM LIKE '%$nom%'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
  public function getProjetsByNom($nom)
  {
    $condition = array("NOM LIKE '%$nom%'");
    $res = $this->read("PROJET", $condition, "DATE DESC");
    return $res;
  }
}

?>