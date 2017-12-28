<?php
class CommentManager extends Manager
{
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT 0, 10');
		$req->execute([$postId]);
		$comments = $req->fetchAll();
		return $comments;
	}
	
	public function newComment($postId, $author, $content)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
		$executeResult = $req->execute([$postId,$author,$content]);
		return $executeResult;
	}
	
	public function getComment($commentId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts WHERE id = ?');
		$req->execute([$commentId]);
		$post = $req->fetch();
		return $post;
	}
	
}