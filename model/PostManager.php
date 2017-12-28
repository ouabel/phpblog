<?php
class PostManager extends Manager
{
	private $postsPerPage;
	
	public function postsPerPage(){
		return $this->postsPerPage;
	}
	
	public function setPostsPerPage($int){
		$int = (int) $int;
		$this->postsPerPage = $int;
	}
	
	public function getPosts()
	{
		$db = $this->dbConnect();
		$currentPage = $this->currentPage();
		$postsPerPage = $this->postsPerPage;
		
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr FROM posts ORDER BY creation_date DESC LIMIT ?, ?');
		$req->execute([($currentPage-1)*$postsPerPage, $postsPerPage]);
		$posts = $req->fetchAll();
		return $posts;
	}
	
	public function countPosts(){
        $db = $this->dbConnect();
		$req = $db->prepare("SELECT count(*) FROM posts"); 
		$req->execute(); 
		$postsNumber = $req->fetchColumn();
		return $postsNumber;
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