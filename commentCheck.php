<?php

function databaseConnect(){
     $host = 'localhost';
	$user = 'anya1';
	$pass = '123';
	$db = 'general';
	
	$connect = mysql_connect($host,$user,$pass);
	if (!$connect || !mysql_select_db($db, $connect))
		{
		exit (mysql_error());
		}
	mysql_set_charset('utf8',$connect);
}

function WriteComment($name,$comment,$place){
	date_default_timezone_set('Europe/Minsk');
	$today = date("Y-m-d H:i:s"); 
	$ret = mysql_query("INSERT INTO `comments` (`user`, `place`,`comment`,`date`) VALUES ('$name', '$place', '$comment', '$today')");
}

function check($place, $comment){
    $place = trim($place);
	if ($place == ''){
		$_SESSION["error"]='Вы не ввели описываемое место.';
		return false;
	}
	
     $comment = trim($comment);
	if ($comment == ''){
		$_SESSION["error"]='Вы не написали комментарий.';
		return false;
	} 
 return true; 
}

function MakeComments(){
session_start();
$place = $_POST["place"];
$comment = $_POST["comment"];

$ret = check($place, $comment);
echo $ret;
if ($ret==false){
     header("Location:makecom.php");
	exit;
}
else{		
	if ((empty($_COOKIE['name']))){
		$name = 'Пользователь';
	}
     else {
          $name = $_COOKIE['name'];
     }
	databaseConnect();
	WriteComment($name,$comment,$place);
	header("Location:viewcomments.php");
}
}