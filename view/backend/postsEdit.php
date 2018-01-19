<?php $title = $blog->title() ?>
<?php $h1 = 'Modérer les articles'; ?>

<?php ob_start(); ?>
<div class="panel-group">
<?php if($posts){ ?>
<form method="post" action="admin.php?action=multipleDelete">
<input type="hidden" name="type" value="post"></input>
<p>
  <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer tout sélectionné</button>
</p>
<?php foreach ($posts as $post) { ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <input type="checkbox" class="form-check-inline" name="multipleDelete[]" value="<?= $post->id() ?>"></input>
      Publié le <?= $post->dateFr() ?> Mis à jour le <?= $post->updateDateFr() ?> <a href="<?= $post->link() ?>"><span class="glyphicon glyphicon-eye-open"></span> Afficher</a>
    </div>
    <div class="panel-body"><?= htmlspecialchars($post->title()) ?></div>
    <div class="panel-footer">
      <a class="btn btn-sm btn-primary" href="<?= $post->link('edit') ?>"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
      <a class="btn btn-sm btn-danger" href="<?= $post->link('delete') ?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
      <a class="btn btn-sm btn-default" href="<?= $post->link('editComments') ?>"><span class="glyphicon glyphicon-comment"></span> Commentaires</a>
    </div>

  </div>
    
<?php } ?>
</form>
<br>
<button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer tout sélectionné</button>
<?php } else { ?>
  <div class="panel panel-default panel-body">
    <p>Aucun article publié</p>
  </div>
<?php } ?>
</div>
<?php if ($pagination){ echo $pagination; }; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>