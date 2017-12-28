<?php
class BlogManager extends Manager
{
	public function getSettings()
	{
		$db = $this->dbConnect();
		$req = $db->prepare("SELECT id, title, description FROM settings");
		$req->execute();
		$settings = $req->fetch();
		return $settings;
	}
	
	public function setSettings($title, $description)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE settings SET title = ?, description = ? WHERE id = 1');
		$executeResult = $req->execute([$title, $description]);

		return $executeResult;
	}
	
}