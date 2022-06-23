<?php
$idSpe = htmlspecialchars($esp->get('id_nomenclature_espece'));
$nameSpe = htmlspecialchars($esp->get('nom_espece'));
$nameGen = htmlspecialchars($esp->get('nom_genre'));
$rawUrlIdSpe = rawurlencode($esp->get('id_nomenclature_espece'));
$tab = $esp->getAll();

if(isset($_SESSION['login'])) {
    //echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '"     >Supprimer</a>');
    //echo '<br>';
    foreach($tab as $key => $esp) {
        echo $key . " => " . $esp . "<br>";
    }
    echo('<a href="?controller=nomenclature_espece&action=update&id=' . $rawUrlIdSpe . '"     >Modifier</a>');
    
    echo '<br>';
    ?>
    <a href="?action=delete&controller=nomenclature_espece&id= <?php echo rawurlencode($idSpe);   ?> " OnClick='return confirm("Etes vous sur ?")'>Supprimer</a>
<?php }