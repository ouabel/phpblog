<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Se connecter</title>
  <link href="public/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, author-scalable=0'>
</head>
<body>
<div id="container" class="container-fluid">
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