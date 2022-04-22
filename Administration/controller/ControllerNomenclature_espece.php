<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));

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
        //Association status is not an "action", we don't need a new file for it.
        $tab = ControllerNomenclature_espece::associationStatus($tab_esp);
        
        
        require_once File::build_path(array("view", "view.php"));
    }
    
    //Species form
    public static function requete() {
        $view="requete";
        $pagetitle="Liste des espèces";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
    }

    //Action for JS autocompletion :
    public static function autocompleteEsp() {
        $tabE = ModelNomenclature_espece::selectByName($_GET['espece']);
        
        sleep(0.5);
       
        echo json_encode($tabE);
    }

    //CALL FOR autocompletion in JS request (url from js)
    public static function autocompleteGen() {
        $tabG = ModelNomenclature_genre::selectByName($_GET['genre']);
        
        sleep(0.5);
       
        echo json_encode($tabG);
    }

    //CALL FOR autocompletion in JS request (url from js)
    public static function autocompleteSTAT() {
        $tabS = ModelStatut_espece::selectALL();
        $tab = array();
        sleep(0.5);
        foreach($tabS as $stat) {
            array_push($tab, $stat->get('nom_statut_espece'));
        }
        echo json_encode($tab);
    }

    public static function autocompleteAut() {
        $tabA = ModelNomenclature_espece::selectALLauthordate();
        sleep(0.5);
        echo json_encode($tabA);
    }

    
    
    //Associate an id status to it's name
    public static function associationStatus($esp_array) {
        $tab_name = array();
        $tab_id = array();
        foreach($esp_array as $esp) {
            array_push($tab_name, ModelStatut_genre::selectNameById($esp->get('id_statut'))); //tab of status name
            //array_push($tab_id);
        }
        return $tab_name;
    }
}