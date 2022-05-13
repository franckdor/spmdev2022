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
        $view = "update";
        $pagetitle = "Bibliographie";

        require_once File::build_path(array("view", "view.php"));

    }
}