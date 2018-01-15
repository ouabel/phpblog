<?php
$title = 'Se connecter';
require('header.php');
?>
  <div class="panel panel-primary" id="login">
    <div class="panel-heading">Se connecter</div>
    <div class="panel-body">
      <form method="post" action="index.php?action=login">
        <p>
          <label for="pseudo">Pseudo:</label><br />
          <input type="text" class="form-control" name="pseudo" placeholder="Pseudo">
        </p>
        <p>
          <label for="pass">Mot de passe:</label><br />
          <input type="password" class="form-control" name="pass" class="form-control" placeholder="Mot de passe">
        </p>
        <button type="submit" class="btn btn-primary">Se connecter</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>