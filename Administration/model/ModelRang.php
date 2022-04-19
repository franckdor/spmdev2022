<?php

require_once File::build_path(array("Model.php"));
require_once File::build_path(array("config", "Conf.php"));

class Rang extends Model {

    private $id_rang;
    private $nom_rang;
    protected static $object = "rang";
    protected static $primary='id_rang';

    public function __construct($id=NULL, $nom=NULL) {
        if (!is_null($id) && !is_null($nom)) {
            $this->id_rang = $id;
            $this->nom_rang = $nom;
        }
    }

    public function afficher() {
        echo $this->id_rang;
        echo $this->nom_rang;
    }

    public function getNRang() {
        return $this->nom_rang;
    }

    public function getIRang() {
        return $this->id_rang;
    }

    public function setNRang($nom) {
        $this->nom_rang = $nom;
    }

}