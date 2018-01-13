<?php $title = $blog->title() ?>
<?php ob_start(); ?>

<section>
<?php if ($posts) {
  foreach($posts as $post) {?>
    <article>

      <header>
        <h2><a href="index.php?action=post&amp;id=<?= $post->id() ?>"><?= htmlspecialchars($post->title()) ?></a></h2>
        <h3>
          Par : <?= htmlspecialchars($author->name()) ?> le <?= $post->dateFr() ?>
          <?php if($this->loggedIn()){ ?>
          <a class="btn btn-xs btn-primary" href="admin.php?action=editPost&amp;id=<?= $post->id() ?>">Modifier</a>
          <a class="btn btn-xs btn-danger" href="admin.php?action=deletePost&amp;id=<?= $post->id() ?>">Supprimer</a>
          <?php } ?>
        </h3>
      </header>

      <p><?= $post->content() ?></p>

      <footer>
        <p><a href="index.php?action=post&amp;id=<?= $post->id() ?>">Commentaires</a></p>
      </footer>
    </article>
<?php  }
  require('view/frontend/pagination.php'); ?>
<?php } else { ?>
  <p>Aucun article publié</p>
<?php } ?>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>