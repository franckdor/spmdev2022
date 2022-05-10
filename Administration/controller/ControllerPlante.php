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
require_once File::build_path(array("model", "ModelPlante.php"));
class ControllerPlante {


    protected static $object = 'plante';


    public static function readAll() {
        $view="list";   
        $pagetitle="Liste des plantes";

        $tab_plante = ModelPlante::selectAll();

        $tab_spe = ModelNomenclature_espece::selectALL();

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
            'page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
            'date_maj' => date('d/m/Y', time()) 
         );   
        ModelGenres::save($data);
        require_once File::build_path(array("view", "view.php"));
    }

    
    
    //Species form
    public static function update() {
        $view="update";
        $pagetitle="Update gender";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
        
    }

    public static function biblio() {
        $tab = ModelBibliographie::selectAll();

        $tabjson = array();

        foreach($tab as $ref) {
            array_push($tabjson, $ref->getAll());
        }

        echo json_encode($tabjson);
    }
}