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
	
	public function setAuthor($name, $pseudo, $email, $pass)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE settings SET author = ?, author_pseudo = ?, email = ?, pass = ? WHERE id = 1');
		$executeResult = $req->execute([$name, $pseudo, $email, $pass]);

		return $executeResult;
	}
}