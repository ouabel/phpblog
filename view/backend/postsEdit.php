<?php $title = $blog->title() ?>

<?php ob_start(); ?>
<h1>Modérer les articles</h1>
<table class="box">
<?php if($posts){
		foreach ($posts as $post) { ?>
	<tr>
	
		<td>
			<p><?= $post->title() ?></p>
			Pblié le <?= $post->dateFR() ?>
			<a href="index.php?action=post&amp;id=<?= $post->id() ?>">Afficher</a>
			<a href="admin.php?action=editPost&amp;id=<?= $post->id() ?>">Modifier</a>
			<a href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>">Supprimer</a>
			<a href="admin.php?action=editComments&amp;id=<?= $post->id() ?>">Commentaires</a>
		</td>

	</tr>
    
<?php 	}
	} else { ?>
	<tr>
		<td>Aucun article publié</td>
	</tr>
<?php 	} ?>
</table>

<?php require('/../frontend/pagination.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>