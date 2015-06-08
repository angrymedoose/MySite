<?php

	define("ROOT", dirname(__FILE__));
	include_once(ROOT . "/classes/tpl.php");
     include_once("registFunc.php");

	$text=chooseName();
	$change =array("{hello}");
	$values =array($text);

	$mytmp = new tpl;
	$header = $mytmp->tpl_load('index');
	$html = str_replace($change, $values, $header);

echo $html;