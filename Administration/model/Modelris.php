<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelRis extends Model {


    private $id_ris;
    private $tag;
    private $value;

    protected static $object = "ris";
    protected static $primary='id_ris';


    public function __construct($id_ris=NULL, $tag=NULL, $value=NULL) {
        if (!is_null($id_ris) && !is_null($tag) && !is_null($value)) {
            $this->$id_ris = $id_ris;
            $this->$tag = $tag;
            $this->$value = $value;
        }
    }

}