<?
include $_SERVER['DOCUMENT_ROOT']. "/config.php"; 
mysql_connect(sql_host, sql_user, sql_pass) or
    die("Could not connect: " . mysql_error());
mysql_select_db(sql_db);		
mysql_query("SET NAMES 'utf8';");
include $_SERVER['DOCUMENT_ROOT']. "/model/functions.php";