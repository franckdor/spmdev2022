<?php
    foreach ($tab_admin as $a)
        echo '<p> Admin ' . htmlspecialchars($a->getLogin()) . " <a href=?action=read&login=" . rawurlencode($a->getLogin()). ">Details</a> .</p>";
?>

