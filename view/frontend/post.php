<?php $title = htmlspecialchars($post->title()) ?>
<?php ob_start(); ?>

<div class="row">
  <div class="col-sm-8">
    <section>
      <article class="post" id="post-<?= $post->id() ?>">

          <header>
            <h2><?= htmlspecialchars($post->title()) ?></h2>
          </header>

          <div class="post-content"><?= $post->content() ?></div>

        <footer>
          <p class="well well-sm">
            <span class="glyphicon glyphicon-user"></span> Par : <?= htmlspecialchars($author->name()) ?> | <span class="glyphicon glyphicon-calendar"></span> Le : <?= $post->dateFr() ?>
            <?php if($this->loggedIn()){ ?>
              | <a class="btn btn-xs btn-primary" href="<?= $post->link('edit') ?>">Modifier</a>
              <a class="btn btn-xs btn-danger" href="<?= $post->link('delete') ?>">Supprimer</a>
            <?php } ?>
          </p>
        </footer>
      </article>

    <?php require('post/commentForm.php'); ?>
    <?php require('post/comments.php'); ?>

    </section>
  </div>
  <div class="col-sm-4">
    <?php require('sidebar.php'); ?>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>