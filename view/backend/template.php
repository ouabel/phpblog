<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<link href="public/css/style.css" rel="stylesheet" /> 
	<link href="admin/css/style.css" rel="stylesheet" /> 
</head>
	
<body>
<div id="container">

	<div id="admin-nav">
		<span class="dashboard">Tableau de bord</span>
		<ul>
			<li><a href="index.php">Afficher le blog</a></li>
			<li><a href="admin.php">Articles</a></li>
			<li><a href="admin.php?action=newPost">Nouvel article</a></li>
			<li><a href="admin.php?action=editComments">Commentaires</a></li>
			<li><a href="admin.php?action=editComments&reported=1">Commentaires signalés</a></li>
			<li><a href="admin.php?action=settings">Réglages</a></li>
			<li><a href="index.php?action=logout">Se déconnecter</a></li>
		</ul>
	</div>
	
	<div id="admin-area">
		<?= $content ?>
	</div>
	
</div>
</body>
</html>