<form method="POST"
      action=<?php echo "index.php?controller=" . self::$object . "&action=" . $action . '>' ?>
    
      <fieldset>
      <legend><?php echo($_GET["action"] == "create" ? "Créer un admin" : "Modifier un admin"); ?></legend>
      <?php if ($_GET["action"] == "update") { ?>
          <p>
            <label for="admin_id">Id</label> :
            <input <?php if (isset($admin)) {echo 
            "value=".$admin->get('id');
            } ?>
             type="text" placeholder="1" name="id" id="admin_id" readonly/>
          </p>
          <?php } ?>
          <p>
              <label for="admin_log">Login</label> :
              <input <?php if (isset($admin)) {echo 
            "value=".$admin->get('login');
            } ?> type="text" placeholder="entrer un login" name="log" id="admin_log" required/>
          </p>
          <p>
              <label for="admin_pswd">Mot de passe</label> :
              <input 
               type="password" name="pswd" id="admin_pswd" <?php if($action == "create") { echo "required"; } ?>/>
          </p>
          <p>
            <input type="submit" value="Envoyer" />
          </p>
      </fieldset> 
  </form>
