<?php $title = $post->title() ?>
<?php ob_start(); ?>

		<section>
			<article class="box post">
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post->id() ?>"><?= $post->title() ?></a></h2>
					<h3>
						Par: <?= $author->name() ?> le <?= $post->dateFr() ?>
						<?php if($this->loggedIn()){ ?>
						( <a href="admin.php?action=editPost&amp;id=<?= $post->id() ?>">Modifier</a> | <a href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>">Supprimer</a> )
						<?php } ?>
					</h3>
				</header>
				<p><?= $post->content() ?></p>
			</article>
			
				<form class="comment-form" action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
				<h2>Ajouter un commentaire</h2>
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
				
			<?php if($comments){ ?>
				<h2>Commentaires</h2>
				
				<?php foreach($comments as $comment){ ?>
				<div class="box in-box">
					<div class="in-box-header">
						Par: <?= $comment->author() ?> le: <?= $comment->dateFr() ?>
						<?php if($this->loggedIn()){ ?>
						( <a href="admin.php?action=editComment&amp;id=<?= $comment->id() ?>">Modifier</a> | <a href="admin.php?action=deleteComment&amp;redirect_to=<?= $post->id() ?>&amp;id=<?= $comment->id() ?>">Supprimer</a> )
						<?php } else {?>
						<a href="index.php?action=reportComment&amp;id=<?= $comment->id() ?>">Signaler un contenu inapproprié</a>
						<?php } ?>

					</div>
					<div class="in-box-content">
						<p><?= $comment->content() ?></p>
					</div>
				</div>
				<?php } ?>
				
				<?php require('pagination.php'); 
			} else { ?>
			
			<?php } ?>
		</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>