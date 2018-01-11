<?php $title = htmlspecialchars($post->title()) ?>
<?php ob_start(); ?>

		<section>
			<article class="box post">
		 
				<header>
					<h2><a href="index.php?action=post&amp;id=<?= $post->id() ?>"><?= htmlspecialchars($post->title()) ?></a></h2>
					<h3>
						Par : <?= htmlspecialchars($author->name()) ?> le <?= $post->dateFr() ?>
						<?php if($this->loggedIn()){ ?>
						( <a href="admin.php?action=editPost&amp;id=<?= $post->id() ?>">Modifier</a> | <a href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>">Supprimer</a> )
						<?php } ?>
					</h3>
				</header>
				<p><?= $post->content() ?></p>
			</article>
			
				<?php require('post/commentForm.php'); ?>
				
				<?php require('post/comments.php'); ?>
			
		</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>