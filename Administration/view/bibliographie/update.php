<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<section>
    <form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>

        <fieldset>
                <legend>Biblio</legend>
                <label for="searchBiblio">Search></label>

                
                <input type="submit" value="Envoyer" />
        </fieldset>

        
        
    </form>
</section>