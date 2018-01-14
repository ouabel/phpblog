<?php $title = htmlspecialchars($post->title()) ?>
<?php ob_start(); ?>

<section>
  <article>

      <header>
        <h2><?= htmlspecialchars($post->title()) ?></h2>
      </header>
    <div><?= $post->content() ?></div>

    <footer>
      <p class="well well-sm">
        <span class="glyphicon glyphicon-user"></span> Par : <?= htmlspecialchars($author->name()) ?> | <span class="glyphicon glyphicon-calendar"></span> Le : <?= $post->dateFr() ?>
        | <span class="glyphicon glyphicon-comment"></span> <a href="index.php?action=post&amp;id=<?= $post->id() ?>">Commentaires</a> <span class="badge">42</span>
        <?php if($this->loggedIn()){ ?>
          | <a class="btn btn-xs btn-primary" href="admin.php?action=editPost&amp;id=<?= $post->id() ?>">Modifier</a>
          <a class="btn btn-xs btn-danger" href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>">Supprimer</a>
        <?php } ?>
      </p>
    </footer>
  </article>

<?php require('post/commentForm.php'); ?>
<?php require('post/comments.php'); ?>

</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>