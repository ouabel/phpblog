<?php $title = 'Modifier l\'article'; ?>

<?php ob_start(); ?>

<h1>Modifier l'article</h1>
<form method="post" action="admin.php?action=updatePost&id=<?= $post->id(); ?>">
	<input type="text" name="title" placeholder="Titre de l'article" value="<?= $post->title() ?>">
	<p><textarea name="content" rows="15"><?= $post->content() ?></textarea></p>
	<button type="submit">Envoyer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>