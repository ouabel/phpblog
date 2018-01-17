<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php $title = 'Nouvel article'; ?>
<?php $h1 = $title; ?>

<?php ob_start(); ?>
<form method="post" action="admin.php?action=newPost">
  <p><input type="text" name="title"  class="form-control" <?php if(isset($post)){echo 'value="'.$post->title().'"';} ?>placeholder="Titre de l'article">
  <?php
    if($error = $this->formError('title')){
      echo $error;
    }
  ?>
  </p>
  <p><textarea name="content" class="form-control" rows="15"><?php if(isset($post)){echo $post->content();} ?></textarea>
    <?php
    if($error = $this->formError('content')){
      echo $error;
    }
    ?>
  </p>
  <input type="hidden" name="submit" value="post">
  <button type="submit" class="btn btn-primary">Publier</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>