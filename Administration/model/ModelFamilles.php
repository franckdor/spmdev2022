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

    public function __construct($code=NULL, $ref=NULL, $aut=NULL, $ann=NULL, $tit=NULL, $sourc=NULL, $idn=NULL) {
        if (!is_null($code) && !is_null($ref) && !is_null($aut) && !is_null($ann) && !is_null($idn) && !is_null($tit)
        && !is_null($sourc)) {
            $this->code_bibliographie = $code;
            $this->reference = $ref;
            $this->auteur = $aut;
            $this->annee = $ann;
            $this->titre = $tit;
            $this->source = $sourc;
            $this->id_note = $idn;
        }
    }

}