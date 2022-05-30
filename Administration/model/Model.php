<?php
require_once File::build_path(array("config", "Conf.php"));


class Model {
    
    private static $pdo = NULL;
//Connection to the database.
    public static function init() {

        $hostname = Conf::getHostname();
        $login = Conf::getLogin();
        $database = Conf::getDatabase();
        $password = Conf::getPassword(); 
    
        try {
            self::$pdo = new PDO("pgsql:host=$hostname;port=5432;dbname=$database", $login ,$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo "On a un souci CAPTAIN (au niveau de la connexion à la BDD si j'peux m'permettre)";
            }
            die();
        }

    }

    
//Function called by all Models/ModelsXXX function to connect to the DB
    public static function getPDO() {
        if (is_null(self::$pdo)) {
            self::init();
        }
        return self::$pdo;
    }


    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM $table_name");
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

    public static function select($primary_value)
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $req_prep = Model::getPDO()->prepare("SELECT * FROM $table_name WHERE $primary_key=:nom_tag");
            $values = array(
                "nom_tag" => $primary_value,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }

        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function delete($primary_value)
    {
        try {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $req_prep = Model::getPDO()->prepare("DELETE FROM $table_name WHERE $primary_key=:nom_tag");
            $values = array("nom_tag" => $primary_value);
            $req_prep->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            die();
        }
    }

    //Update one tuple for associated table for this model
    //In : data = dico 
    //$key = column name
    //$value = associated value
    public static function update($data)
    {
        try {
            $set = ' ';
            foreach ($data as $key => $value) {
                $set = $set . "$key = :$key, ";
            }
            //retire la last virgule
            $set = rtrim($set, ", ");

            $o = static::$object;
            $p = static::$primary;

            $pdo = Model::getPDO()->prepare("UPDATE $o SET $set WHERE $p = :$p ;");
            $pdo->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            die();
        }
    }

    //Create one tuple
    //In : data = dico 
    //$key = column name
    //$value = associated value
    public static function save($data)
    {
        try {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $insert = '';
            $values = '';
            foreach ($data as $key => $value) {
                $insert = $insert . "$key, ";
                $values = $values . ":$key, ";
            }
            $insert = rtrim($insert, ", ");
            $values = rtrim($values, ", ");

            $pdo = Model::getPDO()->prepare("INSERT INTO $table_name ($insert) VALUES ($values);");
            $pdo->execute($data);
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) // S'il y a déjà cet objet dans la BDD
                return false;
            else if (Conf::getDebug()) {
                echo $e->getMessage();
            } else
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            die();
        }
    }

    //GET COLUMN NAMES (FOR RIS)
    public static function getColumns() {
        try {
            $table_name = static::$object;
            $query = Model::getPDO()->query("select * from $table_name limit 1 ");
            $column_names = array_keys($query->fetch(PDO::FETCH_ASSOC));
            return $column_names;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function selectMaxId() {
        try {
            $table_name = static::$object;
            if ($table_name == 'plants') {
                return false;
            }
            $primary_key = static::$primary;
            $sql = "SELECT MAX($primary_key) FROM $table_name;";

            $pdo = Model::getPDO();
            $rep = $pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $number = $rep->fetchAll();
            if (is_null($number[0]['max'])) {
                $number[0]['max'] = 10000;
            }
            return $number[0]['max'];

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}

