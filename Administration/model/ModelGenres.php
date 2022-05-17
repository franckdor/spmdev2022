<?php
// THIS WILL BE THE FUTURE NOMENCLATURE GENRE
require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));

class ModelGenres extends Model {

    //id Espece Valide
    private $code_genre;
    //nom Genre
    private $genre;
    //nom Espece
    private $tribu;
    //Author_Date;
    private $sous_famille;
    //id de la note
    private $code_genre_valide;
    //ref_page
    private $code_famille;
    //Code bibliographie
    private $code_reference;
    
    private $page;
    //Id Genre Valide
    private $code_statut;

    private $code_espece_type;

    private $ordre_taxonomique;

    private $note_imp;

    private $note_enr;

    private $date_maj;

    private $utilisateur;

    protected static $object = "genres";
    protected static $primary='code_genre';


    public function __construct($cg=NULL, $nomG=NULL, $tribu=NULL, $sous_famille=NULL, $code_genre_valide=NULL, $code_famille=NULL, 
    $code_reference=NULL, $page=NULL, $code_statut=NULL, $code_espece_type 	=NULL, $ordre_taxonomique=NULL, $note_imp=NULL, $note_enr=NULL, $date_maj=NULL,
    $utilisateur=NULL) {
        if (!is_null($cg) || !is_null($nomG) || !is_null($tribu) || !is_null($sous_famille) || !is_null($code_genre_valide) || !is_null($code_famille) ||
        !is_null($code_reference) || !is_null($page) || !is_null($code_statut) ||!is_null($code_espece_type) || !is_null($ordre_taxonomique) || 
        !is_null($note_imp) || !is_null($note_enr) || !is_null($date_maj) || !is_null($utilisateur)) {
            $this->code_genre = $cg;
            $this->genre = $nomG;
            $this->tribu = $tribu;
            $this->sous_famille = $sous_famille;
            $this->code_genre_valide = $code_genre_valide;
            $this->code_famille = $code_famille;
            $this->code_reference = $code_reference;
            $this->page = $page;
            $this->code_statut = $code_statut;
            $this->code_espece_type = $code_espece_type;
            $this->ordre_taxonomique = $ordre_taxonomique;
            $this->note_imp = $note_imp; 
            $this->note_enr = $note_enr;
            $this->date_maj = $date_maj;
            $this->utilisateur = $utilisateur;
        }
    }

    public function get($attribute) {
        return $this->$attribute;
    }

    //I serialise by myself
    public function getAll() {
        $array = array(
            "genre" => $this->get("genre"),
            "tribu" => $this->get("tribu"),
            "sous_famille" => $this->get("sous_famille"),
            "statut" => ModelStatut_genre::selectNameById($this->get("code_statut"))[0]->get("nom_statut_genre")
        );
        return $array;
    }
}