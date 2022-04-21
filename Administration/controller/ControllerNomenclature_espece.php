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
            $espece = $GET['espece'];
            sleep(1);
            echo json_encode($tab);
        }
        $tab = ModelNomenclature_espece::selectByName($espece);
        require_once File::build_path(array("view", "view.php"));
        
    }
    
}