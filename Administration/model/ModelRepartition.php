<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelRepartition extends Model {

    private $id_repartition;

    private $id_pays;

    private $code_bibliographie;

    private $id_nomenclature_espece;

    private $printed_note;

    protected static $object = "repartition";
    protected static $primary='id_repartition';


    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getAll() {
        return get_object_vars($this);
    }
    
    public function __construct($id_repartition=NULL, $id_pays=NULL, $code_bibliographie=NULL, $printed_note=NULL) {
        if (!is_null($id_repartition) && !is_null($id_pays) && !is_null($code_bibliographie) && !is_null($printed_note)) {
            $this->id_repartition = $id_repartition;
            $this->id_pays = $id_pays;
            $this->code_bibliographie = $code_bibliographie;
            $this->printed_note = $printed_note;
        }
    }


    public static function selectByCodeBiblio($code_biblio) {
            try {
                // préparation de la requête
                $sql = "SELECT DISTINCT * FROM repartition
                WHERE code_bibliographie=:code";
                $req_prep = Model::getPDO()->prepare($sql);
                // passage de la valeur de name_tag
                $values = array(
                    "code" => $code_biblio);
                    
                // exécution de la requête préparée
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelRepartition");
                $tabResults = $req_prep->fetchAll();
                // renvoi du tableau de résultats
                return $tabResults;
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la recherche dans la base de données.");
            }
    }

    public static function selectByIdNomenclature($id_nomenclature) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_espece ne
            JOIN repartion r ON r.id_nomenclature_espece=ne.id_nomenclature_espece
            WHERE id_nomenclature_espece=:id";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array(
                "id" => $id_nomenclature);
                
            // exécution de la requête préparée
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelNomenclature_espece");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
}

}