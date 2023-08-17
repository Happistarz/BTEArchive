<?php
require_once("models/Database.php");

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

  public function insertBuilder(): int
  {
    $builder = parent::read(
      BUILDER_TABLE,
      array(
        "NOM" => $this->name,
      )
    );
    if ($builder) {
      $id = (int) $builder[0]["ID"];
    } else {
      $id = parent::create(
        BUILDER_TABLE,
        array(
          "NOM" => $this->name,
          "ICONURL" => $this->icon,
        )
      );
    }
    return $id;
  }

  public function deleteBuilder()
  {
    return parent::delete(
      BUILDER_TABLE,
      array(
        "ID" => $this->id
      )
    );
  }

  public function updateBuilder()
  {
    return parent::update(
      BUILDER_TABLE,
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