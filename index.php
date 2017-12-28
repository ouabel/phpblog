<?php

require_once('controller/frontend.php');
try
{
	if (isset($_GET['action']))
	{
		$action = $_GET['action'];
		switch ($action)
		{
			case 'post':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0)
				{
					$post = post(intval($_GET['id']));
				}
				else {
					throw new Exception('Aucun identifiant d\'article envoyé');
				}
			break;

			case 'addComment':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
					if (!empty($_POST['author']) && !empty($_POST['comment'])) {
						addComment(intval($_GET['id']), $_POST['author'], $_POST['comment']);
					}
					else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				}
				else {
					throw new Exception('Aucun identifiant d\'article envoyé');
				}
				break;
			break;
			
			case 'reportComment':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
					if (!isset($_SESSION['reportComment-'.$_GET['id']])) {
						reportComment(intval($_GET['id']));
					}
					else {
						throw new Exception('Vous avez déja signalé ce commentaire !');
					}
				}
				else {
					throw new Exception('Aucun identifiant de commentaire envoyé');
				}
			break;
		}
	}
	else
	{
		$posts = listPosts();
	}
}
catch (Exception $e)
{
	$error = $e->getMessage();
	require('view/error.php');
}