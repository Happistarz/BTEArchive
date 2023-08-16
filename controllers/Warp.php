<?php

require ('models/Database.php');

define('WARP_TABLE',"WARPS");

class Warp extends Connexion {
    private $id;
    private $name;
    private $idprojet;
    private $coords;

    public function __construct() {
        parent::__construct();
    }

    public function getName() : string {
        return $this->name;
    }

    public function getIDProjet() : int {
        return $this->idprojet;
    }
    public function getCoords() : string {
        return $this->coords;
    }

    public function insert() {
        return $this->db->create(WARP_TABLE,array(
            NOM=>$this->name,
            IDPROJET=>$this->idprojet,
            COORDS=>$this->coords
        ));
    }

    public function delete() {
        return $this->db->delete(WARP_TABLE,array(ID=>$this->id));
    }

    public function update() {
        return $this->db->update(WARP_TABLE, array(
            NOM=>$this->name,
            IDPROJEt=>$this->idprojet,
            COORDS=>$this->coords
        ), array(ID=>$this->id));
    }

    public function countWarps($idprojet) : int {
        return $this->db->count(WARP_TABLE,"IDPROJET",$idprojet);
    }
}

?>