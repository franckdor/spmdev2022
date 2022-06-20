<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelGenre.php"));
require_once File::build_path(array("model", "ModelFamilles.php"));
require_once File::build_path(array("model", "ModelClassification.php"));

class ControllerNomenclature_genre {


    protected static $object = 'Nomenclature_genre';


    public static function readAll() {
        $view="list";   
        $pagetitle="Liste des Genres";

        $tab_fam = ModelFamilles::selectAll();

        $tab_gen = ModelNomenclature_genre::selectALL();

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
        $genus = ModelNomenclature_genre::select($_GET['id']);
    
        if ($genus) {
            $view="detail";
            $pagetitle="Detail ". $genus->get("genre");

            require_once File::build_path(array("view", "view.php")); 
        } else {

            $view = "errorGenus";
            require_once File::build_path(array("view", "view.php")); 
        }
    }

    public static function created() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="created";
        $pagetitle="Genus created";
        $statut = ModelStatut_genre::SelectIdByName($_POST['statut']);
        //REGISTER IN VALID_GENUS
        if ($statut[0]->get('id_statut_genre') == 10) {
            $data = array(
                'id_classification' => $_POST['tribeID'],
                'nom_genre' => $_POST['genre'],
                'code_bibliographie' => $_POST['code_biblio'],
                'reference_page' => $_POST['page'],
                'nom_genre' => $_POST['genre'],
            );
            $msg = "A new relation with Valid Genus has been created";
            ModelGenre_valide::save($data);
        }
        //$GenreV = ModelEspece_valide::SelectIdByName($_POST['espece_valide'], $_POST['genre_valide']);
        $data = array(
            'genre' => $_POST['genre'],
            'tribu' => $_POST['tribu'],
            'sous_famille' => $_POST['sous-famille'],
            'code_statut' => $statut[0]->get('id_statut_genre'),
            
            'code_famille' => 1,
            'code_reference' => $_POST['code_biblio'],
            //'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
            'date_maj' => date('d/m/Y', time()) 
         );   
         ModelNomenclature_genre::save($data);
        require_once File::build_path(array("view", "view.php"));
    }

    public static function create() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $action = "created";
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
        $genus = ModelNomenclature_genre::select($_GET['id']);

        $bibliography_id = $genus->get('code_reference');

        if (isset($bibliography_id)) {
        $biblio = ModelBibliographie::select($bibliography_id);
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
        if ($_POST['biblio'] !== '') {
            $code_biblio = ModelBibliographie::selectByAuthorYearTitleSource($_POST['biblio']);
        }

        if (empty($code_biblio)) {
            $data = array(
                'code_genre' => $_POST['id'],
                'genre' => $_POST['genre'],
                'tribu' => $_POST['tribu'],
                'sous_famille' => $_POST['sous-famille'],
                'code_statut' => $statut[0]->get('id_statut_genre'),
                'page' => $_POST['page'],
                'utilisateur' => $_SESSION['login'],
                'date_maj' => date('d/m/Y', time()),
            );
        } else {        
            $data = array(
                'code_genre' => $_POST['id'],
                'genre' => $_POST['genre'],
                'tribu' => $_POST['tribu'],
                'sous_famille' => $_POST['sous-famille'],
                'code_statut' => $statut[0]->get('id_statut_genre'),
                'code_reference' => $code_biblio[0]->get('code_bibliographie'),
                'page' => $_POST['page'],
                'utilisateur' => $_SESSION['login'],
                'date_maj' => date('d/m/Y', time()),
            );
        }
        ModelNomenclature_genre::update($data);
        $view="updated";
        $pagetitle="Genus Updated";
        require_once File::build_path(array('view', "view.php"));
    }

    public static function delete() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $id = $_GET['id'];
        $pagetitle="suppression";
        $view="deleted";

        $gen = ModelNomenclature_genre::select($id);

        if (isset($gen)) {
            ModelNomenclature_genre::delete($id);
        }

        if ($gen->get('code_genre_valide') !== null) {
            ModelGenre_valide::delete($gen->get('code_genre_valide'));
        }
        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function autocomplete() {

        $tab_gen = ModelNomenclature_genre::selectALL();


    $tabjson = array();
    foreach($tab_gen as $gen) {
        $biblio = ModelBibliographie::select($gen->get('code_reference'));
        if ($biblio == false) {
            $array = array(
                'gen' => $gen->getAll(),
            );
        } else {
            $array = array(
                'gen' => $gen->getAll(),
                'biblio' => $biblio->getAll(),
            );
        }
        array_push($tabjson, $array);
    }
    echo json_encode($tabjson);
    }

    public static function autocompleteF() {
        $tab_fam = ModelFamilles::selectAll();


        $tabjson = array();
        foreach($tab_fam as $fam) {
            array_push($tabjson, $fam->getAll());
        }
        echo json_encode($tabjson);
        
        //echo json_encode($tabF);
    }

    public static function selectTribe() {
        $tab = ModelClassification::selectTribe();

        $tabjson = array();
        foreach($tab as $tribe) {
            array_push($tabjson, $tribe->getIDandName());
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