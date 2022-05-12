<?php
    echo "<p>Espèces de taxon : <br>";
foreach($tab_esp as $spe) {
    $urlprimary = rawurlencode($spe->get('id_nomenclature_espece'));
    $htmlprimary = htmlspecialchars($spe->get('id_nomenclature_espece'));
    $htmlSpecies = htmlspecialchars($spe->get('nom_espece'));
    $htmlGenus = htmlspecialchars($spe->get('nom_genre'));

    if (isset($_SESSION['login'])) { ?>
        
            <a href="http://admin/index.php?action=read&controller=nomenclature_espece&id_nomenclature_espece=<?php echo $urlprimary; ?>">
                <?php echo $htmlSpecies . " " . $htmlGenus  ?> </a>et d'identifiant <?php echo $htmlprimary; ?> </p>

<?php
    }

 }

?>