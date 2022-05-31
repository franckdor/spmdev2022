<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelClassification extends Model{
    //Have to be the same as the DB
    private $id_classification;
    private $nom_classification;
    private $reference_page;
    private $id_note;
    private $code_bibliographie;
    private $id_rang;

    //Permet d'appeler les fonctions de model whit these attributes
    protected static $object = "classification";
    protected static $primary='id_classification';

    public function __construct($id_classification=NULL, $nom_classification=NULL, $reference_page=NULL, $id_note=NULL, 
    $code_bibliographie=NULL, $id_rang=NULL) {
        if (!is_null($id_classification) && !is_null($nom_classification) && !is_null($reference_page) && !is_null($id_note)
        && !is_null($code_bibliographie) && !is_null($id_rang)) {
            $this->id_classification = $id_classification;
            $this->nom_classification = $nom_classification;
            $this->reference_page = $reference_page;
            $this->id_note = $id_note;
            $this->code_bibliographie = $code_bibliographie;
            $this->id_rang = $id_rang;
        }
    }


    public static function selectTribe() {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            //5 is rank id for tribes
            $rep = $pdo->query("SELECT * FROM $table_name
            WHERE id_rang=5
            ORDER BY id_classification");
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }


}
?>