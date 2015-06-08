<?php

function returnReg(){
     return '<div class="register"><a href="registration.php?id=r">Регистрация </a><a href="registration.php?id=in"> Войти</a></div>';
}

function databaseConnect()
{
    $host = 'localhost';
    $user = 'anya1';
    $pass = '123';
    $db = 'general';

    $connect = mysql_connect($host, $user, $pass);
    if (!$connect || !mysql_select_db($db, $connect)) {
        exit (mysql_error());
    }
    mysql_set_charset('utf8', $connect);
}

function makeLogout($name){
          return '<div class="logout"><form action="signin.php" method="post">Привет, '. $name .'! <input type="submit" value="Выход" /></form></div>';
     }

function chooseName(){
          if ((empty($_COOKIE['name'])) || (empty($_COOKIE['pass'])))
               return returnReg();
          else {
               databaseConnect();
               $query = "SELECT * FROM `user` WHERE `name` = '".$_COOKIE['name']."' AND `hash` = '".$_COOKIE['pass']."';";
               $ret = mysql_query($query);
               if(mysql_num_rows($ret) == 0) {
                    $error = returnReg();
                    setcookie("name","", time() - 3600);
                    setcookie("pass","", time() - 3600);
                    unset($_COOKIE);
                    return $error;
                    
               }
          else {
                return makeLogout($_COOKIE['name']);
                }
          }
     }
     
     
  function returnRegisterForm(){
      return '<form action="reg.php" method="post" enctype="multipart/form-data">
		<fieldset>
				<legend><b>Заполните свои данные:</b></legend>
				<table border="0">
					<tr>
						<td align="left">Имя:</td>
						<td align="left"><input type="text" name="name" size="20" value="" /></td>
					</tr>
					<tr>
						<td align="left">Пароль:</td>
						<td align="left"><input type="password" name="pass" size="30" value="" /></td>
					</tr>
					<tr>
						<td align="left">Подтверждение пароля:</td>
						<td align="left"><input type="password" name="pass2" size="30" value="" /></td>
					</tr>
				</table>
				<input type="submit" name="save" value="Отправить">
			</fieldset>
			</form>'; 
  }
  
  function returnInForm(){
       return '<form action="signin.php" method="post" enctype="multipart/form-data">
		<fieldset>
				<legend><b>Введите  свои данные:</b></legend>
				<table border="0">
					<tr>
						<td align="left">Имя:</td>
						<td align="left"><input type="text" name="name" size="20" value="" /></td>
					</tr>
					<tr>
						<td align="left">Пароль:</td>
						<td align="left"><input type="password" name="pass" size="30" value="" /></td>
					</tr>
				</table>
				<input type="submit" name="save" value="Отправить">
			</fieldset>
			</form>';
  }
  
       function makeCookies($name, $pass){
          setcookie("name", $name, time() + 3600*24*30*12);
          setcookie("pass", md5($pass), time() + 3600*24*30*12);
          header("Location: registration.php"); 
          exit();
     }
     
     function InOrReg($id){
          
          if($id=='r'){
             return returnRegisterForm();
          }
          else
          {
               return returnInForm();
          }
     }