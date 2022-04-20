<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));

class ControllerNomenclature_espece {


    protected static $object = 'Nomenclature_espece';

    public static function readAll() {
        $view="list";
        $pagetitle="Liste des Espèces";
        $tab_esp = ModelNomenclature_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
    }
    
    public static function requete() {
        $view="requete";
        $pagetitle="Liste des espèces";
        if (empty($_GET['espece'])) {
            echo "help";
        } else {
            $tab = ModelNomenclature_espece::selectByName($_GET['espece']);
            sleep(1);
            echo $tab;
            $tab = json_encode($tab);
        }
        // lancement de la requête SQL avec selectByName et
        // récupération du résultat de la requête SQL
        

        // délai fictif
        // sleep(1);
        

        // affichage en format JSON du résultat précédent
        // ...
        
        
        require_once File::build_path(array("view", "view.php"));
    }
    
}