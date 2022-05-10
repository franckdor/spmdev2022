<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelPlante extends Model {

    private $id_plante;

    private $embranchement;

    private $classe;

    private $ordre;

    private $famille;

    private $genre;

    private $espece;

    private $auteur_date;



    protected static $object = "plante";
    protected static $primary='id_plante';

    public function __construct($id_plante=NULL, $embranchement=NULL, $classe=NULL, $ordre=NULL, $famille=NULL, $genre=NULL,
    $espece=NULL, $auteur_date=NULL) {
        if (!is_null($id_plante) && !is_null($embranchement) && !is_null($classe) && !is_null($ordre) && !is_null($famille) 
        && !is_null($genre) && !is_null($espece) && !is_null($auteur_date)) {
            $this->id_plante = $id_plante;
            $this->embranchement = $embranchement;
            $this->classe = $classe;
            $this->ordre = $ordre;
            $this->famille = $famille;
            $this->genre = $genre;
            $this->espece = $espece;

        }
    }

    public function get($attribute) {
        return $this->$attribute; 
    }


    public function getAll() {
        return get_object_vars($this);
    }

}