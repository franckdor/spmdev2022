<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/requete.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptAutocompleteGen.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptStat.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBiblio.js" defer></script>



<div>
    <label for="select">Recherche : </label>
    <div>  
        <select id="select" name="select"  required></select>    
        <button type="button" id="infos_genus">Genre</button>
    </div>
</div>

<form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>
    <fieldset>
    <legend><?php echo($_GET["action"] == "create" ? "Add Genus" : "Update Genus"); ?></legend>

    <?php if ($_GET["action"] == "update") { ?>
          <p>
            <label for="specy_id">Id</label> :
            <input <?php if (isset($genus)) {echo 
            "value=".htmlspecialchars($genus->get('code_genre'));
            } ?>
             type="text" name="id" id="genus_id" readonly/>
          </p>
          <?php } ?>
        
            <label for="select-genre">Genre : </label>
            <div id="genus">  
                <select id="select-genre" name="genre"  required>
                    <?php if(isset($genus)) { ?>
                        <option value="<?php echo htmlspecialchars($genus->get('genre')); ?>"></option>
                  <?php  } ?>
                </select>    
            </div>
        <br>
            
            <label for="select-tribu">Tribu : </label> 
            <input id="tribeID" name="tribeID" type="hidden" />
            <div id="tribe">   
                <select id="select-tribu" name="tribu" required>
                <?php if(isset($genus)) { ?>
                        <option value="<?php echo htmlspecialchars($genus->get('tribu')); ?>"></option>
                  <?php  } ?>
                </select>   
            </div>
        <br>
        <label for="select-sous-famille">Sous-Famille : </label>
        <div id="sub-family">
            <select id="select-sous-famille" name="sous-famille" required>
            <?php if(isset($genus)) { ?>
                        <option value="<?php echo htmlspecialchars($genus->get('sous_famille')); ?>"></option>
                  <?php  } ?>
            </select>
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
            <select name="statut" id="statut" required>
            <?php if(isset($genus)) { ?>
                    <option value="<?php echo htmlspecialchars($genus->getAll()['statut']); ?>" ></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <label for="bibliographie">Bibliographie : </label> 
        <br>
        <div>
            <select id="bibliographie" name="biblio" >
            <?php if(isset($biblio)) { ?>
                    <option value="<?php echo htmlspecialchars($biblio->get('auteur')." - ".$biblio->get('annee')." - ".$biblio->get('titre')." - ".$biblio->get('source')); ?>"
                    attr="<?php echo $biblio->get('code_bibliographie') ?>"></option>
                <?php } ?>
            </select>
        </div>
        <br>
            <textarea wrap="soft" id="biblio" readonly><?php if(isset($biblio)) {
            echo $biblio->get('auteur')." - ".$biblio->get('annee')." - ".$biblio->get('titre')." - ".$biblio->get('source');
                } ?>
            </textarea>
            <input id="code_biblio" name="code_biblio" type="hidden" />

        <br>
        <label for="number">Page : </label>
        <input id="number" name="page" type="number" <?php if(isset($page)) { ?> min="<?php echo $page[0]; ?>" 
        max="<?php echo $page[0]; ?>" 
        <?php } ?> value="<?php if (isset($page)) echo $page[0]; ?>">
        <br>
        <input type="submit" value="Envoyer" />
    </fieldset>
</form>