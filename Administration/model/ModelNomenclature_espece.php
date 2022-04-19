<?php
require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelNomenclature_espece extends Model {

    //id Espece Valide
    private $id_nomenclature_espece;
    //nom Genre
    private $nom_genre;
    //nom Espece
    private $nom_espece;
    //Author_Date;
    private $auteur_date;
    //id de la note
    private $id_note;
    //ref_page
    private $reference_page;
    //Code bibliographie
    private $code_bibliographie;
    //Bolland (à supprimer)
    private $id_statut;
    //Id Genre Valide
    private $id_espece_valide;

    protected static $object = "Nomenclature_espece";
    protected static $primary='id_nomenclature_espece';


    public function __construct($idE=NULL, $nomG=NULL, $nomE=NULL, $author_date=NULL, $note=NULL, $ref=NULL, $bibli=NULL, $statut=NULL, $idEV=NULL) {
        if (!is_null($idE) || !is_null($nomG) || !is_null($nomE) || !is_null($author_date) || !is_null($note) || !is_null($ref) ||
        !is_null($bibli) || !is_null($statut) || !is_null($idEV)) {
            $this->id_nomenclature_espece = $idE;
            $this->nom_genre = $nomG;
            $this->nom_espece = $nomE;
            $this->auteur_date = $author_date;
            $this->id_note = $note;
            $this->reference_page = $ref;
            $this->code_bibliographie = $bibli;
            $this->id_statut = $statut;
            $this->id_espece_valide = $idEV;
        }
    }

    public function get($attribute) {
        return $this->$attribute;
    }
}