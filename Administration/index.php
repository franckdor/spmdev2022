<?php
//The pages that lauches automatically 
$DS = DIRECTORY_SEPARATOR;
$ROOT_FOLDER = __DIR__ ;
require_once $ROOT_FOLDER . $DS . 'lib' . $DS . 'File.php';
require_once File::build_path(array('controller','routeur.php'));
require_once File::build_path(array("lib", "security.php"));
?>

