<?php
define("ROOT", dirname(__FILE__));
include_once(ROOT . "/classes/tpl.php");

	include ('db_conn.php');
	include ('functions2.php');
	
	if(!isset($_GET['art_id'])){
		$art_id = '1';
	}
	else {
		$art_id = addslashes(strip_tags(trim($_GET['art_id'])));
	}
	$art_data = GetDataArt($art_id);

$name = $art_data[0];

$countryname = $art_data[1];

$about_pict='';
$textjs=$art_data[2];

$countrylink=$art_data[3];

$firstpict='';
$firstname=$art_data[4];

$about=$art_data[5];

$places=$art_data[6];

$flag = $art_data[7];

$change = array("{about}","{places}", "{textjs}","{about_pict}","{name}","{firstpict}","{firstname}","{countryname}","{countrylink}","{flag}");

$rt = array($about, $places, $textjs,$about_pict,$name,$firstpict,$firstname,$countryname,$countrylink,$flag);



$mytmp = new tpl;
$header = $mytmp->tpl_load('cities');

$html = str_replace($change, $rt, $header);
echo $html;
?>