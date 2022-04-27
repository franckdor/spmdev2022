<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelGenre_valide extends Model {

    private $id_genre_valide;

    private $nom_genre;

    private $reference_page;

    private $code_bibliographie;

    private $id_classification;

    private $id_note;

    public function __construct($id=NULL, $nomg=NULL, $ref=NULL, $codebibli=NULL, $idclas=NULL, $idn=NULL) {
        if (!is_null($id) && !is_null($nomg) && !is_null($nome) && !is_null($aut) && !is_null($idn) && !is_null($ref)
        && !is_null($codebibli) && !is_null($boll) && !is_null($idgv)) {
            $this->id_genre_valide = $id;
            $this->nom_genre = $nomg;
            $this->reference_page = $ref;
            $this->code_bibliographie = $codebibli;
            $this->id_classification = $idclas;
            $this->id_note = $idn;
        }
    }
    
    
}