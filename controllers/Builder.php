<?php
require "models/Database.php";

class Builder extends Connexion
{
  private $id;
  private $name;
  private $icon;

  public function __construct($name, $icon, $id = null)
  {
    parent::__construct();
    $this->name = $name;
    $this->icon = $icon;
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getIcon()
  {
    return $this->icon;
  }

  public function setID($id)
  {
    $this->id = $id;
  }

  public function insertBuilder()
  {
    return parent::create(
      "BUILDEUR",
      array(
        "NOM" => $this->name,
        "ICONURL" => $this->icon
      )
    );
  }

  public function deleteBuilder()
  {
    return parent::delete(
      "BUILDEUR",
      array(
        "ID" => $this->id
      )
    );
  }

  public function updateBuilder()
  {
    return parent::update(
      "BUILDEUR",
      array(
        "NOM" => $this->name,
        "ICONURL" => $this->icon
      ),
      array(
        "ID" => $this->id
      )
    );
  }
}
?>