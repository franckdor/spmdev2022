<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="view/styles/styles.css">
        <link rel="stylesheet" type="text/css" href="view/styles/completion.css">
        <link rel="stylesheet" type="text/css" href="view/styles/nomenclature_espece.css">
        <link rel="stylesheet" type="text/css" href="view/styles/bibliographie.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        
            <ul>
                <li><a href="index.php?action=readAll">Admin list</a></li>
                <li><a href="index.php?action=home">Home</a></li>
                <?php //if you're not logged then you can connect
                if (!Security::is_connected()) {
                    echo '<li><a href="index.php?action=signIn">Login</a></li>';
                } //if you're logged, then this appears.   
                if (Security::is_connected()) {
                    echo '<li><a href="index.php?action=create&controller=admin">Add Admin</a></li>';
                    //echo " ";
                    echo '<li id="aled"><a href="index.php?action=signOut&controller=admin">Deconnect</a></li>';
                    echo '<div class="dropdown-form">';
                    echo '<li class="parent-form"><p>Formulaires</p></li>';
                    echo '<div class="formulaires">';
                    echo '<li><a href="index.php?action=create&controller=nomenclature_espece">Species Add</a></li>';
                    echo '<li><a href="index.php?action=create&controller=nomenclature_genre">Genus Add</a></li>';
                    echo '<li><a href="index.php?action=update&controller=plants">HostPlants Add</a></li>';
                    echo '<li><a href="index.php?action=create&controller=bibliographie">Biblio Add</a></li>';
                    echo '<li><a href="index.php?action=addRis&controller=bibliographie">Ris ADD</a></li>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="dropdown-infos">';
                    echo '<li class="parent-form"><p>Infos</p></li>';
                    echo '<div class="infos">';
                    echo '<li><a href="index.php?action=readAll&controller=nomenclature_espece">Species</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=nomenclature_genre">Genus</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=plants">Plants</a></li>';
                    echo '<li><a href="index.php?action=readAll&controller=bibliographie">Biblio</a></li>';
                    echo '</div>';
                    echo '</div>';
                    
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

