<?php $title = $blog->title() ?>
<?php $h1 = 'Modérer les articles'; ?>

<?php ob_start(); ?>
<div class="panel-group">
<?php if($posts){
    foreach ($posts as $post) { ?>
  <div class="panel panel-default">

    <div class="panel-heading">Pblié le <?= $post->dateFr() ?> Mis à jour le <?= $post->updateDateFr() ?> <a href="index.php?action=post&amp;id=<?= $post->id() ?>"><span class="glyphicon glyphicon-eye-open"></span> Afficher</a></div>
    <div class="panel-body"><?= htmlspecialchars($post->title()) ?></div>
    <div class="panel-footer">
      <a class="btn btn-sm btn-primary" href="admin.php?action=editPost&amp;id=<?= $post->id() ?>"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
      <a class="btn btn-sm btn-danger" href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
      <a class="btn btn-sm btn-default" href="admin.php?action=editComments&amp;id=<?= $post->id() ?>"><span class="glyphicon glyphicon-comment"></span> Commentaires</a>
    </div>

  </div>
    
<?php   }
  } else { ?>
  <div class="panel panel-default panel-body">
    <p>Aucun article publié</p>
  </div>
<?php   } ?>
</div>

<?php require('view/frontend/pagination.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>