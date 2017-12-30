<?php $title = 'Modifier l\'article'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>
<form method="post" action="admin.php?action=editPost&id=<?= $post->id(); ?>">
	<input type="text" name="title" placeholder="Titre de l'article" value="<?= $post->title() ?>">
	<p><textarea name="content" rows="15"><?= $post->content() ?></textarea></p>
	<input type="hidden" name="submit" value="post">
	<button type="submit">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>