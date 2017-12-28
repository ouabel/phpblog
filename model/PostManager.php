<?php
class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 10');
		$req->execute();
		$posts = $req->fetchAll();
		return $posts;
	}
	
	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts WHERE id = ?');
		$req->execute([$postId]);
		$post = $req->fetch();
		return $post;
	}
	
}