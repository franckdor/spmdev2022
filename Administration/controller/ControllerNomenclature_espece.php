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
        
        
        //$statut = ModelStatut_genre::selectNameById(10); //RETURN AN ARRAY
        //$st; 
        //GETTING NAME STATUS OUT OF ARRAY
        //foreach($statut as $stat) {
        //    $st = $stat->get('nom_statut_genre');    
        //}
        //Association status is not an "action", we don't need a new file for it.

        
        require_once File::build_path(array("view", "view.php"));
    }

    //Save data from form to db
    public static function created() {
        $view="created";
        $pagetitle="Admin créé";

        $espv = explode(" ", $_POST['espece_valide']); //The format of $_POST is "species" - "Genus" 
        $statut = ModelStatut_espece::SelectIdByName($_POST['statut']);
        $especeV = ModelEspece_valide::SelectIdByName($espv[0]);
        $data = array(
            'nom_espece' => $_POST['espece'],
            'nom_genre' => $_POST['genre'],
            'auteur_date' => $_POST['auteur'],
            'id_statut' => $statut[0]->get('id_statut_espece'),
            'id_espece_valide' => $especeV[0]->get('id_espece_valide'),
            'reference_page' => $_POST['page'],
            'utilisateur' => $_SESSION['login'],
            'dateadd' => date('d/m/Y', time()) 
         );   
        ModelNomenclature_espece::save($data);
        require_once File::build_path(array("view", "view.php"));
    }

    
    
    //Species form
    public static function requete() {
        $view="requete";
        $pagetitle="Créer espèces";
        $tab = ModelStatut_espece::selectALL();
        require_once File::build_path(array("view", "view.php"));
        
    }

    public static function autocompleteBiblio() {
        $biblio = ModelBibliographie::selectALL();
        sleep(0.5);
        echo json_encode(array(
            "biblio" => $biblio
        ));
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

    public static function OtherSpecies() {
        $other = $_GET["other"];
        $tab = explode(" - ", $other);

        $species = $tab[0];
        $genus = $tab[1];
        
        $tab_other = ModelNomenclature_espece::SelectSpeciesAndNameWhere($species, $genus);

        $tabjson = array();
        foreach($tab_other as $esp) {
            array_push($tabjson, $esp->getAll());
        }

        echo json_encode($tabjson);
    }
}