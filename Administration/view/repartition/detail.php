<?php

foreach($tab as $key => $value) {
    
    if (is_array($value)) {
        foreach($value as $id =>$lvl) {
            echo $id . " => " . $lvl . "<br>";
        }
    } else {
        echo $key . " => " . $value . "<br>";
    }
        
}
if (isset($_SESSION['id'])) 
        echo "<a href=?action=delete&controller=repartition&id=" . rawurlencode($tab['id_repartition']). ">Supprimer</a>";
        echo "<br>";
        echo "<a href=?action=update&controller=repartition&id=" . rawurlencode($tab['id_repartition']).  ">Update</a";
    

?>