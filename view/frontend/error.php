<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Erreur</title>
  <link href="public/css/style.css" rel="stylesheet" /> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, author-scalable=0'>
</head>
<body>
  <div id="container" class="container-fluid">
    <div class="panel panel-danger" id="error">
      <div class="panel-heading">Erreur :</div>
      <div class="panel-body">
      <?= $error ?>
      </div>
  </div>
  </div>
</body>
</html>