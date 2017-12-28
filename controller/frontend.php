<?php

require('model/Manager.php');
require('model/PostManager.php');

function post($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	require_once('view/post.php');
}

function listPosts(){
	$postsManager = new PostManager();
	$posts = $postsManager->getPosts();
	require_once('view/home.php');
}