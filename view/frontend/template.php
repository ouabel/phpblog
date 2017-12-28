<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
</head>
<body>

	<div id="container">
		<header>
			<h1><a href="index.php"><?= $settings['title'] ?></a></h1>
		</header>
		
		<?= $content ?>
		
		<footer>
			<a href="admin.php">Tableau de bord</a>
			<?php if(loggedIn()){ ?>
				| <a href="index.php?action=logout">Se déconnecter</a></li>
			<?php } ?>
		</footer>
	</div>
	
</body>
</html>