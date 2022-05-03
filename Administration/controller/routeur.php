<?php
session_start();

//Require all controllers.
require_once File::build_path(array("controller", "ControllerAdmin.php"));
require_once File::build_path(array("controller", "ControllerNomenclature_espece.php"));
require_once File::build_path(array("controller", "ControllerNomenclature_genre.php"));

$controller_default = 'Admin';

// Recovery of the controller variable
$controller = $controller_default; // Default controller if nothing is specified
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Verification that the controller exists
$controller_class = 'Controller' . ucfirst($controller);
if (!class_exists($controller_class)) {
    ControllerAdmin::errorPageIntrouvable();
    exit();
}

$action = 'readAll';
 
// Retrieval of the action variable
if (isset($_GET['action'])) { // Default actions if nothing is specified
    $action = $_GET['action'];
}

// Verification that the action exists in the class
$methodes = get_class_methods($controller_class);
if (!in_array($action, $methodes)) {
    $controller_class::errorPageIntrouvable();
    exit();
}


//Execution of action by the controller class.
$controller_class::$action();