<?php

require('model/Manager.php');
require('model/BlogManager.php');
require('model/PostManager.php');
require('model/AuthorManager.php');
require('model/CommentManager.php');

function post($postId)
{
	$blogManager = new BlogManager();
	$settings = $blogManager->getSettings();
	
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	
	$authorManager = new AuthorManager();
	$author = $authorManager->getAuthor();
	
	$commentManager = new CommentManager();
	$comments = $commentManager->getComments($postId);
	
	require_once('view/post.php');
}

function listPosts(){
	$blogManager = new BlogManager();
	$settings = $blogManager->getSettings();
	
	$postsManager = new PostManager();
	$posts = $postsManager->getPosts();
	
	$authorManager = new AuthorManager();
	$author = $authorManager->getAuthor();
	
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

function reportComment($commentId){
	$commentManager = new CommentManager();
	$executeResult = $commentManager->reportComment($commentId);
	if($executeResult === false){
		throw new Exception('Impossible de signaler le commentaire !');
	} else {
		$_SESSION["reportComment-$commentId"] = "reported";
		echo 'Commentaire signalé';
	}
}