<h3>Ajouter un commentaire</h3>
<form class="well" action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
    <?php if($returnMessage = $this->returnMessage()){?>
    <p class="alert alert-info"><?= $returnMessage ?></p>
    <?php } ?>
    <p>
      <label for="author">Votre nom :</label><br />
      <input type="text" id="author" name="author" class="form-control"/>
    </p>
    <p>
      <label for="comment">Commentaire :</label><br />
      <textarea id="comment" name="comment" rows="8" class="form-control"></textarea>
    </p>
    <p>
      <button type="submit" class="btn btn-primary"/>Envoyer</button>
    </p>
</form>