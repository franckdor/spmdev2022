<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelStatut_genre extends Model {
    private $id_statut_genre;
    private $nom_statut_genre;

    protected static $object = "statut_genre";
    protected static $primary='id_statut_genre';

    public function __construct($id=NULL, $nom=NULL) {
        if(!is_null($id) && !is_null($nom)) {
            $this->id_statut_genre = $id;
            $this->nom_statut_genre = $nom;
        }
    }

    public static function selectNameById($id) {
        try {
            // préparation de la requête
            $sql = "SELECT * FROM statut_genre  WHERE id_statut_genre=:name_tag";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array("name_tag" => $id);
            // exécution de la requête préparée
            $req_prep->execute($values);
            //$req_prep->setFetchMode(PDO::FETCH_OBJ);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelStatut_genre");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
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