<?php

require_once("models/Database.php");

class RelationPB extends Connexion
{
  private $id;
  private $idProjet;
  private $idBuilder;

  public function __construct($idProjet, $idBuilder)
  {
    parent::__construct();
    $this->idProjet = $idProjet;
    $this->idBuilder = $idBuilder;
  }

  public function getIDProjet()
  {
    return $this->idProjet;
  }

  public function getIDBuilder()
  {
    return $this->idBuilder;
  }

  public function insertRelationPB()
  {
    $relationPB = parent::read(
      RELATIONPB_TABLE,
      array(
        "ID" => $this->id,
        "IDPROJET" => $this->idProjet,
        "IDBUILDEUR" => $this->idBuilder
      )
    );
    if ($relationPB) {
      $id = $relationPB[0]["ID"];
    } else {
      $id = parent::create(
        RELATIONPB_TABLE,
        array(
          "IDPROJET" => $this->idProjet,
          "IDBUILDEUR" => $this->idBuilder,
          "ID" => $this->id
        )
      );
    }
    return $id;
  }

  public function deleteRelationPB()
  {
    return parent::delete(
      RELATIONPB_TABLE,
      array(
        "ID" => $this->id
      )
    );
  }

  public function updateRelationPB()
  {
    return parent::update(
      RELATIONPB_TABLE,
      array(
        "IDPROJET" => $this->idProjet,
        "IDBUILDEUR" => $this->idBuilder
      ),
      array(
        "ID" => $this->id
      )
    );
  }

  public function selectRelationPB()
  {
    return parent::read(
      RELATIONPB_TABLE,
      array(
        "ID" => $this->id
      )
    );
  }

  public function selectAllRelationPB()
  {
    return parent::read(
      RELATIONPB_TABLE
    );
  }
}

?>