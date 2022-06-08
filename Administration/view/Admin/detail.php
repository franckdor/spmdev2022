<?php
foreach($a as $cle) {
    echo htmlspecialchars($cle->getLogin())."<br>";
    echo htmlspecialchars($cle->getId());
    echo "<br>";
    if (isset($_SESSION['id'])) ?>
       <a href="?action=delete&id= <?php echo rawurlencode($cle->getId());   ?> " OnClick='return confirm("Etes vous sur ?")'>Supprimer</a>;
        <?php
        echo "<br>";
        echo "<a href=?action=update&controller=admin&id=" . rawurlencode($cle->getId()).  ">Update</a";
}
?>