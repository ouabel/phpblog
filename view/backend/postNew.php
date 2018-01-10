<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php $title = 'Nouvel article'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>
<form method="post" action="admin.php?action=newPost">
	<input type="text" name="title" <?php if(isset($post)){echo 'value="'.$post->title().'"';} ?>placeholder="Titre de l'article">
	<p><textarea name="content" rows="15"><?php if(isset($post)){echo $post->content();} ?></textarea></p>
	<input type="hidden" name="submit" value="post">
	<button type="submit">Publier</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>