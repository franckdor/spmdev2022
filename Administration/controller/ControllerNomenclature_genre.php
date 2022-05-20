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

    public static function read() {
        if (!isset($_GET['id'])) {
            self::error("");
            exit();
        }
        $genus = ModelGenres::select($_GET['id']);

        $view="detail";
        $pagetitle="Detail ". $genus->get("genre");

        require_once File::build_path(array("view", "view.php")); 
    }

    public static function created() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="created";
        $pagetitle="Genus created";
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

    public static function create() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $action = "create";
        $view="update";
        $pagetitle="Update gender";
        require_once File::build_path(array("view", "view.php"));
        
    }
    
    
    //Species form
    public static function update() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        if (!isset($_GET['id'])) {
            self::error();
            exit();
        }
        $genus = ModelGenres::select($_GET['id']);

        $bibliography_id = $genus->get('code_reference');

        

        if (!is_null($bibliography_id)) {
            $biblio = ModelBibliographie::select($bibliography_id);

            $page = explode(', ', $biblio->get('source'));
            $page =$page[count($page)-1];
            $page = explode("-", $page);
        }
        

        $action = "updated";
        $view="update";
        $pagetitle="Create gender";
        require_once File::build_path(array("view", "view.php"));
        
    }

    static public function updated() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }

        $statut = ModelStatut_genre::SelectIdByName($_POST['statut']);
        $code_biblio = ModelBibliographie::selectByAuthorYearTitleSource($_POST['biblio']);

        $data = array(
            'code_genre' => $_POST['id'],
            'genre' => $_POST['genre'],
            'tribu' => $_POST['tribu'],
            'sous_famille' => $_POST['sous-famille'],
            'code_statut' => $statut[0]->get('id_statut_genre'),
            'code_reference' => $code_biblio[0]->get('code_bibliographie'),
            'page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
        );

        ModelGenres::update($data);
        $view="updated";
        $pagetitle="Genus Updated";
        require_once File::build_path(array('view', "view.php"));
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
        echo json_encode($tabjson);
        
        //echo json_encode($tabF);
    }

    public static function errorConnecte() {
        //IF YOU TRY TO ACCESS A ADMIN VIEW WITHOUT BEING CONNECTED
        $view = "errorConnecte";
        $pagetitle = "Access Denied";
        require_once File::build_path(array("view", "view.php"));
    }
}