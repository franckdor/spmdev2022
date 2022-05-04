<!-- We load JS here -->
<script type="text/javascript" src="controller/NomenclatureJS/scriptGen.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptEsp.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptStat.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptAut.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptEspV.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>
<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>
    <fieldset>
        <legend>Autocomplétion en Javascript</legend>
        
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
            <br>
            <textarea wrap="soft" id="biblio" readonly></textarea>
        </div>
        <br>
        <label for="number">Page : </label>
        <input id="number" name="page" type="number" value="10">
        <br>
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>