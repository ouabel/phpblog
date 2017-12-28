<?php $title = 'Réglages'; ?>

<?php ob_start(); ?>
<h1>Réglages</h1>
<form  class="box" method="post" action="admin.php?action=updateSettings">
	<h2>Réglages du blog</h2>
	<p>
		<label for="title">Titre du blog</label>
		<input type="text" name="title" value="<?= $settings['title'] ?>">
	</p>
	<p>
		<label for="description">Description du blog</label>
		<textarea type="text" name="description" rows="4"><?= $settings['description'] ?></textarea>
	</p>
	<button type="submit">Mettre à jour</button>
</form>

<form  class="box" method="post" action="admin.php?action=updateAuthor">
	<h2>Réglages d'auteur</h2>
	<p>
		<label for="author">Nom d'auteur</label>
		<input type="text" name="author" value="<?= $author['author'] ?>">
	</p>
	<p>
		<label for="author_pseudo">Pseudo d'auteur</label>
		<input type="text" name="author_pseudo" value="<?= $author['author_pseudo'] ?>">
	</p>
	<p>
		<label for="email">E-mail</label>
		<input type="email" name="email" value="<?= $author['email'] ?>">
	</p>
	<p>
		<label for="pass">Mot de pass</label>
		<input type="password" name="pass">
	</p>
	<p>
		<label for="pass2">Confirmer le mot de pass</label>
		<input type="password" name="pass2">
	</p>
	<button type="submit">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
