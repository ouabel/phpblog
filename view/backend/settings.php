<?php $title = 'Réglages du blog'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>

<form method="post" action="admin.php?action=settings">
  <p>
    <label for="title">Titre du blog</label>
    <input type="text" name="title" class="form-control" value="<?= $blog->title() ?>">
  </p>
  <p>
    <label for="description">Description du blog</label>
    <textarea type="text" name="description" class="form-control" rows="4"><?= $blog->description() ?></textarea>
  </p>
  <input type="hidden" name="submit" value="blog">
  <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
