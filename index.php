<?php

require_once('include/functions.php');

if (isset($_GET['action']))
{
	$action = $_GET['action'];
	switch ($action)
	{
		case 'post':
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$post = post(intval($_GET['id']));
				var_dump($post);
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
	var_dump($posts);
}