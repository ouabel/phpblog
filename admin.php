<?php

require_once('controller/backend.php');
try
{
	if(loggedIn()){
		if (isset($_GET['action']))
		{
			$action = $_GET['action'];
			switch ($action){
				case 'insertPost':
					if (!empty($_POST['title']) && !empty($_POST['content'])) {
						insertPost($_POST['title'], $_POST['content']);
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				break;
					
				case 'newPost':
					newPost();
					break;
					
				case 'editPost':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						editPost(intval($_GET['id']));
					} else {
						throw new Exception('Aucun identifiant de billet envoyé');
					}
					break;
					
				case 'updatePost':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						if (!empty($_POST['title']) && !empty($_POST['content'])) {
							updatePost(intval($_GET['id']), $_POST['title'], $_POST['content']);
						} else {
							throw new Exception('Tous les champs ne sont pas remplis !');
						}
					} else {
						throw new Exception('Aucun identifiant de commentaire envoyé');
					}
					break;
				
				case 'deletePost':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
							deletePost(intval($_GET['id']));
					} else {
						throw new Exception('Aucun identifiant de billet envoyé');
					}
					break;
					
				case 'editComments':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						editComments(intval($_GET['id']));
					} else {
						if (isset($_GET['reported']) && (int) $_GET['reported'] === 1){
							editComments('reported');
						} else {
							editComments('all');
						}
					}
					break;
				
				case 'editComment':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						editComment(intval($_GET['id']));
					} else {
						throw new Exception('Aucun identifiant de commentaire envoyé');
					}
					break;
					
				case 'updateComment':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						if (!empty($_POST['author']) && !empty($_POST['comment'])) {
							updateComment(intval($_GET['id']), $_POST['author'], $_POST['comment']);
						} else {
							throw new Exception('Tous les champs ne sont pas remplis !');
						}
					} else {
						throw new Exception('Aucun identifiant de commentaire envoyé');
					}
					break;
					
				case 'deleteComment':
					if (isset($_GET['id']) && $_GET['id'] > 0) {
						deleteComment(intval($_GET['id']));
					} else {
						throw new Exception('Aucun identifiant de commentaire envoyé');
					}
					break;
					
				case 'settings':
						editSettings();
					break;
				
				case 'updateSettings':
					if (!empty($_POST['title']) && !empty($_POST['description'])) {

						updateSettings($_POST['title'], $_POST['description']);
						
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
					break;
				
				case 'updateAuthor':
					if (!empty($_POST['author']) && !empty($_POST['author_pseudo']) && !empty($_POST['email'])) {

						updateAuthor($_POST['author'], $_POST['author_pseudo'], $_POST['email'], $_POST['pass'], $_POST['pass2']);
						
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
					break;
			}
		}
		else
		{
			editPosts();
		}
	}
	else
	{
		header('location:index.php?action=login');
	}
}
catch (Exception $e)
{
	$error = $e->getMessage();
	require('view/frontend/error.php');
}