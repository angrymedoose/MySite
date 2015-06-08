<?php

function checkRegistration($name, $pass, $pass2){
     
     $name = trim($name);
     $pass = trim($pass);
     $pass2 = trim($pass2);
     
  if (($name=='')||($pass=='')||($pass2)==''){
     $_SESSION["error"]='Вы заполнили не все поля!';
     return false;
}


	if (strpos($name,' ') != false){
		$_SESSION["error"]='Имя не должно содержать пробельные символы.';
		return false;
	}
     else if(mb_strlen($name, 'UTF-8')>20){
          $_SESSION["error"]='Слишком длинное имя!';
		return false;
     }
	
	if ($pass != $pass2){
		$_SESSION["error"]='Вы не подтвердили пароль!' . md5($pass);
		return false;
	} 
return true;     
     
}

function mainRegist(){
     $name = $_POST["name"];
     $passw = $_POST["pass"];
     $pass2 = $_POST["pass2"];

     $ret = checkRegistration($name, $passw, $pass2);

     if ($ret == false){
          header("Location: registration.php?id=r");
          exit;
     }
     else
     {
          
          $name = trim($name, ' ');
          $passw = trim($passw, ' ');
          $pass2 = trim($pass2, ' ');
          include ('db_conn.php');
          $hash = md5($passw);
          $ret = mysql_query("INSERT INTO `user` (`name`, `hash`) VALUES ('$name','$hash')");
          $_SESSION["error"]= $_SESSION["error"] .'Вы успешно зарегестрированы :) Теперь вы можете зайти на сайт, ' . $name . '!';
          header("Location: registration.php?id=in");
               exit;  
}
}