<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelNote extends Model {

    private $id_note;

    private $note;

    protected static $object = "note";
    protected static $primary='id_bote';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getAll() {
        return get_object_vars($this);
    }
    
    public function __construct($id_note=NULL, $note=NULL) {
        if (!is_null($id_note) && !is_null($note)) {
            $this->id_note = $id_note;
            $this->note = $note;
        }
    }
}