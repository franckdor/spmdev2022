<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelContinent extends Model {

    private $id_continent;

    private $nom_continent;

    protected static $object = "continent";
    protected static $primary='id_continent';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getAll() {
        return get_object_vars($this);
    }
    
    public function __construct($id_continent=NULL, $nom_continent=NULL) {
        if (!is_null($id_continent) && !is_null($nom_continent)) {
            $this->id_continent = $id_continent;
            $this->nom_continent = $nom_continent;
        }
    }
}