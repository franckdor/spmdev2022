<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelGeo_lien_level4_pays extends Model {

    private $id_pays;

    private $nom_pays;

    private $id_level4;

    private $nom_level4;

    protected static $object = "geo_lien_level4_pays";
    protected static $primary='id_level4';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getAll() {
        return get_object_vars($this);
    }
    
    public function __construct($id_pays=NULL, $nom_pays=NULL, $id_level4=NULL, $nom_level4=NULL) {
        if (!is_null($id_pays) && !is_null($nom_pays) && !is_null($id_level4) && !is_null($nom_level4)) {
            $this->id_pays = $id_pays;
            $this->nom_pays = $nom_pays;
            $this->id_level4 = $id_level4;
            $this->nom_level4 = $nom_level4;
        }
    }

    public static function selectByIdPays($id_pays) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM geo_lien_level4_pays WHERE id_pays=:name_tag";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array("name_tag" => $id_pays);
            // exécution de la requête préparée
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelGeo_lien_level4_pays");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

}