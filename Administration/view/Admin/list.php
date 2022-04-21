<?php
//htmlspecialchars  Convert special characters to HTML entities
//same for rawurlencode

    foreach ($tab_admin as $a)
        echo '<p> Admin ' . htmlspecialchars($a->getLogin()) . " <a href=?action=read&login=" . rawurlencode($a->getLogin()). ">Details</a> .</p>";


/*
URLs must be encoded to avoid changing their meaning when inserting user-supplied data.
For example, we will have to escape the characters "?" and "=" since they allow to pass information in the URL with the query string format.
*/        
?>

