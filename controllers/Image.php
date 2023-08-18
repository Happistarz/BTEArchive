<?php 

require_once('models/Database.php');

function convertSRC($name) {
    $db = Connexion()
    $sql = "SELECT SRC FROM ".IMAGE_TABLE." WHERE SRC LIKE '$name%'";
    $res = $db->exec($sql);
    $index = 0;
    foreach ($res as $resu) {
        $nom = substr($resu['SRC'],strlen($name));
        if ($nom > $index) {
            $index = $nom;
        }
        // print_r($resu);
    }
    return $name.strval($index+1);
}


class Image extends Connexion {
    private $id;

    private $idprojet;

    private $src;

    public function __construct($idprojet,$src) {
        parent::__construct();
        $this->idprojet = $idprojet;
        $this->src = $src;
    }

    public function getSrc() {
        return $this->src;
    }

    public function insertImage() {
        return parent::create(IMAGE_TABLE, array(
            "IDPROJET"=>$this->idprojet,
            "SRC"=>$this->src
        ))
    }

    public function deleteImage() {
        return parent::delete(IMAGE_TABLE, array(
            "SRC"=>$this->src
        ))
    }

    public function updateImage() {
        return parent::update(IMAGE_TABLE, array(
            "IDPROJET"=>$this->idprojet,
            "SRC"=>$this->src
        ))
    }

    public function countImage() {
        return parent::count(IMAGE_TABLE, array(
            "IDPROJET"=>$this->idprojet
        ))
    }
}

?>