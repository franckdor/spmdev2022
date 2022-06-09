<?php
foreach ($repart as $r)
        echo '<p> Repart ' . htmlspecialchars($r->get('id_repartition')) . " <a href=?action=read&controller=repartition&id=" . rawurlencode($r->get('id_repartition')). ">Details</a> .</p>";
