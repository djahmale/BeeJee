<?php

require_once( $_SERVER['DOCUMENT_ROOT']. "/db.php"); 
$name = strip_tags($_POST['name']);
$email = $_POST['email'];
$text = strip_tags($_POST['content']);

if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
	echo 'error';
	die();
}

$tasks = mysql_query("INSERT INTO tasks (name, email, content) VALUES ('".$name."', '".$email."', '".$text."')");

loop_tasks();
die();

?>