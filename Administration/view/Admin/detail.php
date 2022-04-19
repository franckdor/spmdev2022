<?php
foreach($a as $cle) {
    echo htmlspecialchars($cle->getLogin())."<br>";
    echo htmlspecialchars($cle->getId());
    echo "<br>";
    if (isset($_SESSION['id'])) 
        echo "<a href=?action=delete&id=" . rawurlencode($cle->getId()). ">Supprimer</a>";
}
?>