<?php

require_once('models/Database.php');


class Warp extends Connexion
{
    private $id;
    private $name;
    private $idprojet;
    private $coords;

    public function __construct($name, $idprojet, $coords, $id = null)
    {
        parent::__construct();
        $this->name = $name;
        $this->idprojet = $idprojet;
        $this->coords = $coords;
        $this->id = $id;
        parent::__construct();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIDProjet(): int
    {
        return $this->idprojet;
    }
    public function getCoords(): string
    {
        return $this->coords;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function insertWarp()
    {
        return parent::create(
            WARP_TABLE,
            array(
                "NOM" => $this->name,
                "IDPROJET" => $this->idprojet,
                "COORDS" => $this->coords
            )
        );
    }

    public function deleteWarp()
    {
        return parent::delete(WARP_TABLE, array("ID" => $this->id));
    }

    public function updateWarp()
    {
        return parent::update(WARP_TABLE, array(
            "NOM" => $this->name,
            "IDPROJEt" => $this->idprojet,
            "COORDS" => $this->coords
        ), array("ID" => $this->id));
    }

    public function countWarps($idprojet): int
    {
        return parent::count(WARP_TABLE, "IDPROJET", $idprojet);
    }
}

?>