<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="controller/NomenclatureJS/scriptBibliographie.js" defer></script>


<section>
    <form method="POST" enctype="multipart/form-data" action= <?php echo "index.php?controller=". self::$object . "&action=" . $action . '>'?>

        <fieldset>
    
        <legend>Biblio</legend>

        <input type="text" id="id_biblio" name="code" readonly />
        
        <section>
            <label for="selectBiblio">Search :</label>    
            <select id="selectBiblio" name="searchs"  ></select>

            <label for="textTap">TAP :</label>
            <input id="textTap" placeholder="oui/non" name="tap" type="text" />

            <label for="textOcc">Occ :</label>
            <input id="textOcc" placeholder="RAS" name="occ" type="text" />
        </section>
        
        <section id="AATS">
                
                <label for="textAuthor">Author :</label>
                <input id="searchAuthor" name="author"  type="text"/>

                <br>
                <label for="date">Year :</label> 
                <input id="date" name="year" type="text" minlength="4" maxlength="4" />

                <label for="textTitle">Title :</label> 
                <input id="textTitle" name="title" type="text" />


                <label for="textSource">Source :</label>
                <input id="textSource" name="source" type="text" />
        
        </section>

        <section id="resume">
            <label for="textResume">resume :</label>
            <textarea id="textResume" name="resume"  ></textarea>

            
        </section>

        <section>
            <div id="specy"></div>
            <div id ="synonyms"></div>
            <div id="repartition"></div>
            <div id="plants"></div>

        </section>
                
            <input type="submit" value="Envoyer" />
        </fieldset>

        
    </form>
</section>