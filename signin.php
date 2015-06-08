<?php
session_start();
require_once("registFunc.php");
     
if (!(empty($_COOKIE['name'])) | (!empty($_COOKIE['pass']))){
     setcookie ("name", "", time() - 3600);
     setcookie ("pass", "", time() - 3600);
     header("Location: index.php"); 
     exit();   
} else {
     $name = $_POST['name'];
     $pass = $_POST['pass'];
     $name = trim($name);
     $pass = trim($pass);
     if(($name == '') | ($pass=='')){
          $_SESSION["error"]='Вы заполнили не все поля!';
     header("Location: registration.php?id=in");
		exit;
          
     }

     makeCookies($name,$pass);
}