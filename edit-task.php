<?php

require_once( $_SERVER['DOCUMENT_ROOT']. "/db.php"); 

$text = strip_tags($_POST['content']);
$status = ($_POST['status']=='on') ? 'Выполнено' : '';
$status_edited = $_POST['status_edited'];
if($_COOKIE["old_content"] <> $_POST['content']) $status_edited = 'Отредактировано администратором';

$id = $_POST['task-id'];

$admin_role = $_COOKIE["open_login"];

if(!$admin_role) {
	echo 'error';
	die();
} 

$tasks = mysql_query("UPDATE tasks SET content = '$text', status = '$status', status_edited = '$status_edited' WHERE ID=$id");
loop_tasks();
die();

?>