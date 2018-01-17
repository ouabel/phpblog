<?php
?>
<div id="sidebar">
  <div id="about_author" class="panel panel-primary">
    <div class="panel-heading">A propos de l'auteur</div>
    <div class="panel-body">
      <p>
        <?php echo ($this->getAuthor()->about());?>
      </p>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Articles récents</div>
    <div class="panel-body">
      <ul>
        <?php foreach($this->getRecentPosts() as $post){ ?>
          <li><a href="<?= $post->link() ?>"><?= $post->title() ?></a> <small>Le: <?= $post->dateFr() ?></small></li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Commentaires récents</div>
    <div class="panel-body">
        <?php foreach($this->getRecentComments() as $comment){ ?>
          <div class="well well-sm"><h4 class="media-heading"><?= $comment->author() ?> <small><?= $comment->dateFr() ?></small></h4><?= $comment->content() ?></div>
        <?php } ?>
    </div>
  </div>
</div>