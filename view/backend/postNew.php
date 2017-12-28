<?php $title = 'Nouvel article'; ?>

<?php ob_start(); ?>

<h1>Nouvel article</h1>
<form method="post" action="admin.php?action=insertPost">
	<input type="text" name="title" placeholder="Titre de l'article">
	<p><textarea name="content" rows="15"></textarea></p>
	<button type="submit">Envoyer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>