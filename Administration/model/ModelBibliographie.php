<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelBibliographie extends Model {

    private $code_bibliographie;

    private $reference;

    private $auteur;

    private $annee;

    private $titre;

    private $source;

    private $id_note;

    protected static $object = "bibliographie";
    protected static $primary='code_bibliographie';

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