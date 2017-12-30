<?php

//session_start();

require('model/Blog.php');
require('model/Post.php');
require('model/Author.php');
require('model/Comment.php');

require('model/Manager.php');
require('model/BlogManager.php');
require('model/PostManager.php');
require('model/AuthorManager.php');
require('model/CommentManager.php');

class Controller
{
	private $returnMessage =  0;

	function loggedIn()
	{
		if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
			return true;
		} else {
			return false;
		}
	}

	public function returnMessage()
	{
		if (isset($_SESSION['returnMessage'])){
			$returnMessage = $_SESSION['returnMessage'];
			unset($_SESSION['returnMessage']);
			return $returnMessage;
		} else {
			return $this->returnMessage;
		}
	}

	public function setReturnMessage($message)
	{
		$this->returnMessage = $message;
	}
}