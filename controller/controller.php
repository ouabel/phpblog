<?php

require('model/Blog.php');
require('model/Content.php');
require('model/Post.php');
require('model/Author.php');
require('model/Comment.php');

require('model/Manager/Manager.php');
require('model/Manager/Blog.php');
require('model/Manager/Content.php');
require('model/Manager/Post.php');
require('model/Manager/Author.php');
require('model/Manager/Comment.php');

class Controller
{
  protected $formError = false;

  public function getSettings()
  {
    $blogManager = new BlogManager();
    return $blogManager->getSettings();
  }

  public function loggedIn()
  {
    if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
      return true;
    } else {
      return false;
    }
  }

  public function setReturnMessage($type,$message)
  {
    $_SESSION['returnMessage'] = ['type' => $type, 'message' => $message];
    $this->returnMessage = true;
  }

  public function returnMessage()
  {
    if (isset($_SESSION['returnMessage'])){
      $returnMessage = $_SESSION['returnMessage'];
      unset($_SESSION['returnMessage']);
      return $returnMessage;
    } else {
      return false;
    }
  }

  public function setFormError($field, $error)
  {
    $_SESSION['formError'][$field][] = $error;
    $this->formError = true;
  }

  public function formError($field){
    if (isset($_SESSION['formError'][$field])){
      $formError = $_SESSION['formError'][$field];
      unset($_SESSION['formError'][$field]);
      $return = '<ul class="text-danger">';
      foreach($formError as $error){
        $return .= "<li>$error</li>";
      }
      $return .= '</ul>';
      return $return;
    } else {
      return false;
    }
  }
}