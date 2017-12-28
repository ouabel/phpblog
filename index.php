<?php

$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

if (isset($_GET['action']))
{
	$action = $_GET['action'];
	switch ($action)
	{
		case 'post':
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				var_dump(intval($_GET['id']));
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
	echo 'Home';
}