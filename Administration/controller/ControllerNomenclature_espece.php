<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
class ControllerNomenclature_espece {


    protected static $object = 'Nomenclature_espece';


    public static function readAll() {
        $view="list";
        $pagetitle="Liste des Espèces";
        $tab_esp = ModelNomenclature_espece::selectALL();
        $r = ModelNomenclature_espece::select(1);
        
        //$statut = ModelStatut_genre::selectNameById(10); //RETURN AN ARRAY
        //$st; 
        //GETTING NAME STATUS OUT OF ARRAY
        //foreach($statut as $stat) {
        //    $st = $stat->get('nom_statut_genre');    
        //}
        //Association status is not an "action", we don't need a new file for it.

        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read()
    {   
        
        $esp = ModelNomenclature_espece::select($_GET['id_nomenclature_espece']);
        
        $view = 'detail';
        $pagetitle = 'Détails de espèce';
        require File::build_path(array("view", "view.php"));
    }

    //Save data from form to db
    public static function created() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="created";
        $pagetitle="Admin créé";

        $espv = explode(" ", $_POST['espece_valide']); //The format of $_POST is "species" - "Genus" 
        $statut = ModelStatut_espece::SelectIdByName($_POST['statut']);
        $especeV = ModelEspece_valide::SelectIdByName($espv[0]);
        $code_biblio = ModelBibliographie::selectByAuthorYearTitleSource($_POST['biblio']);
        
        $data = array(
            'nom_espece' => $_POST['espece'],
            'nom_genre' => $_POST['genre'],
            'auteur_date' => $_POST['auteur'],
            'id_statut' => $statut[0]->get('id_statut_espece'),
            'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'reference_page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
            'dateadd' => date('d/m/Y', time()) ,
            'code_bibliographie' => $code_biblio[0]->get('code_bibliographie'),
         );   
        ModelNomenclature_espece::save($data);
        require_once File::build_path(array("view", "view.php"));
    }

    public static function errorPageIntrouvable() {
        $view="error";
        $pagetitle="Error";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }

        $espv = explode(" ", $_POST['espece_valide']); //The format of $_POST is "species" - "Genus" 
        $statut = ModelStatut_espece::SelectIdByName($_POST['statut']);
        $especeV = ModelEspece_valide::SelectIdByName($espv[0]);
        $code_biblio = ModelBibliographie::selectByAuthorYearTitleSource($_POST['biblio']);

        $data = array(
            'id_nomenclature_espece' => $_POST['id'],
            'nom_espece' => $_POST['espece'],
            'nom_genre' => $_POST['genre'],
            'auteur_date' => $_POST['auteur'],
            'id_statut' => $statut[0]->get('id_statut_espece'),
            'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'code_bibliographie' => $code_biblio[0]->get('code_bibliographie'),
            'reference_page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
            //'dateadd' => date('d/m/Y', time()),
        );
        ModelNomenclature_espece::update($data);
        $view = "updated";
        $pagetitle = "Specy Updated";
        require_once File::build_path(array("view", "view.php"));
    }

    
    
    //Species form
    public static function create() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view="update";
        $action="create";
        $pagetitle="Créer espèces";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
        
    }


    public static function update() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }

        if(!isset($_GET['id'])) {
            self::errorConnecte();
            exit();
        }

        $specy = ModelNomenclature_espece::select($_GET['id']);


        $id_valid_spe = $specy->get('id_espece_valide');
        $bibliography_id = $specy->get('code_bibliographie');

        $validSpe = ModelEspece_valide::select($id_valid_spe);
        if (!is_null($bibliography_id)) {
            $biblio = ModelBibliographie::select($bibliography_id);
            $page = explode(', ', $biblio->get('source'));
            $page =$page[count($page)-1];
            $page = explode("-", $page);
        }

        $action = 'updated';
        $view = 'update';
        $pagetitle = 'Update Specy';
        require_once File::build_path(array('view', "view.php"));
    }

    public static function autocompleteBiblio() {
        $biblio = ModelBibliographie::selectALL();
        $tabjson = array();
        foreach($biblio as $ref) {
            array_push($tabjson, $ref->getAll());
        }

        echo json_encode($tabjson);
    }

    public static function autocompleteText() {
        $text = $_GET['reference'];
        $title = ModelBibliographie::selectByRef($text);
        sleep(0.5);

        echo json_encode(array(
            "title" => $title));
    }

    //Action for JS autocompletion :
    public static function autocompleteEsp() {
        $tabE = ModelNomenclature_espece::selectAllNomEsp();
        sleep(0.5);
        echo json_encode($tabE);
        
    }

    public static function autocompleteEspV() {
        $tabE = ModelEspece_valide::selectAllNomEsp();
        sleep(0.5);
        echo json_encode($tabE);
        
    }

    public static function autocompleteEspVALID() {
        $tab = ModelEspece_valide::selectALL();

        sleep(0.5);
        $tabEV = array();
        foreach($tab as $EV) {
            array_push($tabEV, $EV->get('nom_espece') . " - " . $EV->get('nom_genre'));
        }

        echo json_encode($tabEV);
    }

    public static function autocompleteGenVALID() {
        $tab = ModelGenre_valide::selectALL();

        sleep(0.5);
        $tabGV = array();
        foreach($tab as $GV) {
            array_push($tabGV, $GV->get('nom_genre'));
        }

        echo json_encode($tabGV);
    }

    //CALL FOR autocompletion in JS request (url from js)
    public static function autocompleteGen() {
        $tabG = ModelNomenclature_genre::selectAllNomGen();
        
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

    public static function filler() {
        $tab_fill = ModelNomenclature_espece::selectAll();

        $tabjson = array();

        foreach($tab_fill as $fill)  {
            array_push($tabjson, $fill->getAll());
        }

        echo json_encode($tabjson);
    }
    
    public static function errorConnecte() {
        //IF YOU TRY TO ACCESS A ADMIN VIEW WITHOUT BEING CONNECTED
        $view = "errorConnecte";
        $pagetitle = "Access Denied";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function OtherSpecies() {
        $other = $_GET["other"];
        $tab = explode(" - ", $other);

        $species = $tab[0];
        $genus = $tab[1];
        
        $tab_other = ModelNomenclature_espece::SelectIdValidSpe($species, $genus);
        $tab_other = ModelNomenclature_espece::SelectByIdValidSpecies($tab_other[0]->get('id_espece_valide'));
        $tabjson = array();
        foreach($tab_other as $esp) {
            array_push($tabjson, $esp->getAll());
        }
        echo json_encode($tabjson);
    }

    public static function all() {
        $tab = ModelNomenclature_espece::selectALL();
        $tabjson = array();
        foreach($tab as $esp) {
            array_push($tabjson, $esp->getAll());
        }

        echo json_encode($tabjson);
    }
}