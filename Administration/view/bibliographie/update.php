<!-- Library for INPUT SELECTOR -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<section>
    <form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>

        <fieldset>
    
        <legend>Biblio</legend>
        
        <section>
            <label for="searchBiblio">Search :</label>    
            <select id="searchBiblio" name="searchs"  required></select>

            <label for="textTap">TAP :</label>
            <input id="textTap" name="tap" type="text" />

            <label for="textOcc">TAP :</label>
            <input id="textOcc" name="occS" type="text" />
        </section>
        
        <section id="AATS">
                
                <label for="textAuthor">Author :</label>
                <select id="searchAuthor" name="author"  required></select>

                <br>

                <label for="textTitle">Title :</label> 
                <textarea id="textTitle" name="title"  required></textarea>

                <label for="textSource">Source :</label>
                <textarea id="textSource" name="source"  required></textarea>
        
        </section>

        <section id="resume">
            <label for="textResume">Title :</label>
            <textarea id="textResume" name="resume"  required></textarea>
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