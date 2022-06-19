<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelPlante extends Model {

    private $id_plante;

    private $embranchement;

    private $classe;

    private $ordre;

    private $famille;

    private $genre;

    private $espece;

    private $auteur_date;



    protected static $object = "plante";
    protected static $primary="id_plante";

    public function __construct($id_plante=NULL, $embranchement=NULL, $classe=NULL, $ordre=NULL, $famille=NULL, $genre=NULL,
    $espece=NULL, $auteur_date=NULL) {
        if (!is_null($id_plante) && !is_null($embranchement) && !is_null($classe) && !is_null($ordre) && !is_null($famille) 
        && !is_null($genre) && !is_null($espece)&& !is_null($auteur_date)) {
            $this->id_plante = $id_plante;
            $this->embranchement = $embranchement;
            $this->classe = $classe;
            $this->ordre = $ordre;
            $this->famille = $famille;
            $this->genre = $genre;
            $this->espece = $espece;
            $this->auteur_date = $auteur_date;
        }
    }

    public function get($attribute) {
        return $this->$attribute; 
    }


    public function getAll() {
        return get_object_vars($this);
    }

    public function getSpeGen() {
        $tab = array();
        $tab['species'] = $this->get('espece');
        $tab['genus'] = $this->get('genre');
        $tab['id'] = $this->get('id_plante');
        $tab['scientific_name'] = $this->get('genre')." - ".$this->get("espece");
        $tab['family'] = $this->get('famille');  
        return $tab;
    }


    //SELECT BUT QUOTES CAUSE DB CARES ABOUT CAPS
    public static function select($id) {
        try {
            $sql = "SELECT DISTINCT * FROM plante WHERE id_plante=:id";
            $req_prep = Model::getPDO()->prepare($sql);
            $data = array(
                'id' => $id,  
            );
            $req_prep->execute($data);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelPlante");
            $tab = $req_prep->fetchAll();
            return $tab;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        } 
    }
    

}