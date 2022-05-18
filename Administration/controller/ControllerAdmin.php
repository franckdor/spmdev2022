<?php

require_once File::build_path(array("model", "ModelAdmin.php"));
require_once File::build_path(array("lib", "Security.php"));

class ControllerAdmin {

    protected static $object = 'Admin';

    public static function home()
    {
        //renvoyer sur l'affichage du compte si connecté
        //proposer la connexion et l'inscription si non
        $view = 'home';
        $pagetitle = 'Connexion';
        require_once File::build_path(array('view', 'view.php'));
    }

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
        $action = "created";
        $methodName = "created";
        $view="update";
        $pagetitle="créer un Admin";
        require_once File::build_path(array("view", "view.php"));
    }

    public static function created() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
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
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
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
        $validUser = ModelAdmin::checkPasswd($log, $mdp_hash);
//        $codeClient = ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash);
        if (!$validUser){//|| !ModelClients::checkNonce(ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash))) {
            self::signInError();
        } else {
            $view = "home";
            $pagetitle = 'Profil Utilisateur';
            //open client session
            $_SESSION['id'] = ModelAdmin::getIdByLogAndMdp($log, $mdp_hash);
            $ad = ModelAdmin::select($_SESSION['id']);
            $_SESSION['login'] = $ad->get('login');
            require_once File::build_path(array('view', 'view.php'));
        }
    }

    public static function update() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }
        if(!isset($_GET['id'])) {
            self::errorConnecte();
            exit();
        }
        //id : Record primary key
        $admin = ModelAdmin::select($_GET['id']);
        $action = 'updated';
        $view = 'update';
        $pagetitle = 'Update Admin';
        require_once File::build_path(array('view', "view.php"));
    }

    public static function updated() {
        if (Security::is_connected() == false) {
            self::errorConnecte();
            exit();
        }

        $data = array(
            'id' => $_POST['id'],
            'login' => $_POST['log'],
        );

        if (!$_POST['pswd'] == "") {
            $data['mdp'] = Security::hacher($_POST['pswd']);
        }

        ModelAdmin::update($data);

        if ($_SESSION['id'] == $_POST['id']) {
            $view = "home";

        } else {$view = 'list';}
        
        $pagetitle = "Admin modified";
        require_once File::build_path(array("view", "view.php"));
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

    public static function signOut()
    {
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
            unset($_SESSION['login']);
            session_destroy();
        }
        return static::home();
    }

    public static function signInError()
    {
        $view = "signIn";
        $pagetitle = 'Connexion';
        $wrongInformations = true;
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function errorConnecte() {
        //IF YOU TRY TO ACCESS A ADMIN VIEW WITHOUT BEING CONNECTED
        $view = "errorConnecte";
        $pagetitle = "Access Denied";
        require_once File::build_path(array("view", "view.php"));
    }

}
?>