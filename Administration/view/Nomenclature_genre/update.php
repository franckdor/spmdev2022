<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteGen.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptStat.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>

<div>
    <label for="select">Recherche : </label>
    <div>  
        <select id="select" name="select"  required></select>    
    </div>
</div>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>
    <fieldset>
    <legend><?php echo($_GET["action"] == "create" ? "Add Genus" : "Update Genus"); ?></legend>
        
            <label for="select-genre">Genre : </label>
            <div id="genus">  
                <select id="select-genre" name="genre"  required>
                    
                </select>    
            </div>
        <br>
        
            <label for="select-tribu">Tribu : </label> 
            <div id="tribe">   
                <select id="select-tribu" name="tribu" required></select>   
            </div>
        <br>
        <label for="select-sous-famille">Sous-Famille : </label>
        <div id="sub-family">
            <select id="select-sous-famille" name="sous-famille" required></select>
        </div>  

        <label for="select-family">Famille : </label>  
        <div id="family">
            <select id="select-family" name="family" ></select>
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
        <label for="bibliographie">Bibliographie : </label> 
        <br>
        <div>
            <select id="bibliographie" name="biblio" ></select>
        </div>
        <br>
            <textarea wrap="soft" id="biblio" readonly></textarea>
        <br>
        <label for="number">Page : </label>
        <input id="number" name="page" type="number" value="10">
        <br>
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>