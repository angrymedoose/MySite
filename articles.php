<?php
	include ('db_conn.php');
	include ('functions.php');
	define("ROOT", dirname(__FILE__));
	include_once(ROOT . "/classes/tpl.php");

	if(!isset($_GET['art_id'])){
		$art_id = '1';
	}
	else {
		$art_id = addslashes(strip_tags(trim($_GET['art_id'])));
		$total = GetCount();
	}
	
	if((!isset($_GET['list']))|($_GET['list']<1) | ($_GET['list']>$total)){
		$link = $art_id;
	}
	else{
		$link = addslashes(strip_tags(trim($_GET['list'])));
	}
	
	if (($art_id<1) | ($art_id>$total)){
		$title = 'Данная страница не существует на сайте';
		$article = '<img src="статьи/er.jpg"/>';
		$link = $total;
	}
	else{
		$art_data = GetDataArt($art_id);
		
		$title = $art_data[0];
		$article = $art_data[1];	
	}
	
	$change =array("{title}","{article}","{link}");
	$values =array($title, $article, $link);

	$mytmp = new tpl;
	$header = $mytmp->tpl_load('article');
	$html = str_replace($change, $values, $header);

	echo $html;