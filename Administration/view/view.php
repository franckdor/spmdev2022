<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="view/styles/styles.css">
        <link rel="stylesheet" type="text/css" href="view/styles/completion.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        
            <ul>
                <li><a href="test.php">TEST</a></li>
                <li><a href="index.php?action=readAll">Admin list</a></li>
                <li><a href="index.php?action=home">Home</a></li>
                <?php //if you're not logged then you can connect
                if (!isset($_SESSION['id'])) {
                    echo '<li><a href="index.php?action=signIn">Login</a></li>';
                } //if you're logged, then this appears.   
                if (isset($_SESSION['id'])) {
                    echo '<li><a href="index.php?action=create&controller=admin">Add Admin</a></li>';
                    //echo " ";
                    echo '<li><a href="index.php?action=signOut&controller=admin">Deconnect</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=nomenclature_espece">Species</a></li>';
                    echo '<li><a href="index.php?action=requete&controller=nomenclature_espece">Species Add</a></li>';
                    echo '<li><a href="index.php?action=update&controller=nomenclature_genre">Genus Add</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=nomenclature_genre">Genus</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=plants">Plants</a></li>';
                    echo '<li><a href="index.php?action=update&controller=plants">Plants Add</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=bibliographie">Biblio</a></li>';
                    echo '<li><a href="index.php?action=update&controller=bibliographie">Biblio Add</a></li>';
                }
                ?>
            </ul>    
                
        <!-- Main content -->
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

