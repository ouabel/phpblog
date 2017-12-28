<?php
require_once('controller/controller.php');

function editPosts()
{
	$blogManager = new BlogManager();
	$postManager = new PostManager();
	
	$settings = $blogManager->getSettings();
	$posts = $postManager->getPosts();

	require('view/backend/postsEdit.php');
}