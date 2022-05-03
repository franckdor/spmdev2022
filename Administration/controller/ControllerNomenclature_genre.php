<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelGenres.php"));
class ControllerNomenclature_genre {


    protected static $object = 'Nomenclature_genre';


    public static function readAll() {
        $view="list";   
        $pagetitle="Liste des Genres";


        

        $tab_gen = ModelGenres::selectALL();

        $tabjson = array();

        foreach($tab_gen as $gen) {
            $monarray = array("val1" => "toto",
            "val2" => 2);
            array_push($tabjson, $monarray);
        }
        echo json_encode($tabjson);

        //$statut = ModelStatut_genre::selectNameById(10); //RETURN AN ARRAY
        //$st; 
        //GETTING NAME STATUS OUT OF ARRAY
        //foreach($statut as $stat) {
        //    $st = $stat->get('nom_statut_genre');    
        //}
        //Association status is not an "action", we don't need a new file for it.

        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        $view="created";
        $pagetitle="Espèce créée";
        $statut = ModelStatut_genre::SelectIdByName($_POST['statut']);
        $especeV = ModelEspece_valide::SelectIdByName($_POST['espece_valide'], $_POST['genre_valide']);
        $data = array(
            'nom_espece' => $_POST['espece'],
            'nom_genre' => $_POST['genre'],
            'auteur_date' => $_POST['auteur'],
            'id_statut' => $statut[0]->get('id_statut_espece'),
            'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'who' => $_SESSION['login'],
            'dateadd' => date('d/m/Y', time()) 
         );   
        ModelNomenclature_espece::save($data);
        require_once File::build_path(array("view", "view.php"));
    }

    
    
    //Species form
    public static function update() {
        $view="update";
        $pagetitle="Liste des espèces";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
        
    }

    public static function autocomplete() {
        $tab_gen = ModelGenres::selectALL();

        sleep(0.5);

        $tabjson = array();
        foreach($tab_gen as $gen) {
            array_push($tabjson, $gen->getAll());
        }
        echo json_encode($tabjson);
    }
}