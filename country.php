<?php
define("ROOT", dirname(__FILE__));
include_once(ROOT . "/classes/tpl.php");


	include ('db_conn.php');
	include ('functions3.php');
	
	if(!isset($_GET['art_id'])){
		$art_id = '1';
	}
	else {
		$art_id = addslashes(strip_tags(trim($_GET['art_id'])));
	}
	$art_data = GetDataArt($art_id);

$About = $art_data[0];

$textjs = $art_data[1];

$about_pict=$art_data[2];

$name=$art_data[3];

$firstpict=$art_data[4];
$firstname=$art_data[5];
$geo=$art_data[6];
$climate=$art_data[7];
$people=$art_data[8];
$money=$art_data[9];
$food=$art_data[10];
$advice=$art_data[11];
$city=$art_data[12];
$talk=$art_data[13];
$change = array("{About}", "{textjs}","{about_pict}","{name}","{firstpict}","{firstname}","{geo}","{climate}","{people}","{money}","{food}","{advice}","{city}","{talk}");

$rt = array($About, $textjs,$about_pict,$name,$firstpict,$firstname,$geo,$climate,$people,$money,$food,$advice,$city,$talk);

$mytmp = new tpl;
$header = $mytmp->tpl_load('countries');

$html = str_replace($change, $rt, $header);
echo $html;
?>