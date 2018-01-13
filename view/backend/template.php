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
<div id="container" class="container-fluid">
  <div class="row">
    <div id="admin-nav" class="col-xs-2 sidebar-nav navbar-collapse">
    <nav class="navbar-default sidebar">
    <ul class="nav in">
      <li class="active"><a>Tableau de bord</a></li>
      <li><a href="index.php">Afficher le blog</a></li>
      <li><a href="admin.php">Articles</a></li>
      <li><a href="admin.php?action=newPost">Nouvel article</a></li>
      <li><a href="admin.php?action=editComments">Commentaires</a></li>
      <li><a href="admin.php?action=editComments&reported=1">Commentaires signalés</a></li>
      <li><a href="admin.php?action=author">Auteur</a></li>
      <li><a href="admin.php?action=settings">Réglages</a></li>
      <li><a href="index.php?action=logout">Se déconnecter</a></li>
    </ul>
    </nav>
    </div>

    <div id="admin-area" class="col-xs-10">
    <h1><?= $h1 ?></h1>
    <?php if($returnMessage = $this->returnMessage()){?>
      <p class="alert alert-info"><?= $returnMessage ?></p>
    <?php } ?>
    <?= $content ?>
    </div>
  </div>
</div>
</body>
</html>