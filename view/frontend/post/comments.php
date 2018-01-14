<?php if($comments){ ?>
  <h3>Commentaires</h3>
  <?php foreach($comments as $comment){ ?>
    <div class="panel panel-default" id="comment-<?= $comment->id() ?>">
      <div class="panel-heading">
        Par : <?= htmlspecialchars($comment->author()) ?> le : <?= $comment->dateFr() ?>
        <?php if($this->loggedIn()){ ?>
          <a class="btn btn-xs btn-primary" href="admin.php?action=editComment&amp;id=<?= $comment->id() ?>">Modifier</a> <a class="btn btn-xs btn-danger" href="admin.php?action=deleteComment&amp;redirect_to=<?= $post->id() ?>&amp;id=<?= $comment->id() ?>">Supprimer</a>
        <?php } elseif ($comment->reported()) {?>
          <span class="label label-warning">Signalé</span><span class="badge"></span>
        <?php } else { ?>
          <a class="btn btn-xs btn-danger" href="index.php?action=reportComment&amp;id=<?= $comment->id() ?>"><span class="glyphicon glyphicon-alert"></span> Contenu inapproprié</a>
        <?php } ?>
      </div>
      <div class="panel-body">
        <p><?= htmlspecialchars($comment->content()) ?></p>
      </div>
    </div>
  <?php } ?>
  <?php require('view/frontend/pagination.php');
} else { ?>

<?php } ?>