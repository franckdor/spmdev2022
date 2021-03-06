<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/requete.js" defer></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBibliographie.js" defer></script>


<section>
    <form method="POST" enctype="multipart/form-data" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>

        <fieldset>

        
        <legend>Biblio</legend>

        <input type="text" id="id_biblio" name="code" value="<?php if(isset($biblio)) echo $biblio->get('code_bibliographie'); ?>" readonly />
        <div id="id">
        </div>
        <section>
            <label for="selectBiblio">Search :</label>    
            <select id="selectBiblio" name="searchs"  ></select>

            <label for="textTap">TAP :</label>
            <input id="textTap" placeholder="oui/non" name="tap" value="<?php if(isset($biblio)) echo $biblio->get('tap'); ?>" type="text" />

            <label for="textOcc">Occ :</label>
            <input id="textOcc" placeholder="RAS" name="occ" value="<?php if(isset($biblio)) echo $biblio->get('occurences'); ?>" type="text" />
        </section>
        
        <section id="AATS">

                <br>
                <label for="ref">Reference :</label>
            <input id="ref" placeholder="reference" name="reference" value="<?php if(isset($biblio)) echo $biblio->get('reference'); ?>" type="text" required/>
                <br>
                
                <label for="textAuthor">Author :</label>
                <input id="searchAuthor" name="author" value="<?php if(isset($biblio)) echo $biblio->get('auteur'); ?>"  type="text" required/>

                <br>
                <label for="date">Year :</label> 
                <input id="date" name="year" value="<?php if(isset($biblio)) echo $biblio->get('annee'); ?>" type="text" minlength="4" maxlength="4" required/>

                <label for="textSource">Source :</label>
                <input id="textSource" name="source" value="<?php if(isset($biblio)) echo $biblio->get('source'); ?>" type="text" required/>

                <br>
                <label for="textTitle">Title :</label> 
                <input id="textTitle" name="title" value="<?php if(isset($biblio)) echo $biblio->get('titre'); ?>" type="text" required/>


                
        
        </section>

        <section id="resume">
            <label for="textResume">resume :</label>
            <textarea id="textResume" name="resume"  ><?php if(isset($biblio)) echo $biblio->get('resume'); ?>
            </textarea>

        </section>

        <section>
            <div id="specy"></div>
            <div id ="synonyms"></div>
            <div id="repartition"></div>
            <div id="plants"></div>

        </section>
            <br>
            <input type="submit" value="Envoyer" />
        </fieldset>

        
    </form>
</section>