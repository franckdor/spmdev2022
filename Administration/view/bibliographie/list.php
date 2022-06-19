<?php
    echo "<p>Bibliographie : <br>";
foreach($biblio as $ref) {
    $urlprimary = rawurlencode($ref->get('code_bibliographie'));
    $htmlprimary = htmlspecialchars($ref->get('code_bibliographie'));
    $htmlAuthor = htmlspecialchars($ref->get('auteur'));
    $htmlTitle = htmlspecialchars($ref->get('titre'));

    if (isset($_SESSION['login'])) { ?>
        
            identifiant : <a href="index.php?action=read&controller=bibliographie&id=<?php echo $urlprimary; ?>">
            <?php echo $htmlprimary; ?> </a> <br>
            <?php echo $htmlAuthor . "<br>" . $htmlTitle  ?> </p>

<?php
    }
    
 }

?>