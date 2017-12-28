<?php

require_once('controller/backend.php');
try
{
	if(loggedIn()){
		if (isset($_GET['action']))
		{
			$action = $_GET['action'];
			switch ($action)
			{
				case 'insertPost':
					//
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