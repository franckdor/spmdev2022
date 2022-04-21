<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="view/style.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <div id="boxCenter">
                <a href="index.php?action=readAll">Admin list</a>
                <a href="index.php?action=home">Home</a>
                <?php //if you're not logged then you can connect
                if (!isset($_SESSION['id'])) {
                    echo '<a href="index.php?action=signIn">Login</a>';
                } //if you're logged, then this appears.   
                if (isset($_SESSION['id'])) {
                    echo '<br>';
                    echo '<a href="index.php?action=create&controller=admin">Add Admin</a>';
                    //echo " ";
                    echo '<a href="index.php?action=signOut&controller=admin">Deconnect</a>';
                    echo '<a href="index.php?action=readAll&controller=nomenclature_espece">Species</a>';
                    echo '<a href="index.php?action=requete&controller=nomenclature_espece&espece=">Species TEST</a>';
                }
                ?>
                
                
        </div>
<main>
    <?php

        // If $controller='Admin' and $view='list',
        // Then $filepath="/site_path/view/Admin/list.php"
        $filepath = File::build_path(array("view", static::$object, "$view.php"));
        if (file_exists($filepath)) {
            require $filepath;
        } else {
            $filepath = File::build_path(array("view", static::$object, "$view.html")); 
            require $filepath;
        }
    ?>
</main>    
    </body>
</html>

