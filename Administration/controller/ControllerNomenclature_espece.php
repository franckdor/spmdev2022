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
        if (isset($_GET['espece'])) {
            $espece = $_GET['espece'];
        
        // lancement de la requête SQL avec selectByName et
        // récupération du résultat de la requête SQL
        $tab = ModelNomenclature_espece::selectByName($espece);

        // délai fictif
        // sleep(1);
        sleep(1);

        // affichage en format JSON du résultat précédent
        // ...
        $tab = json_encode($tab);
        }
        require_once File::build_path(array("view", "view.php"));
    }
    
}