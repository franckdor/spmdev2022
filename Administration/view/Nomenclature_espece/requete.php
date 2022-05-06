<!-- We load JS here -->
<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteSpe.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>
<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


<div>
    <label for="search-species">Search by Species: </label>
    <div>  
        <select id="search-species" name="searchs"  required></select>    
    </div>
</div>


<div>
    <label for="search-genus">Search by Genus : </label>
    <div>  
        <select id="search-genus" name="searchg"  required></select>    
    </div>
</div>


<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>
    <fieldset>
        <legend>Nomenclature Species</legend>
        
            <label for="select-espece">Espece : </label> 
            <div>  
                <select id="select-espece" name="espece" required></select>

            </div>
        <br>
        
            <label for="select-genre">Genre : </label>
            <div>  
                <select id="select-genre" name="genre"  required></select>    
            </div>
        <br>
        
            <label for="select-authd">Auteur et Date : </label> 
            <div>   
                <select id="select-authd" name="auteur" required></select>   
            </div>
        <br>
        <div>
            <label for="select-statut">Statut : </label>
            <br>
            <div id="acdiv">    
                <!--
                onfocus = overflow out of 10 opt
                blur = when you stop focus smth
                -->
                <select name="statut" id="statut" onfocus='this.size=10;' 
                onblur='this.size=1;' onchange='this.size=1; this.blur()' required></select>
            
            </div>
        </div>
        <label for="select-espece-valide">Espece Valide : </label>
        <div>
            <select id="select-espece-valide" name="espece_valide" required></select>
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