<script type="text/javascript" src="controller/NomenclatureJS/requete.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptRepartition.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>

<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<section>
    <form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>

        <fieldset>
                <legend>Plants</legend>

                <!-- I put INPUT:HIDDEN before INPUT:CHECKBOX because I
                save a Boolean in plante_hote and PHP takes the last value 
                for the same name as the one to use.
                If there is not the INPUT:HIDDEN field in db is equal to NULL when
                unchecked  -->
                <input type="hidden" value='0' name="valid">
                <input type="checkbox" value='1' id="valid" name="valid" checked>
                <label for="valid">Valid</label>

                <br>
                
                <input type="hidden" value='0' name="original">
                <input type="checkbox" value='1' id="original" name="original" checked>
                <label for="original">Original</label>

                
                <input type="hidden" value='0'  name="synthesis">
                <input type="checkbox" value='1' id="synthesis" name="synthesis">
                <label for="synthesis">Synthesis/Catalogue</label>

                <br> 

                <label for="search-species">Search by Species: </label>
                    
                <div>  
                    <select id="search-species" name="searchs"  required></select>
                    <button id="buttonSpecies" class="species" type="button">>>></button>    
                </div>
                <textarea wrap="hard" id="species" readonly></textarea>

                <br> 
                
                <label for="bibliographie">Search by Ref : </label>
                    
                <div>  
                    <select id="bibliographie" name="ref"  required></select>
                    <button id="buttonRef" class="ref" type="button">>>></button>    
                </div>
                <textarea wrap="hard" id="biblio" readonly></textarea>

                <label for="search-plants">Search by Country : </label>

                <div>  
                    <select id="search-country" name="country"  required></select> 
                    <!--<button id="buttonPlants" class="plants" type="button">>>></button>-->
                </div>
                <textarea wrap="hard" id="country" readonly></textarea>
                <br>
                <input type="submit" value="Envoyer" />
        </fieldset>

        
        
    </form>
</section>