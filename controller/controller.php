<?php

require('model/Manager.php');
require('model/BlogManager.php');
require('model/PostManager.php');
require('model/AuthorManager.php');
require('model/CommentManager.php');

function loggedIn()
{
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
		return true;
	} else {
		return false;
	}
}