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
	
	public function insertPost($title, $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date, update_date) VALUES(?, ?, NOW(), NOW())');
        $req->execute([$title, $post]);
		
		$lastInsertId = $db->lastInsertId();

        return $lastInsertId;
    }
	
	public function updatePost($postId, $title, $post)
	{
	    $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?');
        $req->execute([$title, $post, $postId]);
		
		$lastInsertId = $db->lastInsertId();

        return $lastInsertId;	
	}
	
	public function deletePost($postId)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $executeResult = $req->execute([$postId]);
		
		return $executeResult;
	}

}