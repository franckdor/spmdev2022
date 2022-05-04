<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelFamilles extends Model {

    private $code_famille;

    private $famille;

    private $super_famille;

    private $infra_ordre;

    private $sous_ordre;

    private $ordre;

    private $code_ordre;

    private $reference;

    private $page;

    private $ordre_taxonomique;


    protected static $object = "familles";
    protected static $primary='code_famille';

    public function __construct($code_famille=NULL, $famille=NULL, $super_famille=NULL, $infra_ordre=NULL, $sous_ordre=NULL, $ordre=NULL,
    $code_ordre=NULL, $reference=NULL, $page=NULL, $ordre_taxonomique=NULL) {
        if (!is_null($code_famille) && !is_null($famille) && !is_null($super_famille) && !is_null($infra_ordre) && !is_null($sous_ordre) 
        && !is_null($ordre) && !is_null($code_ordre) && !is_null($reference) && !is_null($page) && !is_null($ordre_taxonomique)) {
            $this->code_famille = $code_famille;
            $this->famille = $famille;
            $this->super_famille = $super_famille;
            $this->infra_ordre = $infra_ordre;
            $this->sous_ordre = $sous_ordre;
            $this->ordre = $ordre;
            $this->code_ordre = $code_ordre;
            $this->reference = $reference;
            $this->page = $page;
            $this->ordre_taxonomique = $ordre_taxonomique;
        }
    }

    public function get($attribute) {
        return $this->$attribute; 
    }


    public function getAll() {
        return get_object_vars($this);
    }

}