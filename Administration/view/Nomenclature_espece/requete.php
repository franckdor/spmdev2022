<!-- We load JS here -->
<script type="text/javascript" src="controller/js/scriptGen.js" defer></script>
<script type="text/javascript" src="controller/js/scriptEsp.js" defer></script>
<script type="text/javascript" src="controller/js/scriptStat.js" defer></script>
<script type="text/javascript" src="controller/js/scriptAut.js" defer></script>
<script type="text/javascript" src="controller/js/scriptEspV.js" defer></script>
<script type="text/javascript" src="controller/js/scriptGenV.js" defer></script>
<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>
    <fieldset>
        <legend>Autocomplétion en Javascript</legend>
        <div>
            <label for="select-espece">Espece : </label>   
                <select id="select-espece" name="espece" required>
                    </select>
                
        </div>
        <br>
        <div>
            <label for="select-genre">Genre : </label>  
                <select id="select-genre" name="genre"  required>
                </select>
                
        </div>
        <br>
        <div>
            <label for="select-authd">Auteur et Date : </label>    
                <select id="select-authd" name="auteur" required></select>
                
        </div>
        <br>
        <div>
            <label for="select-statut">Statut : </label>
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
        <select id="select-espece-valide" name="espece_valide" required></select>


        <label for="select-genre-valide">Genre Valide : </label>  
        <select id="select-genre-valide" name="genre-valide"  required></select>


        <input type="submit" value="Envoyer" />
    </fieldset>
</form>