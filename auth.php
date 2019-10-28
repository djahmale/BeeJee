<?php

require_once( $_SERVER['DOCUMENT_ROOT']. "/db.php"); 
$pass = $_POST['pwd'];
$log = $_POST['login'];
$result = mysql_query("SELECT name, password FROM users WHERE name='".$log."' AND password='".$pass."'");
$json = array();

if(!mysql_fetch_array($result)) {
	$json['error'] = 1;
	echo json_encode($json);
	die();
}

$json['error'] = 0; 
echo json_encode($json);
die();

?>