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

        if(!isset($_GET['id'])) {
            echo "ERREUR LORS DU CHARGEMENT";
        }
        $biblio = ModelBibliographie::select($_GET['id']);
        $action = "updated";
        $view = "update";
        $pagetitle = "Bibliographie";

        require_once File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $log = $_GET['id'];
        $pagetitle="suppression";
        $view="deleted";
        ModelBibliographie::delete($_GET['id']);
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
        
        ModelRis::saveRis($_FILES['file']['tmp_name']);

        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        $data = array(
            'reference' => $_POST['reference'],
            'auteur' => $_POST['author'],
            'annee' => $_POST['year'],
            'titre' => $_POST['title'],
            'source' => $_POST['source'],
            'occurences' => $_POST['occ'],
            'tap' => $_POST['tap'],
            'resume' => $_POST['resume'],
            'code_bibliographie' => $_POST['code'],
        );       
        $view = "updated";
        $pagetitle = "Reference updated";
        ModelBibliographie::update($data);

        require_once File::build_path(array("view", "view.php"));
    }

    public static function created() {
        
        $data = array(
            'code_bibliographie' => $_POST['code'],
            'reference' => $_POST['reference'],
            'auteur' => $_POST['author'],
            'annee' => $_POST['year'],
            'titre' => $_POST['title'],
            'source' => $_POST['source'],
            'occurences' => $_POST['occ'],
            'tap' => $_POST['tap'],
            'resume' => $_POST['resume'],
        );       
        ModelBibliographie::save($data);
        $view = "created";
        $pagetitle = "Bibliographie Added";
        
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read() {
        if (!isset($_GET['id'])) {
            self::error("Id non pr??sent");
        }
        $biblio = ModelBibliographie::select($_GET['id']);
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
        $tabRepart = ModelRepartition::selectByCodeBiblio($_GET['code']);
        $i = 0;
        $tab = array();
        
        foreach($tabRepart as $repart) {
            $specy = ModelNomenclature_espece::select($repart->get('id_nomenclature_espece'));
            $pays = ModelPays::select($repart->get('id_pays'));
            $bioarea = ModelZone_biogeographique::select($pays->get('id_zone_biogeographique'));
            //$plant = ModelPlante_hote::select
            $tab[$i] = ['espece' => $specy->get('nom_espece'), 
            'genre' => $specy->get('nom_genre') , 
            'pays' => $pays->get('nom_pays'), 
            'zone' => $bioarea->get('nom_zone_biogeographique')];
            $i = $i+1;     
        }

        echo json_encode($tab);
    }


    public static function searchHostPlant() {
        $tabHost = ModelPlante_hote::selectByCodeBiblio(7);
        $i = 0;
        $tab = array();
        
        foreach($tabHost as $plant) {
            $id = $plant->get('id_plante');
            $hplant = ModelPlants::select($id);
            if (count($hplant) == 0) {
                break;
            } else {
                $specy = ModelNomenclature_espece::select($plant->get('id_nomenclature_espece'));
                $tab[$i] = ['espece' => $specy->get('nom_espece'), 
                'genre' => $specy->get('nom_genre') , 
                'specy_plant' => $hplant->get('species'), 
                'genus_plant' => $hplant->get('genus')];
                $i = $i+1;     
            }
        }

        echo json_encode($tab);
    }
}