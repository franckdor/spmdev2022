<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelEspece_valide extends Model {

    private $id_espece_valide;

    private $nom_genre;

    private $nom_espece;

    private $auteur_date;

    private $id_note;

    private $reference_page;

    private $code_bibliographie;

    private $bolland;

    private $id_genre_valide;

    protected static $object = "espece_valide";
    protected static $primary='id_espece_valide';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    
    public function __construct($id=NULL, $nomg=NULL, $nome=NULL, $aut=NULL, $idn=NULL, $ref=NULL, $codebibli=NULL, $boll=NULL, $idgv=NULL) {
        if (!is_null($id) && !is_null($nomg) && !is_null($nome) && !is_null($aut) && !is_null($idn) && !is_null($ref)
        && !is_null($codebibli) && !is_null($boll) && !is_null($idgv)) {
            $this->id_espece_valide = $id;
            $this->nom_genre = $nomg;
            $this->nom_espece = $nome;
            $this->auteur_date = $aut;
            $this->id_note = $idn;
            $this->reference_page = $ref;
            $this->code_bibliographie = $codebibli;
            $this->bolland = $boll;
            $this->id_genre_valide = $idgv;
        }
    }
    
    
}