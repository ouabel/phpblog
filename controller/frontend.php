<?php
require_once('controller/controller.php');

class Frontend extends Controller
{
  function post($postId)
  {
    $blogManager = new BlogManager();
    $blog = $blogManager->getSettings();

    $postManager = new PostManager('posts');
    $post = $postManager->getPost($postId);
    if($post){
      $authorManager = new AuthorManager();
      $author = $authorManager->getAuthor();

      if (isset($_SESSION['comment'])){
        $comment = $_SESSION['comment'];
        unset($_SESSION['comment']);
      }

      $commentManager = new CommentManager('comments');
      $commentManager->setItemsPerPage(20);
      $comments = $commentManager->getComments($postId);

      $pagination['page'] = $commentManager->currentPage();
      $pagination['items'] = $commentManager->countComments($postId);
      $pagination['itemsPerPage'] = $commentManager->itemsPerPage();
      $pagination['path'] = "index.php?action=post&id=$postId&page=";

      require_once('view/frontend/post.php');
    } else {
      throw new Exception('Identifiant d\'article introuvable');
    }
  }

  function listPosts()
  {
    $blogManager = new BlogManager();
    $blog = $blogManager->getSettings();

    $postManager = new PostManager('posts');
    $postManager->setItemsPerPage(10);
    $posts = $postManager->getPosts();

    $pagination['page'] = $postManager->currentPage();
    $pagination['items'] = $postManager->countPosts();
    $pagination['itemsPerPage'] = $postManager->itemsPerPage();
    $pagination['path'] = "index.php?page=";

    $authorManager = new AuthorManager();
    $author = $authorManager->getAuthor();

    require_once('view/frontend/home.php');
  }

  function addComment($postId, $author, $content)
  {
    $commentManager = new CommentManager('comments');

    $comment = new Comment(['postId'=>$postId, 'author'=>$author, 'content'=>$content]);

    if(!ctype_alnum(str_replace(' ','',$author))){
      $this->setFormError('author','Vous avez entré un nom incorrect');
    }

    if(empty($content)){
      $this->setFormError('comment','Le champ de commentaire est obligatoire');
    }

    if($this->formError){
      $this->setReturnMessage('danger', 'Veuillez corriger les erreurs');
      $_SESSION['comment'] = $comment;
    } else {
      $executeResult = $commentManager->newComment($comment);
      if($executeResult === false){
        $this->setReturnMessage('danger', 'Impossible d\'ajouter le commentaire !');
      } else {
        $postManager = new PostManager('posts');
        $postManager->addComment($postId);
        $this->setReturnMessage('success', 'Votre commentaire est publié');
      }
    }
    header('Location: index.php?action=post&id=' . $postId . '#add_comment');
  }

  function reportComment($commentId)
  {
    $commentManager = new CommentManager('comments');
    $comment = $commentManager->getComment($commentId);
    if ($comment){
      if ($comment->reported()) {
        throw new Exception('Vous avez déja signalé ce commentaire !');
      } else {
        $executeResult = $commentManager->reportComment($comment);
        if($executeResult === false){
          throw new Exception('Impossible de signaler le commentaire !');
        } else {
          $_SESSION["reportComment-".$comment->id()] = "reported";
          header('location:index.php?action=post&id='.$comment->postId());
        }
      }
    } else {
      throw new Exception('Identifiant de commentaire introuvable');
    }
  }

  function login($pseudo,$pass)
  {
    $pseudo = strtolower($pseudo);
    $authorManager = new AuthorManager();
    $author = $authorManager->getAuthor();
    $error = false;

    if ($pseudo === $author->pseudo()){
      $pv = password_verify($pass, $author->pass());

      if($pv){
        $_SESSION['id'] = $author->id();
        $_SESSION['pseudo'] = $pseudo;
        header('location:admin.php');
      }else{
        $this->setReturnMessage('danger', 'Mot de passe erroné !');
        $error = true;
      }
    }else{
      $this->setReturnMessage('danger', 'Utilisateur non trouvé !');
      $error = true;
    }
    if($error){
      require('view/frontend/login.php');
    }
  }

  function getLoginForm()
  {
    require('view/frontend/login.php');
  }

  function logout()
  {
    session_destroy();
    header('location:index.php');
  }
}