<?php
class CommentManager extends Manager
{
	private $commentsPerPage;
	
	public function commentsPerPage()
	{
		return $this->commentsPerPage;
	}
	
	public function setCommentsPerPage($int)
	{
		$int = (int) $int;
		$this->commentsPerPage = $int;
	}
	
	public function getComments($criteria)
	{
		$comments = [];
		$db = $this->dbConnect();
		$currentPage = $this->currentPage();
		$commentsPerPage = $this->commentsPerPage;
		
		switch($criteria) {
			case 'all':
				$req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM comments ORDER BY comment_date DESC LIMIT ?, ?');
				$req->execute([($currentPage-1)*$commentsPerPage, $commentsPerPage]);
			break;
			
			case 'reported':
				$req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM comments WHERE reports > 0 ORDER BY comment_date DESC LIMIT ?, ?');
				$req->execute([($currentPage-1)*$commentsPerPage, $commentsPerPage]);
			break;
			
			default:
				$req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT ?, ?');
				$req->execute([$criteria, ($currentPage-1)*$commentsPerPage, $commentsPerPage]);
			break;
		}
		
		
		foreach ($req->fetchAll() as $data)
		{
			$comments[] = new Comment(['id'=>$data['id'],
								'author'=>$data['author'],
								'dateFr'=>$data['date_fr'],
								'content'=>$data['comment']]);
		}
	
        return $comments;
	}
	
	public function countComments($criteria)
	{
        $db = $this->dbConnect();

		switch($criteria){
			case 'all':
				$req = $db->prepare("SELECT count(*) FROM comments");
				$req->execute();
				break;
				
			case 'reported':
				$req = $db->prepare("SELECT count(*) FROM comments WHERE reports > 0");
				$req->execute();
				break;
				
			default :
				$req = $db->prepare("SELECT count(*) FROM comments WHERE post_id = ?"); 
				$req->execute(array($criteria)); 
				break;
		}
	 
		$commentsNumber = $req->fetchColumn();
		return $commentsNumber;
	}
	
	public function deletePostComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE post_id = ?');
        $executeResult = $req->execute(array($postId));
        
		return $executeResult;
    }
	
	public function newComment(Comment $comment)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
		$executeResult = $req->execute([$comment->postId(),$comment->author(),$comment->content()]);
		return $executeResult;
	}
	
	public function updateComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET author = ?, comment = ? WHERE id = ?');
		$executeResult = $req->execute([$comment->author(), $comment->content(), $comment->id()]);
        
		return $executeResult;
    }

	public function deleteComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');

        $executeResult = $req->execute([$comment->id()]);
        
		return $executeResult;
    }
	
	public function getComment($commentId)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
		
		$data = $req->fetch();
		
		$comment = new Comment(['id'=>$data['id'],
								'postId'=>$data['post_id'],
								'author'=>$data['author'],
								'content'=>$data['comment'],
								'dateFr'=>$data['date_fr']]);

        return $comment;
	}
	
	public function reportComment(Comment $comment)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reports = reports+1 WHERE id = ?');
        $executeResult = $req->execute([$comment->id()]);
		return $executeResult;
	}

	public function currentPage()
	{
		if(isset($_GET['page'])){
			$page = intval($_GET['page']);
			if($page <= 1){
				$page = 1;
			}
		} else {
			$page = 1;
		}
		return $page;
	}
}