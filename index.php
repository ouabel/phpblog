<?php

$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

var_dump($db);