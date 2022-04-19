<?php

require_once File::build_path(array("model", "ModelAdmin.php"));
require_once File::build_path(array("lib", "Security.php"));

class ControllerAdmin {

    //Object 
    protected static $object = 'Admin';

    public static function readAll() {
        $view="list";
        $pagetitle="Liste des Admins";
        $tab_admin = ModelAdmin::selectALL();
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $view="detail";
        $a = ModelAdmin::getAdminByLog($_GET['login']);
        $pagetitle="Admin : ". $_GET['login'];
        require_once File::build_path(array("view", "view.php"));
    }

    public static function create() {
        $view="create";
        $pagetitle="créer un Admin";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function created() {
        $view="created";
        $pagetitle="Admin créé";
        $data = array(
            'id' => $_POST['id'],
            'login' => $_POST['log'],
            'mdp' => Security::hacher($_POST['pswd'])
        );   
        ModelAdmin::save($data);
        $tab_admin = ModelAdmin::selectALL();
        require_once File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        $log = $_GET['id'];
        $pagetitle="suppression";
        $view="deleted";
        ModelAdmin::delete($_GET['id']);
        $tab_admin = ModelAdmin::selectALL();
        require_once File::build_path(array("view", "view.php"));
    }

    public static function signedIn()
    {
        $log = $_POST['login'];
        $mdp_hash = Security::hacher($_POST['mdp']);
        //$validUser = ModelClients::checkPassword($log, $mdp_hash);
//        $codeClient = ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash);
        //if (!$validUser){//|| !ModelClients::checkNonce(ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash))) {
        //    self::signInError();
        //} else {
            $view = "home";
            $pagetitle = 'Profil Utilisateur';
            //open client session
            $_SESSION['id'] = ModelAdmin::getIdByLogAndMdp($log, $mdp_hash);
            $ad = ModelAdmin::select($_SESSION['id']);
            $_SESSION['login'] = $ad->get('login');
            require_once File::build_path(array('view', 'view.php'));
        //}
    }

    
    public static function errorPageIntrouvable() {
        $view="error";
        $pagetitle="error";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function signIn()
    {
        $view = "signIn";
        $pagetitle = 'Connexion';
        $wrongInformations = false;
        require_once File::build_path(array('view', 'view.php'));
    }

}
?>