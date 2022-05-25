<?php 

require_once File::build_path(array("vendor", "autoload.php"));
require_once File::build_path(array("lib", "Ris.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "Modelris.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
use \LibRIS\RISReader;

class ControllerBibliographie {

    protected static $object = 'bibliographie';

    public static function readAll() {
        $view = "list";
        $pagetitle="Biblio list";

        $biblio = ModelBibliographie::selectAll(); 

        require_once File::build_path(array("view", "view.php"));
    }

    public static function create() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $action = "created";
        $view = "update";
        $pagetitle = "Bibliographie";


        require_once File::build_path(array("view", "view.php"));

    }

    public static function update() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $action = "updated";
        $view = "update";
        $pagetitle = "Bibliographie";

        require_once File::build_path(array("view", "view.php"));
    }

    public static function addRis() {
        $view = "addRis";
        $action = "addedRis";
        $pagetitle = "Add From file";
        
        require_once File::build_path(array("view", "view.php"));
    }


    public static function addedRis() {
        $view = "addedRis";
        $pagetitle = "Add From file";
        
        $reader = new RISReader();

        $reader->parseFile($_FILES['file']['tmp_name']);

        $infos = Ris::getAll($_FILES['file']['tmp_name']);

        foreach($infos as $data) {
            Modelris::save($data);      
        }

        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function created() {

        var_dump($_POST);       

        $view = "created";
        $pagetitle = "test";
        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read() {
        if (!isset($_GET['code_bibliographie'])) {
            self::error("Id non présent");
        }
        $biblio = ModelBibliographie::select($_GET['code_bibliographie']);
        $view = "detail";
        $pagetitle = "Info Reference";
        
        require_once File::build_path(array("view", "view.php"));

    }

    public static function errorConnecte() {
        //IF YOU TRY TO ACCESS A ADMIN VIEW WITHOUT BEING CONNECTED
        $view = "errorConnecte";
        $pagetitle = "Access Denied";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function error($m = "") {

        $message = $m;
        $view = "error";
        $pagetitle = "ERROR". $message;
        require_once File::build_path(array("view", "view.php"));
    }

    public static function searchRepart() {
        $tabRepart = ModelRepartition::selectByCodeBiblio(6936);
        $i = 0;
        $tab = array();
        
        foreach($tabRepart as $repart) {
            $specy = ModelNomenclature_espece::select($repart->get('id_nomenclature_espece'));
            $pays = ModelPays::select($repart->get('id_pays'));
            $bioarea = ModelZone_biogeographique::select($pays->get('id_zone_biogeographique'));
            $tab[$i] = ['espece' => $specy->get('nom_espece'), 
            'genre' => $specy->get('nom_genre') , 
            'pays' => $pays->get('nom_pays'), 
            'zone' => $bioarea->get('nom_zone_biogeographique')];
            $i = $i+1;     
        }

        echo json_encode($tab);
    }
}