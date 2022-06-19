<?php

    echo htmlspecialchars($a[0]->getLogin())."<br>";
    echo htmlspecialchars($a[0]->getId());
    echo "<br>";
    if (isset($_SESSION['id'])) 
            
            echo "<a href=?action=update&controller=admin&id=" . rawurlencode($a[0]->getId()).  ">Update</a";
            echo "<br>";
            if ($_SESSION['id'] !== $a[0]->getId()) {?>
       <a href="?action=delete&id= <?php echo rawurlencode($a[0]->getId());   ?> " OnClick='return confirm("Etes vous sur ?")'>Supprimer</a>
        <?php }
        
        

?>