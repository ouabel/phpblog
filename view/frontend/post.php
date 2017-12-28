<?php $title = $post['title'] ?>
<?php ob_start(); ?>

		<section>
			<article>
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
					<h3>Par: <?= $author['author'] ?> le <?= $post['date_fr'] ?></h3>
				</header>
				<p><?= $post['content'] ?></p>
				
				<h2>Ajouter un commentaire</h2>
				<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
					<p>
						<label for="author">Auteur</label><br />
						<input type="text" id="author" name="author" />
					</p>
					<p>
						<label for="comment">Commentaire</label><br />
						<textarea id="comment" name="comment" rows="8"></textarea>
					</p>
					<p>
						<button type="submit" />Envoyer</button>
					</p>
				</form>
	
				<h2>Commentaires</h2>
				
				<?php foreach($comments as $comment){ ?>
				<div>
					<div>
					Par: <?= $comment['author'] ?> le: <?= $comment['date_fr'] ?>
					<a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>">Signaler un contenu inapproprié</a>
					</div>
					<div>
						<p><?= $comment['comment'] ?></p>
					</div>
				</div>
				<?php } ?>
		
			</article>
		</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>