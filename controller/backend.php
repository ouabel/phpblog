<?php
require_once('controller/controller.php');

class backend extends Controller
{
	function editPosts()
	{
		$blogManager = new BlogManager();
		$postManager = new PostManager();
		
		$blog = $blogManager->getSettings();
		$postManager->setPostsPerPage(20);
		$posts = $postManager->getPosts();

		$pagination['page'] = $postManager->currentPage();
		$pagination['items'] = $postManager->countPosts();
		$pagination['itemsPerPage'] = $postManager->postsPerPage();
		$pagination['path'] = "admin.php?page=";
		
		require('view/backend/postsEdit.php');
	}

	function newPost()
	{
		require('view/backend/postNew.php');
	}

	function insertPost($title, $content)
	{
		$postManager = new PostManager();
		$post = new Post(['title'=>$title, 'content'=>$content]);
		$lastInsertId = $postManager->insertPost($post);
		
		if ($lastInsertId === '0') {
			throw new Exception('Impossible d\'ajouter le billet !');
		}
		else {
			header('Location: admin.php?action=editPost&id='.$lastInsertId);
		}
	}

	function editPost($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		require('view/backend/postEdit.php');
	}

	function updatePost($postId, $title, $content)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		
		$post->setTitle($title);
		$post->setContent($content);

		$executeResult = $postManager->updatePost($post);
		
		if ($executeResult === false) {
			throw new Exception('Impossible de modifier le billet !');
		}
		else {
			header('Location: admin.php?action=editPost&id='.$postId);
			//echo 'Billet modifié';
		}
	}

	function deletePost($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);

		$executeResult = $postManager->deletePost($post);

		if ($executeResult === false) {
			throw new Exception('Impossible de supprimer le billet !');
		}
		else {
			$commentManager = new commentManager();
			$affectedRows = $commentManager->deletePostComments($postId);
			if ($affectedRows === false) {
				throw new Exception('Impossible de supprimer les commentaires du billet !');
			}
			else {
				//header('Location: admin.php'); //redirect back
				echo 'Billet supprimé';
			}
		}
	}

	function editComments($criteria)
	{
		$blogManager = new BlogManager();
		$commentManager = new CommentManager();
		
		if (is_int($criteria)){
			$postManager = new PostManager();
			$post = $postManager->getPost($criteria);
		}
		
		$blog = $blogManager->getSettings();
		$commentManager->setCommentsPerPage(50);
		$comments = $commentManager->getComments($criteria);
		
		$pagination['page'] = $commentManager->currentPage();
		$pagination['items'] = $commentManager->countComments($criteria);
		$pagination['itemsPerPage'] = $commentManager->commentsPerPage();
		if ($criteria === 'all') {
			$pagination['path'] = "admin.php?action=editComments&page=";
		} else if ($criteria === 'reported'){
			$pagination['path'] = "admin.php?action=editComments&reported=1&page=";
		} else {
			$pagination['path'] = "admin.php?action=editComments&id=$criteria&page=";
		}
		
		require('view/backend/commentsEdit.php');
	}

	function editComment($commentId)
	{
		$commentManager = new CommentManager();
		$comment = $commentManager->getComment($commentId);

		require('view/backend/commentEdit.php');
	}

	function updateComment($commentId,$author,$content)
	{
		$commentManager = new CommentManager();
		$comment = new Comment(['id'=>$commentId, 'author'=>$author, 'content'=>$content]);
		
		$executeResult = $commentManager->updateComment($comment);

		if ($executeResult === false) {
			throw new Exception('Impossible de modifier le commentaire !');
		}
		else {
			header('Location: admin.php?action=editComment&id='.$comment->id());  // redirect back
			//echo 'Commentaire modifié';
		}
	}

	function deleteComment($commentId)
	{
		$commentManager = new CommentManager();
		$comment = $commentManager->getComment($commentId);
		
		$executeResult = $commentManager->deleteComment($comment);
		if ($executeResult === false) {
			throw new Exception('Impossible de supprimer le commentaire !');
		}
		else {
			echo 'Commentaire supprimé';
		}
	}

	function editSettings()
	{
		$blogManager = new BlogManager();
		$authorManager = new AuthorManager();
		$blog = $blogManager->getSettings();
		$author = $authorManager->getAuthor();
		require('view/backend/settings.php');
	}

	function updateSettings($title, $description)
	{

		$blogManager = new BlogManager();
		$blog = $blogManager->getSettings();
		$blog->setTitle($title);
		$blog->setDescription($description);
		
		$executeResult = $blogManager->setSettings($blog);
		
		if ($executeResult === false) {
			throw new Exception('Impossible de modifier les réglages !');
		}
		else {
			header('Location: admin.php?action=settings'); // TODO: show updated message
		}

	}

	function updateAuthor($name, $pseudo, $email, $pass, $pass2)
	{
		if((!empty($pass) || !empty($pass2)) && $pass !== $pass2){
			throw new Exception('Les deux mots de passe ne correspondent pas !');
		}
		else{
			$authorManager = new AuthorManager();
			$author = $authorManager->getAuthor();
			$author->setName($name);
			$author->setPseudo($pseudo);
			$author->setEmail($email);
		
			if(!empty($pass)){
				$pass = password_hash($pass , PASSWORD_DEFAULT);
				$author->setPass($pass);
			}

			$executeResult = $authorManager->setAuthor($author);
			if ($executeResult === false) {
				throw new Exception('Impossible de modifier l\'autheur !');
			}
			else {
				header('Location: admin.php?action=settings'); // TODO: show updated message
			}
		}
	}
}