<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <div id="boxCenter">
                <a href="index.php?action=readAll">Admin list</a>
                <a href="index.php?action=signIn">Se co</a>
                <a href="index.php?action=home">home</a>
                <?php
                if (isset($_SESSION['id'])) {
                    echo '<a href="index.php?action=signOut&controller=admin">Se déconnecter</a>';
                    echo '<br>';
                    echo '<a href="index.php?action=create&controller=admin">CREER UN ADMIN</a>';
                }
                ?>
        </div>
<?php

// If $controller='Admin' et $view='list',
// Then $filepath="/chemin_du_site/view/Admin/list.php"
$filepath = File::build_path(array("view", static::$object, "$view.php"));
require $filepath;
?>
    </body>
</html>

