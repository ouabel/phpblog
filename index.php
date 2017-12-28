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

	}
}
else
{
	$posts = listPosts();
}