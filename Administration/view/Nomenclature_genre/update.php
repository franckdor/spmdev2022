<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteGen.js" defer></script>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=updated"?>>
    <fieldset>
        <legend>Update Nomenclature Gender</legend>
        
            <label for="select-genre">Genre : </label>
            <div>  
                <select id="select-genre" name="genre"  required></select>    
            </div>
        <br>
        
            <label for="select-tribu">Tribu : </label> 
            <div>   
                <select id="select-tribu" name="tribu" required></select>   
            </div>
        <br>
            <label for="select-statut">Statut : </label>
            <div id="acdiv">    
                <!--
                onfocus = overflow out of 10 opt
                blur = when you stop focus smth
                -->
                <select name="statut" id="statut" onfocus='this.size=10;' 
                onblur='this.size=1;' onchange='this.size=1; this.blur()' required></select>
            
            </div>
        <br>
        <label for="select-espece-valide">Espece Valide : </label>
        <div>
            <select id="select-espece-valide" name="espece_valide" required></select>
        </div>  

        <label for="select-genre-valide">Genre Valide : </label>  
        <div>
            <select id="select-genre-valide" name="genre_valide"  required></select>
        </div>
        <br>
        <label for="bibliographie">Bibliographie : </label> 
        <br>
        <div>
            <select id="bibliographie" name="biblio" ></select>
        </div>
        <br>
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>