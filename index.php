<?php

require_once('controller/frontend.php');

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
			else
			{
				echo 'Aucun identifiant d\'article envoyé';
			}
		break;

		case 'addComment':
			if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
				if (!empty($_POST['author']) && !empty($_POST['comment'])) {
					addComment(intval($_GET['id']), $_POST['author'], $_POST['comment']);
				}
				else {
					echo 'Tous les champs ne sont pas remplis !';
				}
			}
			else {
				echo 'Aucun identifiant d\'article envoyé';
			}
			break;
		break;
	}
}
else
{
	$posts = listPosts();
}