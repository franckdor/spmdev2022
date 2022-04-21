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
    
    //Species form
    public static function requete() {
        $view="requete";
        $pagetitle="Liste des espèces";
        require_once File::build_path(array("view", "view.php"));
    }

    //Action for JS autocompletion :
    public static function autocomplete() {
        $tab = ModelNomenclature_espece::selectByName($_GET['espece']);
        sleep(1);
        echo json_encode($tab);
    }
    
}