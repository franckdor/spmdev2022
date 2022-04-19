<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <div id="boxCenter">
                <a href="index.php?action=readAll">Admin list</a>
                <a href="index.php?action=home">Home</a>
                <?php if (!isset($_SESSION['id'])) {
                    echo '<a href="index.php?action=signIn">Se co</a>';
                }    
                if (isset($_SESSION['id'])) {
                    echo '<br>';
                    echo '<a href="index.php?action=create&controller=admin">Add Admin</a>';
                    echo " ";
                    echo '<a href="index.php?action=signOut&controller=admin">Se déconnecter</a>';
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

