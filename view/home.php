<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $settings['title'] ?></title>
</head>
<body>

	<div id="container">
		<header>
			<h1><a href="index.php"><?= $settings['title'] ?></a></h1>
		</header>
		
		<section>
<?php foreach($posts as $post) {?>
			<article>
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
					<h3>Par: <?= $author['author'] ?> le <?= $post['date_fr'] ?></h3>
				</header>
				<p><?= $post['content'] ?>;</p>
				
				<footer>
					<p><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a></p>
				</footer>
			</article>
<?php }?>
		</section>
		
		<footer>
			<em><a href="index.php?action=login">Se Connecter</a></em>
		</footer>
	</div>
	
</body>
</html>