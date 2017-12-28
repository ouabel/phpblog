<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Billet simple pour l'Alaska</title>
</head>
<body>

	<div id="container">
		<header>
			<h1><a href="index.php">Billet simple pour l'Alaska</a></h1>
		</header>
		
		<section>
<?php foreach($posts as $post) {?>
			<article>
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
					<h3>Le <?= $post['date_fr'] ?></h3>
				</header>
				<p><?= $post['content'] ?>;</p>
				
				<footer>
					<p><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a></p>
				</footer>
			</article>
<?php }?>
		</section>
		
		<footer>
			<em>Billet simple pour l'Alaska</em>
		</footer>
	</div>
	
</body>
</html>