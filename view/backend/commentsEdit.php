<?php $title = 'Modérer les commentaires'; ?>

<?php ob_start(); ?>
<div class="panel-group">
<?php if($comments){ ?>
<form method="post" action="admin.php?action=multipleDelete&amp;redirect_to=<?= $redirectTo ?>">
<input type="hidden" name="type" value="comment"></input>
<p>
  <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer tout sélectionné</button>
</p>
<?php foreach ($comments as $comment) {?>
  <div class="panel panel-default <?php if($comment->reports()){?><?= 'panel-danger'; } ?>">
    <div class="panel-heading">
      <input type="checkbox" class="form-check-inline" name="multipleDelete[]" value="<?= $comment->id() ?>"></input>
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
  <?php } ?>
  <br>
  <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer tout sélectionné</button>
</form>
<?php } else {?>
  <div class="panel panel-default panel-body">
    <p>Pas de commentaires à modérer</p>
  </div>
<?php } ?>
</div>
<?php
if ($pagination){ echo $pagination; };

$content = ob_get_clean();

 require('template.php'); ?>