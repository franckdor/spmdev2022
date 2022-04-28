<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelBibliographie extends Model {

    private $code_bibliographie;

    private $reference;

    private $auteur;

    private $annee;

    private $titre;

    private $source;

    private $id_note;

    protected static $object = "bibliographie";
    protected static $primary='code_bibliographie';

    public function __construct($code=NULL, $ref=NULL, $aut=NULL, $ann=NULL, $tit=NULL, $sourc=NULL, $idn=NULL) {
        if (!is_null($code) && !is_null($ref) && !is_null($aut) && !is_null($ann) && !is_null($idn) && !is_null($tit)
        && !is_null($sourc)) {
            $this->code_bibliographie = $code;
            $this->reference = $ref;
            $this->auteur = $aut;
            $this->annee = $ann;
            $this->titre = $tit;
            $this->source = $sourc;
            $this->id_note = $idn;
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM $table_name");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
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

    static public function selectByRef($ref) {
        try {
            $sql = "SELECT titre FROM bibliographie WHERE reference=:ref";

            $pdo = Model::getPDO();
            
            $req_prep = $pdo->prepare($sql);

            $data = array(
                'ref' => $ref
            );

            $req_prep->execute($data);

            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
            return $req_prep->fetchAll();
        } catch(PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }
    }
    
    
}