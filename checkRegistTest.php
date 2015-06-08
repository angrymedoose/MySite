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
     else if(strlen($name)>20){
          $_SESSION["error"]='Слишком длинное имя!';
		return false;
     }
	
	if ($pass != $pass2){
		$_SESSION["error"]='Вы не подтвердили пароль!';
		return false;
	} 
return true;     
     
}