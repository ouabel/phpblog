<?php $title = $settings['title'] ?>
<?php ob_start(); ?>

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
		
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>