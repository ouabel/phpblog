<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?= $title ?></title>
  <link href="public/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, author-scalable=0'>
</head>
<body>
  <div id="container" class="container">
    <header class="page-header">
      <h1><a href="index.php"><?= htmlspecialchars($blog->title()) ?></a></h1>
    </header>

    <?= $content ?>

    <footer>
      <a class="btn" href="admin.php"><span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</a>
      <?php if($this->loggedIn()){ ?>
        | <a class="btn" href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
      <?php } ?>
    </footer>
  </div>
</body>
</html>