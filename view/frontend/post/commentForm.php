				<form class="comment-form" action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
				<h2>Ajouter un commentaire</h2>
					<?php if($returnMessage = $this->returnMessage()){?>
					<p class="return_message"><?= $returnMessage ?></p>
					<?php } ?>
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