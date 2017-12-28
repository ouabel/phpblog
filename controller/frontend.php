<?php

require('model/Manager.php');
require('model/PostManager.php');
require('model/CommentManager.php');

function post($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	
	$commentManager = new CommentManager();
	$comments = $commentManager->getComments($postId);
	require_once('view/post.php');
}

function listPosts(){
	$postsManager = new PostManager();
	$posts = $postsManager->getPosts();
	require_once('view/home.php');
}

function addComment($postId, $author, $content){
	$commentManager = new CommentManager();
	$executeResult = $commentManager->newComment($postId, $author, $content);
	if($executeResult === false){
		throw new Exception('Impossible d\'ajouter le commentaire !');
	} else {
		header('Location: index.php?action=post&id=' . $postId);
	}
}