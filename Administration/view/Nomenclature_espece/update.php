<!-- We load JS here -->

<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteSpe.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptStat.js" defer></script>


<?php if ($action != "create") { ?>
    <script type="text/javascript" src="controller/UpdateJS/nomenclature_specy.js" defer></script>

<?php } ?>

<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<?php //if($action == "create") { ?>
    
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
<?php// } ?>
<?php if ($_GET["action"] == "update") { ?>
          <p>
            <label for="specy_id">Id</label> :
            <input <?php if (isset($specy)) {echo 
            "value=".$specy->get('id_nomenclature_espece');
            } ?>
             type="text" placeholder="1" name="id" id="specy_id" readonly/>
          </p>
          <?php } ?>   

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>
    <fieldset>
        <legend><?php echo($_GET["action"] == "create" ? "Add Specy" : "Update Specy"); ?></legend>
        
            <label for="select-espece">Espece : </label> 
            <div>  
                <select id="select-espece" name="espece" required>
                <?php if(isset($specy)) { 
                        echo '<option value='. $specy->get('nom_espece') . '></option>'; ?>
                <?php } ?>
                </select> 
            </div>
        <br>
        
            <label for="select-genre">Genre : </label>
            <div>  
                <select id="select-genre" name="genre"  required>
                <?php if(isset($specy)) { 
                        echo '<option value='. $specy->get('nom_genre') . '></option>'; ?>
                <?php } ?>
                </select>    
            </div>
        <br>
            <label for="select-authd">Auteur et Date : </label> 
            <div>   
                <select id="select-authd" name="auteur" required>
                <?php if(isset($specy)) { ?>
                    <option value=" <?php echo $specy->get('auteur_date'); ?>" ></option>
                <?php } ?>
                </select>   
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
                <select name="statut" id="statut" required>
                <?php if(isset($specy)) { ?>
                    <option value="<?php echo $specy->getAll()['statut']; ?>" ></option>
                <?php } ?>
                </select>
            
            </div>
        </div>
        <label for="select-espece-valide">Espece Valide : </label>
        <div>
            <select id="select-espece-valide" name="espece_valide" required>
            <?php if(isset($validSpe)) { ?>
                    <option value="<?php echo $validSpe->get('nom_espece') . " - " . $validSpe->get('nom_genre'); ?>" ></option>
                <?php } ?>
            </select>
            <button id="button" class="other-species" name="other" type="button">>>></button>
        </div>  
        <br>
        <div id="p"></div>
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