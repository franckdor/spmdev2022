<script type="text/javascript" src="controller/NomenclatureJS/scriptPlante.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>
<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>

    <fieldset>
            <legend>Plants</legend>

            <input type="checkbox" id="valid" name="valid" checked>
            <label for="valid">Valid</label>

            <br>

            

            <input type="checkbox" id="original" name="original" checked>
            <label for="original">Original</label>

            <input type="checkbox" id="synthesis" name="synthesis">
            <label for="synthesis">Synthesis/Catalogue</label>

            <br> 

            <label for="search-species">Search by Species: </label>
                
            <div>  
                <select id="search-species" name="searchs"  required></select>    
            </div>

            <br> 
            
            <label for="bibliographie">Search by Ref : </label>
                
            <div>  
                <select id="bibliographie" name="ref"  required></select>    
            </div>
            <textarea wrap="soft" id="biblio" readonly></textarea>
    </fieldset>

    
    
</form>