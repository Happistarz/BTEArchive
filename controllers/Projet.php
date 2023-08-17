<?php

require_once("models/Database.php");



class Projet extends Connexion
{
    private $id;
    private $nom;
    private $desc;
    private $type;
    private $coords;
    private $departement;
    private $etat;
    private $date;
    public function __construct($nom, $desc, $type, $coords, $departement, $etat, $date, $id = null)
    {
        parent::__construct();
        $this->nom = $nom;
        $this->desc = $desc;
        $this->type = $type;
        $this->coords = $coords;
        $this->departement = $departement;
        $this->etat = $etat;
        $this->date = $date;
        $this->id = $id;
    }

    public function getnom(): string
    {
        return $this->nom;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getCoords(): string
    {
        return $this->coords;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getDep(): string
    {
        return $this->departement;
    }

    public function getEtat(): int
    {
        return $this->etat;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function insertProject()
    {
        $this->id = parent::create(
            PROJET_TABLE,
            array(
                "NOM" => $this->nom,
                "DESCRI" => $this->desc,
                "TYPE" => $this->type,
                "COORDS" => $this->coords,
                "DEPARTEMENT" => $this->departement,
                "ETAT" => $this->etat,
                "DATE" => $this->date
            )
        );
        return $this->id;
    }
    public function deleteProject()
    {
        return parent::delete(PROJET_TABLE, array("ID" => $this->id));
    }

    public function updateProject()
    {
        return parent::update(PROJET_TABLE, array(
            "NOM" => $this->nom,
            "DESC" => $this->desc,
            "TYPE" => $this->type,
            "COORDS" => $this->coords,
            "CODEP" => $this->departement,
            "ETAT" => $this->etat,
            "DATE" => $this->date
        ), array("ID" => $this->id));
    }

    public function countProjects(): int
    {
        return parent::count(PROJET_TABLE);
    }
}
?>