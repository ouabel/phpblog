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
		$posts = [];
		$db = $this->dbConnect();
		$currentPage = $this->currentPage();
		$postsPerPage = $this->postsPerPage;
		
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %H:%i\') AS update_date_fr FROM posts ORDER BY creation_date DESC LIMIT ?, ?');
		$req->execute([($currentPage-1)*$postsPerPage, $postsPerPage]);
		
		foreach ($req->fetchAll() as $data)
		{
			$posts[] = new Post(['id'=>$data['id'],
								'title'=>$data['title'],
								'content'=>$data['content'],
								'dateFr'=>$data['date_fr'],
								'updateDateFr'=>$data['update_date_fr']]);
		}
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
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %H:%i\') AS update_date_fr FROM posts WHERE id = ?');
        $req->execute([$postId]);

        $data = $req->fetch();
		
		$post = new Post(['id'=>$data['id'],
						'title'=>$data['title'],
						'content'=>$data['content'],
						'dateFr'=>$data['update_date_fr'],
						'updateDateFr'=>$data['update_date_fr']]);

        return $post;
	}
	
	public function insertPost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date, update_date) VALUES(?, ?, NOW(), NOW())');
        $req->execute([$post->title(), $post->content()]);
		
		$lastInsertId = $db->lastInsertId();

        return $lastInsertId;
    }
	
	public function updatePost(Post $post)
	{
	    $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?');
        $req->execute([$post->title(), $post->content(), $post->id()]);
		
		$lastInsertId = $db->lastInsertId();

        return $lastInsertId;	
	}
	
	public function deletePost(Post $post)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $executeResult = $req->execute([$post->id()]);
		
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