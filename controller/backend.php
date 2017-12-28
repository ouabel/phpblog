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

function newPost()
{
	require('view/backend/postNew.php');
}

function insertPost($title, $content)
{
	$postManager = new PostManager();
	$lastInsertId = $postManager->insertPost($title, $content);
	
	if ($lastInsertId === '0') {
		throw new Exception('Impossible d\'ajouter le billet !');
	}
	else {
		header('Location: admin.php?action=editPost&id='.$lastInsertId);
	}
}

function editPost($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	require('view/backend/postEdit.php');
}

function updatePost($postId, $title, $content)
{
	$postManager = new PostManager();
	$executeResult = $postManager->updatePost($postId, $title, $content);
	
	if ($executeResult === false) {
		throw new Exception('Impossible de modifier le billet !');
	}
	else {
		header('Location: admin.php?action=editPost&id='.$postId);
		//echo 'Billet modifié';
	}
}

function deletePost($postId)
{
	$postManager = new PostManager();

	$executeResult = $postManager->deletePost($postId);

	if ($executeResult === false) {
		throw new Exception('Impossible de supprimer le billet !');
	}
	else {
		$commentManager = new commentManager();
		$affectedRows = $commentManager->deletePostComments($postId);
		if ($affectedRows === false) {
			throw new Exception('Impossible de supprimer les commentaires du billet !');
		}
		else {
			//header('Location: admin.php'); //redirect back
			echo 'Billet supprimé';
		}
	}
}

function editComments($criteria)
{
	$blogManager = new BlogManager();
	$commentManager = new CommentManager();
	
	if (is_int($criteria)){
		$postManager = new PostManager();
		$post = $postManager->getPost($criteria);
	}
	
	$settings = $blogManager->getSettings();
	$comments = $commentManager->getComments($criteria);

	require('view/backend/commentsEdit.php');
}

function editComment($commentId)
{
	$commentManager = new CommentManager();
	$comment = $commentManager->getComment($commentId);

	require('view/backend/commentEdit.php');
}

function updateComment($commentId,$author,$content)
{
	$commentManager = new CommentManager();
	$executeResult = $commentManager->updateComment($commentId,$author,$content);

	if ($executeResult === false) {
		throw new Exception('Impossible de modifier le commentaire !');
	}
	else {
		header('Location: admin.php?action=editComment&id='.$commentId);  // redirect back
		//echo 'Commentaire modifié';
	}
}

function deleteComment($commentId)
{
	$commentManager = new CommentManager();
	
	$executeResult = $commentManager->deleteComment($commentId);
	if ($executeResult === false) {
		throw new Exception('Impossible de supprimer le commentaire !');
	}
	else {
		echo 'Commentaire supprimé';
	}
}

function editSettings()
{
	$blogManager = new BlogManager();
	$authorManager = new AuthorManager();
	$settings = $blogManager->getSettings();
	$author = $authorManager->getAuthor();
	require('view/backend/settings.php');
}

function updateSettings($title, $description)
{

	$blogManager = new BlogManager();
	$executeResult = $blogManager->setSettings($title, $description);
	
	if ($executeResult === false) {
		throw new Exception('Impossible de modifier les réglages !');
	}
	else {
		header('Location: admin.php?action=settings'); // TODO: show updated message
	}

}

function updateAuthor($name, $pseudo, $email, $pass, $pass2)
{
	if((!empty($pass) || !empty($pass2)) && $pass !== $pass2){
		throw new Exception('Les deux mots de passe ne correspondent pas !');
	}
	else{
		$authorManager = new AuthorManager();
		$author = $authorManager->getAuthor();
		
		if(!empty($pass)){
			$pass = password_hash($pass , PASSWORD_DEFAULT);
		} else {
			$pass = $author['pass'];
		}
		
		var_dump($author);
		$executeResult = $authorManager->setAuthor($name, $pseudo, $email, $pass);
		if ($executeResult === false) {
			throw new Exception('Impossible de modifier l\'autheur !');
		}
		else {
			header('Location: admin.php?action=settings'); // TODO: show updated message
		}
	}
}