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
require_once File::build_path(array("model", "ModelPlants.php"));
require_once File::build_path(array("model", "ModelPlante_hote.php"));

class ControllerPlants {


    protected static $object = 'plants';


    public static function readAll() {
        $view="list";   
        $pagetitle="Liste des plantes";

        $tab_plante = ModelPlants::selectAll();

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
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="updated";
        $pagetitle="Genre créée";
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
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="update";
        $pagetitle="Update plants";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
        
    }

    public static function created() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="created";
        $pagetitle="Create Nomenclature Host Plant";
        var_dump($_POST);
        $id_plant = ModelPlants::SelectId($_POST['plants']);
        $id_species = ModelNomenclature_espece::SelectID_GenusSpeciesStatusRef($_POST['searchs']);
        $id_bibliographie = ModelBibliographie::selectIdByTitle($_POST['ref']);
        
        $data = array(
            "id_plante" => $id_plant[0]->get('plant_ID'),
            "id_nomenclature_espece" => $id_species[0]->get('id_nomenclature_espece'),
            "code_bibliographie" => $id_bibliographie[0]->get('code_bibliographie'),
            "utilisateur" => $_SESSION['login'],
            "date_add" => date('d/m/Y', time()),
            "original_data" => $_POST['original'],
            "synthesis" => $_POST['synthesis'],
            "valid" => $_POST['valid'],
        );
        ModelPlante_hote::save($data);
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

    public static function searchPlant() {
        $tab = ModelPlants::SelectAll();
        $tabjson = array();
        foreach($tab as $plant) {
            array_push($tabjson, $plant->getSpeGen());
        }
        echo json_encode($tabjson);
    }

    public static function errorConnecte() {
        //IF YOU TRY TO ACCESS A ADMIN VIEW WITHOUT BEING CONNECTED
        $view = "errorConnecte";
        $pagetitle = "Access Denied";
        require_once File::build_path(array("view", "view.php"));
    }
}