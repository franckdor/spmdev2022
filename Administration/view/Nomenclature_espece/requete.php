<!-- We load JS here -->
<script type="text/javascript" src="controller/js/scriptGen.js" defer></script>
<script type="text/javascript" src="controller/js/scriptEsp.js" defer></script>
<script type="text/javascript" src="controller/js/scriptStat.js" defer></script>
<script type="text/javascript" src="controller/js/scriptAut.js" defer></script>
<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


<fieldset>
    <legend>Autocomplétion en Javascript</legend>
    <div>
        <label for="select-espece">Espece : </label>
        <div id="acdiv">    
            <input id="espece" name="espece" autocomplete="off" type="text" required>
            <div id="autocompletionESP"></div>
        </div>
    </div>
    <br>
    <div>
        <label for="select-genre">Genre : </label>
        <div id="acdiv">    
            <input id="genre" name="genre" autocomplete="off" type="text" required>
           
        </div>
    </div>
    <br>
    <div>
        <label for="select-authd">Auteur et Date : </label>
        <div id="acdiv">    
            <input id="authd" name="authd" autocomplete="off" type="text" required>
        </div>
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
            onblur='this.size=1;' onchange='this.size=1; this.blur()' required>
          
        </div>
    </div>
</fieldset>