<?php

/*
Nomenclatures acts :
*/


require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelNomenclature_genre extends Model {

    //id Espece Valide
    private $id_nomenclature_genre;
    //nom Genre
    private $nom_genre;

    private $id_nomenclature_espece;
    //id de la note
    private $id_note;
    //ref_page
    private $reference_page;
    //Code bibliographie
    private $code_bibliographie;
    //Bolland (à supprimer)
    private $id_statut;
    //Id Genre Valide
    private $id_genre_valide;

    protected static $object = "Nomenclature_genre";
    protected static $primary='id_nomenclature_genre';


    public function __construct($idG=NULL, $idE=NULL, $nomG=NULL, $note=NULL, $ref=NULL, $bibli=NULL, $statut=NULL, $idGV=NULL) {
        if (!is_null($idG) || !is_null($nomG) || !is_null($idE) || !is_null($note) || !is_null($ref) ||
        !is_null($bibli) || !is_null($statut) || !is_null($idGV)) {
            $this->id_nomenclature_genre = $idG;
            $this->id_nomenclature_espece = $idE;
            $this->nom_genre = $nomG;
            $this->id_note = $note;
            $this->reference_page = $ref;
            $this->code_bibliographie = $bibli;
            $this->id_statut = $statut;
            $this->id_genre_valide = $idGV;
        }
    }

    public static function selectByName($name) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_genre WHERE nom_genre LIKE :name_tag LIMIT 5";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag 
            $values = array("name_tag" => ucfirst($name)."%");//UCFIRST Bc you enter in lowercase from form but in Uppercase from DB
            // exécution de la requête préparée
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

    public static function selectAllNomGen() {
        try {
            $sql ="SELECT DISTINCT nom_genre FROM nomenclature_genre";
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req_prep->fetchAll();
            return $tab;
            } catch (PDOException $e){
                echo $e->getMessage()."\n";
                die("Erreur lors de la recherche dans la base de données.");
            }
    }

    public function get($attribute) {
        return $this->$attribute;
    }

    public function set($attribute) {
        $this->$attribute = $attribute;
    }
}