<form method="POST" action=<?php echo "index.php?controller=".self::$object."&action=signedIn"; ?>>
    <fieldset>
        <legend>Connexion :</legend>
        <p>
            <label for="login_id">login</label> :
            <input type="text" name="login" id="login_id" required/>
            <br>
            <label for="login_id">mot de passe</label> :
            <input type="password" name="mdp" id="mdp_id" required/>
            <br>
            <?php
        if ($wrongInformations == true)
            echo '<p style="color:red">Le login ou le mot de passe entré sont incorrects</p>';
        ?>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>    