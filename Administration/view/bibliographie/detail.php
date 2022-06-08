<?php
    echo "<p>" . htmlspecialchars($biblio->get('code_bibliographie'))."</p>";
    echo "<p>" . htmlspecialchars($biblio->get('reference')) . "</p>" ;
    echo "<p>" . htmlspecialchars($biblio->get('auteur')) . "</p>";
    echo "<p>" . htmlspecialchars($biblio->get('annee')) . "</p>";
    echo "<p><em>" . htmlspecialchars($biblio->get('titre')) . "</em></p>";
    

    echo "<br>";
    if (isset($_SESSION['id'])) ?> 
        <a href="?action=delete&id= <?php echo rawurlencode($biblio->get('code_bibliographie')); ?> " OnClick='return confirm("Etes vous sur ?")'>Supprimer</a>
        <?php echo "<br>";
        echo "<a href=?action=update&controller=bibliographie&id=" . rawurlencode($biblio->get('code_bibliographie')).  ">Update</a";

?>