<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelGenres.php"));
require_once File::build_path(array("model", "ModelFamilles.php"));
class ControllerNomenclature_genre {


    protected static $object = 'Nomenclature_genre';


    public static function readAll() {
        $view="list";   
        $pagetitle="Liste des Genres";

        $tab_fam = ModelFamilles::selectAll();

        $tab_gen = ModelGenres::selectALL();

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
        $view="updated";
        $pagetitle="Genre créée";
        var_dump($_POST);
        $statut = ModelStatut_genre::SelectIdByName($_POST['statut']);
        //$GenreV = ModelEspece_valide::SelectIdByName($_POST['espece_valide'], $_POST['genre_valide']);
        $data = array(
            'genre' => $_POST['genre'],
            'tribu' => $_POST['tribu'],
            'sous_famille' => $_POST['sous-famille'],
            'code_statut' => $statut[0]->get('id_statut_genre'),
            //'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'utilisateur' => $_SESSION['login'],
            'date_maj' => date('d/m/Y', time()) 
         );   
        ModelGenres::save($data);
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

    public static function autocompleteF() {
        $tab_fam = ModelFamilles::selectAll();

        sleep(0.5);

        $tabjson = array();
        foreach($tab_fam as $fam) {
            array_push($tabjson, $fam->getAll());
        }

        foreach($tabjson as $data) {
            foreach($data as $key => $value) {
                echo $key . " ";
                echo $value . "<br>";
            }
        }
    }
}