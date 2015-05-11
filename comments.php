<?php

include ('db_conn.php');

function WriteComment($name,$comment,$place){
	date_default_timezone_set('Europe/Minsk');
	$today = date("Y-m-d H:i:s"); 
	$ret = mysql_query("INSERT INTO `comments` (`user`, `place`,`comment`,`date`) VALUES ('$name', '$place', '$comment', '$today')");
}

session_start();
$name = $_POST["name"];
$place = $_POST["place"];
$comment = $_POST["comment"];

$place = trim($place);
	if ($place == ''){
		$_SESSION["error"]='Вы не ввели описываемое место.';
		header("Location:makecom.php");
		exit;
	}
	
$comment = trim($comment);
	if ($comment == ''){
		$_SESSION["error"]='Вы не написали комментарий.';
		header("Location:makecom.php");
		exit;
	}
		
$name = trim($name);
	if ($name == ''){
		$name = 'Пользователь';
	}
	
	WriteComment($name,$comment,$place);
	header("Location:viewcomments.php");