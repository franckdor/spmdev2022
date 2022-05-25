<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelZone_biogeographique extends Model {
    //Have to be the same as the DB
    private $id_zone_biogeographique;
    private $nom_zone_biogeographique;
    //Permet d'appeler les fonctions de model whit these attributes
    protected static $object = "zone_biogeographique";
    protected static $primary='id_zone_biogeographique';

    public function __construct($id_zone_biogeographique=NULL, $nom_zone_biogeographique=NULL) {
        if (!is_null($id_zone_biogeographique) && !is_null($nom_zone_biogeographique)) {
            $this->id_zone_biogeographique = $id_zone_biogeographique;
            $this->nom_zone_biogeographique = $nom_zone_biogeographique;
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }
}