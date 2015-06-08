<?php

	define("ROOT", dirname(__FILE__));
	include_once(ROOT . "/classes/tpl.php");
	require_once("registFunc.php");
     require_once("errors.php");
	
	$errors = Errors();
     
     if ((empty($_COOKIE['name'])) || (empty($_COOKIE['pass'])))
          { 
               if(!isset($_GET['id'])){
                    $id = 'in';
               }
               else {
                    $id = addslashes(strip_tags(trim($_GET['id'])));
               }
          
          if($id=='r'){
             $title = 'Регистрация'; 
          }
          else
          {
               $title = 'Вход';   
          }
          $form = InOrReg($id);
     } 
     else {
          databaseConnect();
          $query = "SELECT * FROM `user` WHERE `name` = '".$_COOKIE['name']."' AND `hash` = '".$_COOKIE['pass']."';";
          $ret = mysql_query($query);
          if(mysql_num_rows($ret) == 0) {
               $errors .= 'Введенные данные неверны!' ;
               $form = returnInForm();
               $title = 'Вход';
               setcookie("name");
               setcookie("pass");
               unset($_COOKIE);         
          }
          else {
               
                header("Location: index.php"); 
                exit();
                }   
     }
	
	$change =array("{title}", "{errors}","{form}");
	$values =array($title, $errors,$form);

	$mytmp = new tpl;
	$header = $mytmp->tpl_load('registration');
	$html = str_replace($change, $values, $header);

echo $html;

