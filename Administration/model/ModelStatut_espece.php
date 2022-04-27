<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelStatut_espece extends Model {
    private $id_statut_espece;
    private $nom_statut_espece;

    protected static $object = "statut_espece";
    protected static $primary='id_statut_espece';

    public function __construct($id=NULL, $nom=NULL) {
        if(!is_null($id) && !is_null($nom)) {
            $this->id_statut_espece = $id;
            $this->nom_statut_espece = $nom;
        }
    }

    public static function selectNameById($id) {
        try {
            // préparation de la requête
            $sql = "SELECT * FROM statut_espece  WHERE id_statut_espece=:name_tag";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array("name_tag" => $id);
            // exécution de la requête préparée
            $req_prep->execute($values);
            //$req_prep->setFetchMode(PDO::FETCH_OBJ);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelStatut_espece");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

    public static function selectIdByName($name) {
        try {
            $sql ="SELECT DISTINCT id_statut_espece FROM statut_espece WHERE nom_statut_espece='$name'";
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelStatut_espece");
            $tab = $req_prep->fetchAll();
            return $tab;
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