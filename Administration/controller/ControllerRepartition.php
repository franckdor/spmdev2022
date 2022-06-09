<?php

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
require_once File::build_path(array("model", "ModelContinent.php"));
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
require_once File::build_path(array("model", "ModelGeo_lien_level4_pays.php"));
require_once File::build_path(array("model", "ModelNote.php"));


class ControllerRepartition {

    protected static $object = 'repartition';

    public static function readAll() {
        $view = "list";
        $pagetitle="List Répartition";

        $repart = ModelRepartition::selectAll(); 

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
        $pagetitle = "Repartition";

        require_once File::build_path(array("view", "view.php"));
    }


    public static function updated() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view = "updated";
        $pagetitle = "Repartition";

        $data = array(

        );
    }


    public static function read() {
        if (!isset($_GET['id'])) {
            self::error("");
            exit();
        }
        $repart = ModelRepartition::select($_GET['id']);
        $id_repart = $repart->get('id_repartition');
        $id_biblio = $repart->get('code_bibliographie');
        $biblio = ModelBibliographie::select($id_biblio);
        $id_pays = $repart->get('id_pays');
        $pays = ModelPays::select($id_pays);
        $id_continent = $pays->get('id_continent');
        $continent = ModelContinent::select($id_continent);
        $id_zone_bio = $pays->get('id_zone_biogeographique');
        $zone = ModelZone_biogeographique::select($id_zone_bio);
        $level4 = ModelGeo_lien_level4_pays::selectByIdPays($id_pays);

        foreach($level4 as $lvl) {
            $array = array(
                $lvl->get('id_level4') => $lvl->get('nom_level4'));
        }

        $tab = array(
            'id_repartition' => $id_repart,
            'nom_pays' => $pays->get('nom_pays'),
            'nom_continent' => $continent->get('nom_continent'),
            'nom_zone_biogeographique' => $zone->get('nom_zone_biogeographique'),
            'level4' => $array,
        );

        $view="detail";
        $pagetitle="Detail ". $repart->get("id_repartition");

        require_once File::build_path(array("view", "view.php")); 
    }


    public static function selectCountry() {
        $tab = ModelPays::selectAll();

        $tabjson = array();
        foreach($tab as $country) {
            
            array_push($tabjson, array('pays' => $country->get('nom_pays'),
            'zone_biogeo' => ModelZone_biogeographique::select($country->get('id_zone_biogeographique'))->get('nom_zone_biogeographique'),)
            );
            
        }

        echo json_encode($tabjson);
    }

}