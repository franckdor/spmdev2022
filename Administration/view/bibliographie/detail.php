<?php
    echo "<p>" . htmlspecialchars($biblio->get('code_bibliographie'))."</p>";
    echo "<p>" . htmlspecialchars($biblio->get('reference')) . "</p>" ;
    echo "<p>" . htmlspecialchars($biblio->get('auteur')) . "</p>";
    echo "<p>" . htmlspecialchars($biblio->get('annee')) . "</p>";
    echo "<p><em>" . htmlspecialchars($biblio->get('titre')) . "</em></p>";
    

    echo "<br>";
    if (isset($_SESSION['id'])) 
        echo "<a href=?action=delete&id=" . rawurlencode($biblio->get('code_bibliographie')). ">Supprimer</a>";
        echo "<br>";
        echo "<a href=?action=update&controller=bibliographie&id=" . rawurlencode($biblio->get('code_bibliographie')).  ">Update</a";

?>