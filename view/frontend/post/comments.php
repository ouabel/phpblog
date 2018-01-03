			<?php if($comments){ ?>
				<h2>Commentaires</h2>

				<?php foreach($comments as $comment){ ?>
				<div class="box in-box">
					<div class="in-box-header">
						Par: <?= $comment->author() ?> le: <?= $comment->dateFr() ?>
						<?php if($this->loggedIn()){ ?>
						( <a href="admin.php?action=editComment&amp;id=<?= $comment->id() ?>">Modifier</a> | <a href="admin.php?action=deleteComment&amp;redirect_to=<?= $post->id() ?>&amp;id=<?= $comment->id() ?>">Supprimer</a> )
						<?php } else {

						if ($comment->reported()) {?>
							Signalé
						<?php } else { ?>
							<a href="index.php?action=reportComment&amp;id=<?= $comment->id() ?>">Signaler un contenu inapproprié</a>
						<?php } ?>

						<?php } ?>

					</div>
					<div class="in-box-content">
						<p><?= $comment->content() ?></p>
					</div>
				</div>
				<?php } ?>

				<?php require('view/frontend/pagination.php');
			} else { ?>

			<?php } ?>
