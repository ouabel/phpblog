<?php $title = $blog->title() ?>
<?php ob_start(); ?>

		<section>
<?php if ($posts) {
		foreach($posts as $post) {?>
			<article class="box post">
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post->id() ?>"><?= $post->title() ?></a></h2>
					<h3>Par: <?= $author->name() ?> le <?= $post->dateFr() ?></h3>
				</header>
				<p><?= $post->content() ?>;</p>
				
				<footer>
					<p><a href="index.php?action=post&amp;id=<?= $post->id() ?>">Commentaires</a></p>
				</footer>
			</article>
<?php	}
		
			require('pagination.php'); ?>
<?php } else { ?>
			<p class="box">Aucun article publié</p>
<?php } ?>
		</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>