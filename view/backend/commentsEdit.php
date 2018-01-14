<?php $title = 'Modérer les commentaires';

if(isset($_GET['reported'])){
  $h1 = "Modérer les commentaires signalés";
  $redirectTo = 'reported';
}elseif(isset($_GET['id'])) {
  $h1 = "Modérer les commentaires sur " . htmlspecialchars($post->title());
  $redirectTo = $_GET['id'];
}  else {
  $h1 = "Modérer les commentaires";
  $redirectTo = 'all';
}
?>

<?php ob_start(); ?>
<div class="panel-group">
<?php
if($comments){
  foreach ($comments as $comment)
  {
  ?>
  <div class="panel panel-default <?php if($comment->reports()){?><?= 'panel-danger'; } ?>">
    <div class="panel-heading">
      Par : <?= htmlspecialchars($comment->author()) ?>
      le : <?= $comment->dateFr() ?>
    </div>
    <div class="panel-body">
      <p><?= htmlspecialchars($comment->content()) ?></p>
    </div>
    <div class="panel-footer">
      <a class="btn btn-sm btn-primary" href="admin.php?action=editComment&amp;id=<?= $comment->id() ?>"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
      <a class="btn btn-sm btn-danger" href="admin.php?action=deleteComment&amp;redirect_to=<?= $redirectTo ?>&amp;id=<?= $comment->id() ?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
      <a class="btn btn-sm btn-default" href="index.php?action=post&amp;id=<?= $comment->postId() ?>"><span class="glyphicon glyphicon-align-left"></span> Article</a>
    </div>
  </div>
  <?php
  }
} else {?>
  <div class="panel panel-default panel-body">
    <p>Pas de commentaires à modérer</p>
  </div>
<?php } ?>
</div>
<?php
require('view/frontend/pagination.php');

$content = ob_get_clean();

 require('template.php'); ?>