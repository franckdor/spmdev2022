<?php
foreach($a as $cle) {
    echo htmlspecialchars($cle->getLogin())."<br>";
    echo htmlspecialchars($cle->getId());
    echo "<a href=?action=delete&id=" . rawurlencode($cle->getId()). ">Supprimer</a>";
}
?>