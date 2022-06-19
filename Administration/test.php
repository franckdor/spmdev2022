
<script type="text/javascript" src="controller/NomenclatureJS/scriptRecherche.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
require_once File::build_path(array("model", "ModelPlants.php"));
require_once File::build_path(array("model", "ModelPlante_hote.php"));
require_once File::build_path(array("model", "ModelClassification.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelPays.php"));

require_once File::build_path(array("model", "Modelris.php"));
require_once File::build_path(array('vendor', 'autoload.php'));

?>

<select id="bibliographie"></select>