<?php
require_once('controller/controller.php');

class Frontend extends Controller
{
	function post($postId)
	{
		$blogManager = new BlogManager();
		$blog = $blogManager->getSettings();
		
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		
		$authorManager = new AuthorManager();
		$author = $authorManager->getAuthor();
		
		$commentManager = new CommentManager();
		$commentManager->setCommentsPerPage(20);
		$comments = $commentManager->getComments($postId);
		
		$pagination['page'] = $commentManager->currentPage();
		$pagination['items'] = $commentManager->countComments($postId);
		$pagination['itemsPerPage'] = $commentManager->commentsPerPage();
		$pagination['path'] = "index.php?action=post&id=$postId&page=";
		
		require_once('view/frontend/post.php');
	}

	function listPosts()
	{
		$blogManager = new BlogManager();
		$blog = $blogManager->getSettings();
		
		$postManager = new PostManager();
		$postManager->setPostsPerPage(10);
		$posts = $postManager->getPosts();
		
		$pagination['page'] = $postManager->currentPage();
		$pagination['items'] = $postManager->countPosts();
		$pagination['itemsPerPage'] = $postManager->postsPerPage();
		$pagination['path'] = "index.php?page=";
		
		$authorManager = new AuthorManager();
		$author = $authorManager->getAuthor();
		
		require_once('view/frontend/home.php');
	}

	function addComment($postId, $author, $content)
	{
		$commentManager = new CommentManager();
		$comment = new Comment(['postId'=>$postId, 'author'=>$author, 'content'=>$content]);

		$executeResult = $commentManager->newComment($comment);
		if($executeResult === false){
			throw new Exception('Impossible d\'ajouter le commentaire !');
		} else {
			header('Location: index.php?action=post&id=' . $postId);
		}
	}

	function reportComment($commentId)
	{
		$commentManager = new CommentManager();
		$comment = $commentManager->getComment($commentId);
		if ($comment->reported()) {
			throw new Exception('Vous avez déja signalé ce commentaire !');
		} else {
			$executeResult = $commentManager->reportComment($comment);
			if($executeResult === false){
				throw new Exception('Impossible de signaler le commentaire !');
			} else {
				$_SESSION["reportComment-".$comment->id()] = "reported";
				header('location:index.php?action=post&id='.$comment->postId());
			}
		}
	}

	function login($pseudo,$pass)
	{
		$authorManager = new AuthorManager();
		$author = $authorManager->getAuthor();

		if ($pseudo === $author->pseudo()){
			$pv = password_verify($pass, $author->pass());
			
			if($pv){
				$_SESSION['id'] = $author->id();
				$_SESSION['pseudo'] = $pseudo;
				header('location:admin.php');
			}else{
				throw new Exception('Mot de passe erroné !');
			}
		}else{
			throw new Exception('Utilisateur non trouvé !');
		}
	}

	function getLoginForm()
	{	
		require('view/frontend/login.php');
	}

	function logout()
	{
		session_destroy();
		header('location:index.php');
	}
}