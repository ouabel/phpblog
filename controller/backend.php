<?php
require_once('controller/controller.php');

class backend extends Controller
{
  function editPosts()
  {
    $blogManager = new BlogManager();
    $postManager = new PostManager('posts');

    $blog = $blogManager->getSettings();
    $postManager->setItemsPerPage(20);
    $posts = $postManager->getPosts();

    $pagination['page'] = $postManager->currentPage();
    $pagination['items'] = $postManager->countPosts();
    $pagination['itemsPerPage'] = $postManager->itemsPerPage();
    $pagination['path'] = "admin.php?page=";

    require('view/backend/postsEdit.php');
  }

  function newPost()
  {
    require('view/backend/postNew.php');
  }

  function insertPost($title, $content)
  {
    $postManager = new PostManager('posts');
    $post = new Post(['title'=>$title, 'content'=>$content]);
    $error = false;

    if(empty($title)){
      $this->setFormError('title','Le champ de titre est obligatoire');
    }

    if($this->formError){
      $error = true;
      $this->setReturnMessage('danger', 'Veuillez corriger les erreurs');
    } else {
      $lastInsertId = $postManager->insertPost($post);
      if($lastInsertId === '0'){
        $error = true;
        $this->setReturnMessage('danger', 'Impossible d\'ajouter l\'article !');
      }
    }

    if ($error) {
      require('view/backend/postNew.php');
    }
    else {
      $this->setReturnMessage('success', 'Article publié avec succès <a href="index.php?action=post&id='.$lastInsertId.'">Afficher</a>');
      header('location:admin.php?action=editPost&id='.$lastInsertId);
    }
  }

  function editPost($postId)
  {
    $postManager = new PostManager('posts');
    $post = $postManager->getPost($postId);
    if($post){
      require('view/backend/postEdit.php');
    } else {
      throw new Exception('Identifiant d\'article introuvable');
    }
  }

  function updatePost($postId, $title, $content)
  {
    $postManager = new PostManager('posts');
    $post = $postManager->getPost($postId);

    $post->setTitle($title);
    $post->setContent($content);

    $executeResult = $postManager->updatePost($post);

    if ($executeResult === false) {
      $this->setReturnMessage('danger', 'Impossible de modifier l\'article !');
    }
    else {
      $this->setReturnMessage('success', 'Article mis à jour avec succès <a href="index.php?action=post&id='.$postId.'">Afficher</a>');
    }
    $this->editPost($post->id());
  }

  function deletePost($postId)
  {
    $postManager = new PostManager('posts');
    $post = $postManager->getPost($postId);
    if($post){
      $executeResult = $postManager->deleteContent($post);

      if ($executeResult === false) {
        $this->setReturnMessage('danger', 'Impossible de supprimer l\'article !');
      }
      else {
        $commentManager = new commentManager();
        $affectedRows = $commentManager->deletePostComments($postId);
        if ($affectedRows === false) {
          $this->setReturnMessage('danger', 'Impossible de supprimer les commentaires d\'article !');
        }
        else {
          $this->setReturnMessage('success', 'Article supprimé avec succès');
        }
      }
      header('Location: admin.php');
    } else {
      throw new Exception('Identifiant d\'article introuvable');
    }
    //TODO: redirect home if deleted from frontend
  }

  function editComments($criteria)
  {
    $blogManager = new BlogManager();
    $commentManager = new CommentManager('comments');

    if (is_int($criteria)){
      $postManager = new PostManager('posts');
      $post = $postManager->getPost($criteria);
      if (!$post){
        throw new Exception('Identifiant d\'article introuvable');
      }
    }

    $blog = $blogManager->getSettings();
    $commentManager->setItemsPerPage(50);
    $comments = $commentManager->getComments($criteria);

    $pagination['page'] = $commentManager->currentPage();
    $pagination['items'] = $commentManager->countComments($criteria);
    $pagination['itemsPerPage'] = $commentManager->itemsPerPage();
    if ($criteria === 'all') {
      $pagination['path'] = "admin.php?action=editComments&page=";
    } else if ($criteria === 'reported'){
      $pagination['path'] = "admin.php?action=editComments&reported=1&page=";
    } else {
      $pagination['path'] = "admin.php?action=editComments&id=$criteria&page=";
    }

    require('view/backend/commentsEdit.php');
  }

  function editComment($commentId)
  {
    $commentManager = new CommentManager('comments');
    $comment = $commentManager->getComment($commentId);
    if ($comment) {
      require('view/backend/commentEdit.php');
    } else {
      throw new Exception('Identifiant de commentaire introuvable');
    }
  }

  function updateComment($commentId,$author,$content)
  {
    $commentManager = new CommentManager('comments');
    $comment = new Comment(['id'=>$commentId, 'author'=>$author, 'content'=>$content]);

    $executeResult = $commentManager->updateComment($comment);

    if ($executeResult === false) {
      $this->setReturnMessage('danger', 'Impossible de modifier le commentaire !');
    }
    else {
      $this->setReturnMessage('success', 'Commentaire modifié avec succès');
    }
    $this->editComment($comment->id());
  }

  function deleteComment($commentId)
  {
    $commentManager = new CommentManager('comments');
    $comment = $commentManager->getComment($commentId);
    if ($comment){
      $executeResult = $commentManager->deleteContent($comment);
      if ($executeResult === false) {
        $this->setReturnMessage('danger', 'Impossible de supprimer le commentaire !');
      }
      else {
        $postManager = new PostManager('posts');
        $postManager->deleteComment($comment->postId());
        $this->setReturnMessage('success', 'Commentaire supprimé avec succès');
      }
    } else {
      throw new Exception('Identifiant de commentaire introuvable');
    }
  }

  function editSettings()
  {
    $blogManager = new BlogManager();
    $blog = $blogManager->getSettings();
    require('view/backend/settings.php');
  }

  function editAuthor()
  {
    if(isset($_SESSION['author'])){
      $author = $_SESSION['author'];
      unset($_SESSION['author']);
    } else {
      $authorManager = new AuthorManager();
      $author = $authorManager->getAuthor();
    }
    require('view/backend/author.php');
  }

  function updateSettings($title, $description)
  {

    $blogManager = new BlogManager();
    $blog = $blogManager->getSettings();
    $blog->setTitle($title);
    $blog->setDescription($description);

    $executeResult = $blogManager->setSettings($blog);

    if ($executeResult === false) {
      $this->setReturnMessage('danger', 'Impossible de modifier les réglages !');
    }
    else {
      $this->setReturnMessage('success', 'Réglages mis à jour avec succès');
    }
    $this->editSettings();
  }

  function updateAuthor($name, $pseudo, $email, $pass, $pass2)
  {
    $authorManager = new AuthorManager();
    $author = $authorManager->getAuthor();
    $author->setName($name);
    $author->setPseudo(strtolower($pseudo));
    $author->setEmail($email);

    if(!ctype_alnum($pseudo)){
      $this->setFormError('author_pseudo', 'Le pseudo ne doit contenir que des lettres non accentuées et chiffres.');
    }

    if(mb_strlen($pseudo) < 4){
      $this->setFormError('author_pseudo', 'Le pseudo doit contenir 4 caractères au minimum.');
    }

    if((!empty($pass) || !empty($pass2)) && $pass !== $pass2){
      $this->setFormError('pass', 'Les deux mots de passe ne correspondent pas !');
    } else {
      $pass = password_hash($pass , PASSWORD_DEFAULT);
      $author->setPass($pass);
    }

    if($this->formError){
      $this->setReturnMessage('danger', 'Veuillez corriger les erreurs');
      $_SESSION['author'] = $author;
    }else{

      $executeResult = $authorManager->setAuthor($author);
      if ($executeResult === false) {
        $this->setReturnMessage('danger', 'Impossible de modifier l\'autheur !');
      }
      else {
        $this->setReturnMessage('success', 'Auteur mis à jour avec succès');
      }
    }

    $this->editAuthor();
  }
}