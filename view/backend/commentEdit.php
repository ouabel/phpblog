<?php $title = 'Modifier le commentaire'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>
<form class="box" method="post" action="admin.php?action=editComment&id=<?=$comment->id(); ?>">
	
	<p>
		Auteur:
		<input type="text" name="author" value="<?= $comment->author(); ?>"><br />
	</p>
	<p>
		Commentaire:
		<textarea name="comment" rows="8"><?= $comment->content(); ?></textarea><br />
	</p>
	<input type="hidden" name="submit" value="comment">
	<button type="submit">Mettre à jour</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
