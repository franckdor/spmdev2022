<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelPays extends Model {

    private $id_pays;

    private $nom_pays;

    private $id_continent;

    private $id_zone_biogeographique;

    protected static $object = "pays";
    protected static $primary='id_pays';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getAll() {
        return get_object_vars($this);
    }
    
    public function __construct($id_pays=NULL, $nom_pays=NULL, $id_continent=NULL, $id_zone_biogeographique=NULL) {
        if (!is_null($id_pays) && !is_null($nom_pays) && !is_null($id_continent) && !is_null($id_zone_biogeographique)) {
            $this->id_pays = $id_pays;
            $this->nom_pays = $nom_pays;
            $this->id_continent = $id_continent;
            $this->id_zone_biogeographique = $id_zone_biogeographique;
        }
    }
}