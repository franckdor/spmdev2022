<form method="POST" enctype="multipart/form-data" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>
<label for="file">Sélectionner le fichier à envoyer</label>
             <input type="file" id="file" name="file" accept=".ris">

             <input type="submit" value="Envoyer" />
