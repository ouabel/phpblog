<?php
function dbConnect()
{
	$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	return $db;
}

function post($postID)
{
	$db = dbConnect();
	$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts WHERE id = ?');
	$req->execute([$postID]);
	$post = $req->fetch();
	return $post;
}

function listPosts(){
	$db = dbConnect();
	$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 10');
	$req->execute();
	$posts = $req->fetchAll();
	return $posts;
}