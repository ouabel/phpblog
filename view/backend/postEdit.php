<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php $title = 'Modifier l\'article'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>
<form method="post" action="admin.php?action=editPost&id=<?= $post->id(); ?>">
  <p><input type="text" name="title" placeholder="Titre de l'article" class="form-control" value="<?= $post->title() ?>"></p>
  <p><textarea name="content" class="form-control" rows="15"><?= $post->content() ?></textarea></p>
  <input type="hidden" name="submit" value="post">
  <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>