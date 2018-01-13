<?php $title = 'Réglages d\'auteur'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>

<form method="post" action="admin.php?action=author">
  <p>
    <label for="author">Nom d'auteur</label>
    <input type="text" name="author" class="form-control" value="<?= $author->name() ?>">
  </p>
  <p>
    <label for="author_pseudo">Pseudo d'auteur</label>
    <input type="text" name="author_pseudo" class="form-control" value="<?= $author->pseudo() ?>">
  </p>
  <p>
    <label for="email">E-mail</label>
    <input type="email" name="email" class="form-control" value="<?= $author->email() ?>">
  </p>
  <p>
    <label for="pass">Mot de passe</label>
    <input type="password" name="pass" class="form-control">
  </p>
  <p>
    <label for="pass2">Confirmer le mot de passe</label>
    <input type="password" name="pass2" class="form-control">
  </p>
  <input type="hidden" name="submit" value="author">
  <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
