<?php
	include ('db_conn.php');
	include ('functions.php');
	
	define("ROOT", dirname(__FILE__));
	include_once(ROOT . "/classes/tpl.php");
	
	if(!isset($_GET['id'])){
		$id = '-1';
	}
	else {
		$id = addslashes(strip_tags(trim($_GET['id'])));
	}
	
	$id=$id+0;
	
	 $res = mysql_query("SELECT COUNT(*) FROM `articles`");
				$row = mysql_fetch_row($res);
				$total = $row[0]; // всего записей
	if ((($id+0)>$total)|(($id+0)<=0)){
		$id = '-1';
		}
		
	$res = mysql_query("SELECT COUNT(*) FROM `articles`");
	$row = mysql_fetch_row($res);
	$total = $row[0]; 
	$num = $total - $id;
	if ($num>10)
		{
			$num=10;
		}
		$start_id=$id;
		
		if($id==-1){
			$id=$total;
		}
		
		$start_id=$id;
		
		if($id<10){
			$count=$id;
		}
		else{
			$count=10;
		}
		
		$text='<table>';
			for($i=0;$i<$count;$i++){
					$art_data = GetDataArt($id);
					$text=$text .'<tr><td>'. '<li><a href=articles.php?art_id=' . ($id). '&list='. $start_id . '>'  . $art_data[0] . '</a></li>' . $art_data[2].'<br><br><br>'.'<div align=\'right\'>'. $art_data[3] . '</div></td></tr>' ;					
					$id--;
			}
				if($start_id!=$total)
				{
					$text=$text . '</table>'. '<br><a href=articlelist.php?id=' . ($start_id+$num). '><Предыдущая</a>' ;
				}
				else
				{
					$text=$text . '</table>';
				}
				
				if($id!=0){
					$text=$text . '<a href=articlelist.php?id=' . ($id). '>Следующая></a>' ;
				}
			
$change ="{text}";
$values = $text;

$mytmp = new tpl;
$header = $mytmp->tpl_load('articles');
$html = str_replace($change, $values, $header);

echo $html;
				
