<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <div id="boxCenter">
                <a href="index.php?action=readAll">Admin list</a>
                <a href="index.php?action=create">CREER UN ADMIN</a>
                <a href="index.php?action=signIn">Se co</a>
        </div>
<?php

// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("view", static::$object, "$view.php"));
require $filepath;
?>
    </body>
</html>

