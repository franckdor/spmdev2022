<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelAdmin extends Model{

    private $id;
    private $login;
    private $mdp;
    protected static $object = "admin";
    protected static $primary='id';

    public function __construct($i=NULL, $l=NULL, $mdp=NULL) {
        if (!is_null($l) && !is_null($i) && !is_null($mdp)) {
            $this->login = $l;
            $this->id = $i;
            $this->mdp = $mdp;
        }
    }

    public static function checkAdmin($id) {
        $table_name = static::$object;
        $class_name = 'Model'.ucfirst($table_name);

        $sql="SELECT DISTINCT id FROM admin WHERE id=:id";
        $data = array(
            "id" => $id
        );
        $req_prep = Model::getPDO()->prepare($sql);
        try {
            $req_prep->execute($data);
            $tab = $req_prep->fetchAll();

            if($tab[0] !== null) return true;
            else {return false;}
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $sql;
                echo $e->getMessage();
            } else {
                echo "Le check de l'admin c'est chaud là";
            }
        }
    }


    public static function checkPasswd($login, $mdp_hash) {
        $table_name = static::$object;
        $class_name = 'Model'.ucfirst($table_name);

        $sql="SELECT id FROM admin WHERE login=:login AND mdp=:mdp";
        $data = array(
            "login" => $login,
            "mdp" => $mdp_hash,
        );
        $req_prep = Model::getPdo()->prepare($sql);

        try {
            $req_prep->execute($data);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            if (sizeof($tab) == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $sql;
                echo $e->getMessage();
            } else {
                echo "Je ne suis même pas fichu de réussir à check un mdp...";
            }
        }

    }

    public static function getIdByLogAndMdp($login, $mdp_hash){
        $sql="SELECT DISTINCT id FROM admin WHERE login=:login AND mdp=:mdp";
        $values = array(
            'login' => $login,
            'mdp'=> $mdp_hash,
        );
        $req_prep = Model::getPDO()->prepare($sql);


        //on execute la requete
        try{
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();
            if (sizeof($tab)==1) { //si on a un résultat, la connexion peut se poursuivre
                return $tab[0]['id'];
            }
        }catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function deleteByLogin($log) {
        $sql = "DELETE FROM admin WHERE login=:log";

        $req_prep = Model::getPDO()->prepare($sql);

        $data = array(
            "log" => $log,
        );

        $req_prep->execute($data);
        return true;
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getId() {
        return $this->id;
    }

    public function setLogin($new) {
        $this->login = $new;
    }

    public static function getAdminByLog($log) {
        $sql = "SELECT * FROM admin WHERE login=:log";

        $req_prep = Model::getPDO()->prepare($sql);

        $data = array(
            "log" => $log,
        );

        $req_prep->execute($data);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelAdmin");
        $admin = $req_prep->fetchAll();
        if (empty($admin)) {
            return false;
        }
        return $admin;
    }


}
