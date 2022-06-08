

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

require_once File::build_path(array("model", "Modelris.php"));
require_once File::build_path(array('vendor', 'autoload.php'));

$statut = ModelNomenclature_genre::Select(95);
var_dump($statut);

?>

<a href="index.php?action=delete&controller=admin&id=2" OnClick="return confirm('Effacer la le bazarre n°2')">HEHEHEHE</a>