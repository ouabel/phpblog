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
	function loggedIn()
	{
		if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
			return true;
		} else {
			return false;
		}
	}
}