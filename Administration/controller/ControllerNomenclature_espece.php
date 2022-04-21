<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre"));

class ControllerNomenclature_espece {


    protected static $object = 'Nomenclature_espece';

    public static function readAll() {
        $view="list";
        $pagetitle="Liste des Espèces";
        $tab_esp = ModelNomenclature_espece::selectALL();
        //$statut = ModelStatut_genre::selectNameById(10); //RETURN AN ARRAY
        //$st; 
        //GETTING NAME STATUS OUT OF ARRAY
        //foreach($statut as $stat) {
        //    $st = $stat->get('nom_statut_genre');    
        //}
        $controller = new ControllerNomenclature_espece();
        $tab = $controller->associationStatus($tab_esp);
        require_once File::build_path(array("view", "view.php"));
    }
    
    //Species form
    public static function requete() {
        $view="requete";
        $pagetitle="Liste des espèces";
        require_once File::build_path(array("view", "view.php"));
    }

    //Action for JS autocompletion :
    public static function autocompleteEsp() {
        $tabE = ModelNomenclature_espece::selectByName($_GET['espece']);
        
        sleep(0.5);
       
        echo json_encode($tabE);
    }

    public static function autocompleteGen() {
        $tabG = ModelNomenclature_genre::selectByName($_GET['genre']);
        
        sleep(0.5);
       
        echo json_encode($tabG);
    }
    
    public static function associationStatus($esp_array) {
        $tab = array();
        foreach($esp_array as $esp) {
            array_push($tab, ModelStatut_genre::selectNameById($esp->get('id_statut')));
        }
        return $tab;
    }
}