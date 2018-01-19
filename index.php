<?php

require_once('controller/frontend.php');
try
{
$frontend = new Frontend();
  if (isset($_GET['action']))
  {
    $action = $_GET['action'];
    switch ($action)
    {
      case 'post':
        if (isset($_GET['id']) && (int) $_GET['id'] > 0)
        {
          $frontend->post(intval($_GET['id']));
        }
        else {
          throw new Exception('Aucun identifiant d\'article envoyé');
        }
      break;

      case 'addComment':
        if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
          if (isset($_POST['author']) && isset($_POST['comment'])) {
            $frontend->addComment(intval($_GET['id']), trim($_POST['author']), trim($_POST['comment']));
          }
          else {
            throw new Exception('Tous les champs ne sont pas remplis !');
          }
        }
        else {
          throw new Exception('Aucun identifiant d\'article envoyé');
        }
        break;
      break;

      case 'reportComment':
        if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
          $frontend->reportComment(intval($_GET['id']));
        }
        else {
          throw new Exception('Aucun identifiant de commentaire envoyé');
        }
      break;

      case 'login':
        if($frontend->loggedIn()){
          header('location:admin.php');
          }
        else{
          if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
            $frontend->login($_POST['pseudo'], $_POST['pass']);
          }else{
            $frontend->getLoginForm();
          }
        }
      break;

      case 'logout':
        $frontend->logout();
      break;
    }
  }
  else
  {
    $frontend->listPosts();
  }
  if($frontend->redirection() !== false){
    header('location: ' . $frontend->redirection());
  }
}
catch (Exception $e)
{
  $error = $e->getMessage();
  require('view/frontend/error.php');
}