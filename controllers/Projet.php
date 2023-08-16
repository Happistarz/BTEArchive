<?php

require ("models/Database.php");

define('PROJET_TABLE','PROJET');

class Projet extends Connexion {
    private $id;
    private $nom;
    private $desc;
    private $type;
    private $coords;
    private $departement;
    private $etat;
    private $date;
    public function __construct($nom,$desc,$type,$coords,$departement,$etat,$date) {
        parent::__construct();
        $this->nom = $nom;
        $this->desc = $desc;
        $this->ype = $type;
        $this->coords = $coords;
        $this->departement = $departement;
        $this->etat = $etat;
        $this->date = $date;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getDesc() : string {
        return $this->desc;
    }

    public function getCoords() : string {
        return $this->coords;
    }

    public function getType() : int {
        return $this->type;
    }

    public function getDep() : string {
        return $this->departement;
    }

    public function getEtat() : int {
        return $this->etat;
    }

    public function getDate() {
        return $this->date;
    }

    public function insert() {
        $this->id =  $this->db->create(PROJET_TABLE, array(
            NOM=>$this->name,
            DESC=>$this->desc,
            TYPE=$this->type,
            COORDS=>$this->coords,
            CODEP=>$this->departement,
            ETAT=>$this->etat,
            DATE=>$this->date
        ));
        return $this->id;
    }
    public function delete() {
        return $this->db->delete(PROJET_TABLE,array(ID=>$this->id));
    }

    public function update() {
        return $this->db->update(PROJET_TABLE,array(
            NOM=>$this->name,
            DESC=>$this->desc,
            TYPE=$this->type,
            COORDS=>$this->coords,
            CODEP=>$this->departement,
            ETAT=>$this->etat,
            DATE=>$this->date
        ), array(ID=>$this->id));
    }

    public function countProjects() : int {
        return $this->db->count(PROJET_TABLE);
    }
}
?>