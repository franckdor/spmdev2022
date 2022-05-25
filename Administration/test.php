<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));

$tab = ModelRepartition::selectByCodeBiblio(6936);
var_dump($tab);

?>
