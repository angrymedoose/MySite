<?php

include ('db_conn.php');
define("ROOT", dirname(__FILE__));
include_once(ROOT . "/classes/tpl.php");

function GetData($comId){
  $sel = "SELECT * FROM `comments` WHERE `id` = '$comId' LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $user = $res['user'];
      $com = $res['comment'];
	  $place = $res['place'];
	  $date = $res['date'];
   }
    $dataArr = array($user, $place, $com, $date);
    return $dataArr;
  }
	
}

function MakeName($name){
	return '<h4 class="name"><i>' . $name . '</i></h4>';
}


function MakeDate($date){
	return '<br><p class="date"><i>'. $date . '</i></p></div><hr>';
}

function MakePlace($place){
	return '<p class="place"><ins><i> '. $place . '</i></ins></p>';
}

function MakeComment($com){
	return '<div class="text"><i>' . $com . '</i>';
}

function MakePage(){
	
	$res = mysql_query("SELECT COUNT(*) FROM `comments`");
				$row = mysql_fetch_row($res);
				$total = $row[0]; 
	
	if(!isset($_GET['id'])){
		$id = '0';
	}
	else {
		$id = addslashes(strip_tags(trim($_GET['id'])));
	}
	
	$id=$id+0;
	
	 
	if ((($id+0)>$total)|(($id+0)<=0)){
		$id = '0';
		}
 
	$num = $total - $id;
	if ($num>20) //для предыдущей
		{
			$num=20;
		}
		
		if($id==0){
			$id=$total;
		}
		
		$start_id=$id;
		
		if($id<20){
			$count=$id;
		}
		else{
			$count=20;
		}
		
		$text='';
			for($i=0;$i<$count;$i++){
					$data = GetData($id);
					$text=$text . MakeName($data[0]) . MakePlace($data[1]) . MakeComment($data[2]) .MakeDate($data[3]);
					$id--;
			}
				if($start_id!=$total)
				{
					$text=$text . '<br><a href=viewcomments.php?id=' . ($start_id+$num). '><Предыдущая</a>' ;
				}
				
				if($id!=0){
					$text=$text . '<a href=viewcomments.php?id=' . ($id). '>Следующая></a>' ;
				}
	
	return $text;
}

function GetComments($name){
	$flag = FALSE;
     $query = "SELECT * FROM `comments` WHERE place LIKE '%" . $name . "%'";
     $q = mysql_query($query);
     

     while ($res = mysql_fetch_assoc($q)) {
          $rez =  $rez .  MakeName($res['user']) . MakePlace($res['place']) . MakeComment($res['comment']) .MakeDate($res['date']);
          $flag = true;
     }

	if($flag){
			return $rez;
		}
		else
			return 'Никто еще не оставил отзыв :(';
}


if(isset($_GET['place'])){
	$name = $_GET['place'];
	$name = trim($name);
	$name=mb_strtolower($name, 'UTF-8');
	$values = GetComments($name);
}
else
	$values = MakePage();



$change ="{comments}";

$mytmp = new tpl;
$header = $mytmp->tpl_load('viewcom');
$html = str_replace($change, $values, $header);

echo $html;
