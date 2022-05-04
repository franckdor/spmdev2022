<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteGen.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptStat.js" defer></script>

<div>
    <label for="select">Recherche : </label>
    <div>  
        <select id="select" name="select"  required></select>    
    </div>
</div>

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
        <label for="select-sous-famille">Sous-Famille : </label>
        <div>
            <select id="select-sous-famille" name="sous-famille" required></select>
        </div>  

        <label for="select-family">Famille : </label>  
        <div>
            <select id="select-family" name="family" required></select>
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
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>