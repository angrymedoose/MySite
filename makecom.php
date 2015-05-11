<?php

	define("ROOT", dirname(__FILE__));
	include_once(ROOT . "/classes/tpl.php");
	require_once("errors.php");
	
	$text = Errors();
	
	if(!isset($_GET['place'])){
		$place = '';
	}
	else {
		$place = addslashes(strip_tags(trim($_GET['place'])));
	}
	
	$change =array("{errors}","{place}");
	$values =array($text,$place);

	$mytmp = new tpl;
	$header = $mytmp->tpl_load('makecom');
	$html = str_replace($change, $values, $header);

echo $html;