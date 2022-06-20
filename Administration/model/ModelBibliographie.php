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

    private $occurences;

    private $tap;

    private $resume;

    protected static $object = "bibliographie";
    protected static $primary='code_bibliographie';

    public function __construct($code=NULL, $ref=NULL, $aut=NULL, $ann=NULL, $tit=NULL, $sourc=NULL, $idn=NULL, $occurences=NULL, $tap=NULL,
    $resume=NULL) {
        if (!is_null($code) && !is_null($ref) && !is_null($aut) && !is_null($ann) && !is_null($idn) && !is_null($tit)
        && !is_null($sourc) && !is_null($occurences) && !is_null($tap) && !is_null($resume)) {
            $this->code_bibliographie = $code;
            $this->reference = $ref;
            $this->auteur = $aut;
            $this->annee = $ann;
            $this->titre = $tit;
            $this->source = $sourc;
            $this->id_note = $idn;
            $this->occurences = $occurences;
            $this->tap = $tap;
            $this->resume = $resume;
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    static public function update($data) {
        try {
        if($data['occurences']=="") {
            $data['occurences'] = "false";
        } 
        if ($data['tap'] == "") {
            $data['tap'] = "false";
        }
        
        $data['resume'] = $data['resume']. " . " . $data['reference'];
        $resume = $data['resume'];
        $code = $data['code_bibliographie'];
        $value = array(
            "titre" => $data['titre'],
            'reference' => $data['reference'],
            'source' => $data['source'],
            'auteur' => $data['auteur'],
            'annee' => $data['annee'],
            'occurences' => $data['occurences'],
            'tap' => $data['tap'],

        );
        $sql = "UPDATE bibliographie SET 
            reference=:reference,
            auteur=:auteur,
            annee=:annee,
            titre=:titre,
            source=:source,
            occurences=:occurences,
            tap=:tap
            WHERE code_bibliographie=$code";

            $pdo = Model::getPdo()->prepare($sql);
            $pdo->execute($value);
        } catch (PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
        }

    }

    //RETRIEVE ALL DATA WITH  ORDER BY 
    //function overloaded 
    //return an object with all its info
    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM $table_name
            ORDER BY code_bibliographie");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelBibliographie");
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

    static public function selectFromRef($ref) {
        try {
            $sql = "SELECT * FROM bibliographie WHERE reference=:ref";

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

    //Uses the default model  
    //A faire évoluer
    public function getAll() {
        return get_object_vars($this);
    }

    static public function selectIdByTitle($title) {
        try {

            $sql = "SELECT code_bibliographie FROM bibliographie WHERE titre=:title";

            $pdo = Model::getPDO();
            
            $req_prep = $pdo->prepare($sql);

            $data = array(
                'title' => $title
            );

            $req_prep->execute($data);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelBibliographie");
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


    static public function selectIdByAut($title) {
        try {

            $tab = explode(" - ", $title);
            

            $sql = "SELECT code_bibliographie FROM bibliographie WHERE auteur=:aut";

            $pdo = Model::getPDO();
            
            $req_prep = $pdo->prepare($sql);

            $data = array(
                'aut' => $tab[0],
            );

            $req_prep->execute($data);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelBibliographie");
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

    //Function used in updated actions. ($data = $_POST['biblio'])
    static public function selectByAuthorYearTitleSource($data) {
        try {
            $data = explode(" - ", $data);


            $sql = "SELECT code_bibliographie FROM bibliographie WHERE auteur=:auteur_date AND titre=:titre AND annee=:annee AND source=:source";

            $pdo = Model::getPDO();

            $req_prep = $pdo->prepare($sql);

            $values = array(
                'auteur_date' => $data[0],
                'annee' => $data[1],
                'titre' =>$data[2],
                'source' => $data[3],
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelBibliographie");
            return $req_prep->fetchAll();

        }catch(PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }
    }
    
    
}