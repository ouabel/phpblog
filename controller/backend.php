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
		$error = false;
		
		if (empty($title)){
			$error = true;
			$this->setReturnMessage('Le champ titre est obligatoire');
		} else {
			$post = new Post(['title'=>$title, 'content'=>$content]);
			$lastInsertId = $postManager->insertPost($post);

			if($lastInsertId === '0'){
				$error = true;
				$this->setReturnMessage('Impossible d\'ajouter l\'article !');
			}
		}

		if ($error) {
			require('view/backend/postNew.php');
		}
		else {
			$_SESSION['returnMessage'] = 'Article publié avec succès <a href="index.php?action=post&id='.$lastInsertId.'">Afficher</a>';
			header('location:admin.php?action=editPost&id='.$lastInsertId);
		}
	}

	function editPost($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		if($post){
			require('view/backend/postEdit.php');
		} else {
			throw new Exception('Identifiant d\'article introuvable');
		}
	}

	function updatePost($postId, $title, $content)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		
		$post->setTitle($title);
		$post->setContent($content);

		$executeResult = $postManager->updatePost($post);
		
		if ($executeResult === false) {
			$this->setReturnMessage('Impossible de modifier l\'article !');
		}
		else {
			$this->setReturnMessage('Article mis à jour avec succès <a href="index.php?action=post&id='.$postId.'">Afficher</a>');
		}
		$this->editPost($post->id());
	}

	function deletePost($postId)
	{
		$postManager = new PostManager();
		$post = $postManager->getPost($postId);
		if($post){
			$executeResult = $postManager->deletePost($post);

			if ($executeResult === false) {
				$_SESSION['returnMessage'] = 'Impossible de supprimer l\'article !';
			}
			else {
				$commentManager = new commentManager();
				$affectedRows = $commentManager->deletePostComments($postId);
				if ($affectedRows === false) {
					$_SESSION['returnMessage'] = 'Impossible de supprimer les commentaires d\'article !';
				}
				else {
					$_SESSION['returnMessage'] = 'Article supprimé avec succès';
				}
			}
			header('Location: admin.php');
		} else {
			throw new Exception('Identifiant d\'article introuvable');
		}
		//TODO: redirect home if deleted from frontend
	}

	function editComments($criteria)
	{
		$blogManager = new BlogManager();
		$commentManager = new CommentManager();
		
		if (is_int($criteria)){
			$postManager = new PostManager();
			$post = $postManager->getPost($criteria);
			if (!$post){
				throw new Exception('Identifiant d\'article introuvable');
			}
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
		if ($comment) {
			require('view/backend/commentEdit.php');
		} else {
			throw new Exception('Identifiant de commentaire introuvable');
		}
	}

	function updateComment($commentId,$author,$content)
	{
		$commentManager = new CommentManager();
		$comment = new Comment(['id'=>$commentId, 'author'=>$author, 'content'=>$content]);
		
		$executeResult = $commentManager->updateComment($comment);

		if ($executeResult === false) {
			$this->setReturnMessage('Impossible de modifier le commentaire !');
		}
		else {
			$this->setReturnMessage('Commentaire modifié avec succès');
		}
		$this->editComment($comment->id());
	}

	function deleteComment($commentId)
	{
		$commentManager = new CommentManager();
		$comment = $commentManager->getComment($commentId);
		if ($comment){
			$executeResult = $commentManager->deleteComment($comment);
			if ($executeResult === false) {
				$_SESSION['returnMessage'] = 'Impossible de supprimer le commentaire !';
			}
			else {
				$_SESSION['returnMessage'] = 'Commentaire supprimé avec succès';
			}
		} else {
			throw new Exception('Identifiant de commentaire introuvable');
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
			$this->setReturnMessage('Impossible de modifier les réglages !');
		}
		else {
			$this->setReturnMessage('Réglages mis à jour avec succès');
		}
		$this->editSettings();
	}

	function updateAuthor($name, $pseudo, $email, $pass, $pass2)
	{

		if((!empty($pass) || !empty($pass2)) && $pass !== $pass2){
			$this->setReturnMessage('Les deux mots de passe ne correspondent pas !');
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
				$this->setReturnMessage('Impossible de modifier l\'autheur !');
			}
			else {
				$this->setReturnMessage('Auteur mis à jour avec succès');
			}
		}

		$this->editSettings();
	}
}