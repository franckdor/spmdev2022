<?php

/*
Nomenclatures acts :
*/


require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));

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
    
    private $id_statut;
    //Id Genre Valide
    private $id_espece_valide;

    private $who;

    private $dateadd;

    protected static $object = "Nomenclature_espece";
    protected static $primary='id_nomenclature_espece';


    public function __construct($idE=NULL, $nomG=NULL, $nomE=NULL, $author_date=NULL, $note=NULL, $ref=NULL, $bibli=NULL, $statut=NULL, $idEV=NULL, $whoo=NULL, $date=NULL) {
        if (!is_null($idE) || !is_null($nomG) || !is_null($nomE) || !is_null($author_date) || !is_null($note) || !is_null($ref) ||
        !is_null($bibli) || !is_null($statut) || !is_null($idEV) ||!is_null($whoo) || !is_null($date)) {
            $this->id_nomenclature_espece = $idE;
            $this->nom_genre = $nomG;
            $this->nom_espece = $nomE;
            $this->auteur_date = $author_date;
            $this->id_note = $note;
            $this->reference_page = $ref;
            $this->code_bibliographie = $bibli;
            $this->id_statut = $statut;
            $this->id_espece_valide = $idEV;
            $this->who = $whoo;
            $this->dateadd = $date; 
        }
    }

    public static function selectAllis10() {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_espece WHERE id_statut=10";
            $req_prep = Model::getPDO()->query($sql);
            // passage de la valeur de name_tag
            // exécution de la requête préparée
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelNomenclature_espece");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

    

    public static function selectByName($name) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT nom_espece FROM nomenclature_espece WHERE nom_espece LIKE :name_tag LIMIT 5";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array("name_tag" => $name."%");
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

    public static function selectAllNomEsp() {
        try {
            $sql ="SELECT DISTINCT nom_espece FROM nomenclature_espece";
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req_prep->fetchAll();
            return $tab;
            } catch (PDOException $e){
                echo $e->getMessage()."\n";
                die("Erreur lors de la recherche dans la base de données.");
            }
    }

    public static function selectALLauthordate() {
        try {
        $sql ="SELECT DISTINCT auteur_date FROM nomenclature_espece";
        $req_prep = Model::getPDO()->query($sql);
        $req_prep->setFetchMode(PDO::FETCH_OBJ);
        $tab = $req_prep->fetchAll();
        return $tab;
        } catch (PDOException $e){
            echo $e->getMessage()."\n";
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

    public static function selectAuthorDate() {
        try {
        $sql ="SELECT DISTINCT auteur_date FROM nomenclature_espece WHERE id_nomenclature_espece=1";
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

    public function getStatusName() {
        return ModelStatut_genre::selectNameById($this->get("id_statut"))[0]->get("nom_statut_genre");
    }

    public function set($attribute) {
        $this->$attribute = $attribute;
    }
    
    public function getAll() {
        
            $array = array(
                "espece" => $this->get("nom_espece"),
                "genre" => $this->get("nom_genre"),
                "auteur_date" => $this->get("auteur_date"),
                "espece_valide" => ModelEspece_valide::select($this->get('id_espece_valide'))->get("nom_espece"),
                "genre_valide" => ModelEspece_valide::select($this->get('id_espece_valide'))->get('nom_genre'),
                "statut" => $this->getStatusName(),
                "id" => $this->get('id_nomenclature_espece'),
            );
        
        return $array;
    }
    
    /*
    public function getAll() {
        return get_object_vars($this);
    }
    */
    public static function SelectIDValidSpe($species, $genus) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT id_espece_valide FROM nomenclature_espece
            WHERE nom_espece=:nom_espece AND nom_genre=:nom_genre";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array(
                "nom_espece" => $species,
                "nom_genre" => $genus,
        );
            // exécution de la requête préparée
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelNomenclature_genre");
            $tabResults = $req_prep->fetchAll();
            // renvoi du tableau de résultats
            return $tabResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

    public static function SelectByIdValidSpecies($idValidSpecies) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_espece
            WHERE id_espece_valide=:id
            ORDER BY nom_espece, id_statut";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array(
                "id" => $idValidSpecies);
                
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

    public static function SelectID_GenusSpeciesStatusRef($data) {
        try {
            $tab = explode(" - ", $data);
            $status = ModelStatut_genre::selectIdByName($tab[3]);
    
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_espece
            WHERE nom_genre=:genus
            AND nom_espece=:species
            AND auteur_date=:author
            AND id_statut=:statut";

            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array(
                "genus" => $tab[0],
                "species" => $tab[1],
                "author" => $tab[2],
                "statut" => $status[0]->get('id_statut_genre'),
            );
                
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

    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM $table_name
            ORDER BY id_nomenclature_espece");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelNomenclature_espece");
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


    public static function SelectByCodeBiblio($code_biblio) {
        try {
            // préparation de la requête
            $sql = "SELECT DISTINCT * FROM nomenclature_espece
            WHERE code_bibliographie=:code
            ORDER BY nom_espece, id_statut";
            $req_prep = Model::getPDO()->prepare($sql);
            // passage de la valeur de name_tag
            $values = array(
                "code" => $code_biblio);
                
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