  <form method="POST" action= <?php echo "index.php?controller=". self::$object . "&action=created"?>>
      <fieldset>
          <legend>Créer admin :</legend>
          <p>
            <label for="admin_id">Id</label> :
            <input type="text" placeholder="1" name="id" id="admin_id" required/>
          </p>
          <p>
              <label for="admin_log">Login</label> :
              <input type="text" placeholder="entrer un login" name="log" id="admin_log" required/>
          </p>
          <p>
              <label for="admin_pswd">Mot de passe</label> :
              <input type="password" name="pswd" id="admin_pswd" required/>
          </p>
          <p>
            <input type="submit" value="Envoyer" />
          </p>
      </fieldset> 
  </form>
