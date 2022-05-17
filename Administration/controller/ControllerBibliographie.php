<?php 

require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelEspece_valide.php"));
require_once File::build_path(array("model", "ModelGenre_valide.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelRepartition.php"));

class ControllerBibliographie {

    protected static $object = 'bibliographie';

    public static function readAll() {
        $view = "list";
        $pagetitle="Biblio list";

        $biblio = ModelBibliographie::selectAll(); 

        require_once File::build_path(array("view", "view.php"));
    }

    public static function update() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        $view = "update";
        $pagetitle = "Bibliographie";

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
}