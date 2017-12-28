<?php
class AuthorManager extends Manager
{
	public function getAuthor()
	{
		$db = $this->dbConnect();
		$req = $db->prepare("SELECT id, author, author_pseudo, email, pass FROM settings");
		$req->execute();
		$author = $req->fetch();
		return $author;
	}
	
}