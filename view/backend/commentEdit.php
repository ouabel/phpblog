<?php $title = 'Modifier le commentaire'; ?>

<?php ob_start(); ?>

<h1>Modifier le commentaire</h1>

<form class="box" method="post" action="admin.php?action=updateComment&id=<?=$comment->id(); ?>">
	
	<p>
		Auteur:
		<input type="text" name="author" value="<?= $comment->author(); ?>"><br />
	</p>
	<p>
		Commentaire:
		<textarea name="comment" rows="8"><?= $comment->content(); ?></textarea><br />
	</p>
	<button type="submit">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
