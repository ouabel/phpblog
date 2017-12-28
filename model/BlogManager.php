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
	
}