<!DOCTYPE html>
<html>
	<head>
	<title>Поиск</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="liststyle.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>		
	<body>
		<div id="header" align="right">
			<form action="find.php" method="post" enctype="multipart/form-data" target="_blank">
<input name="num" type="text" id="form-query" value="" placeholder="поиск по сайту"> <input src="картинки/search.png" type="image" style="vertical-align: bottom; padding: 0;"/></form>
		</div>
		<div class="main">
			<a href="index.html">Главная</a>
			</div>
			<div class="article artlist">
			<?php	
include ('db_conn.php');
$key=$_POST["num"];
$flag = FALSE;
$key=trim($key);

if ((mb_strlen($key, 'UTF-8')!=0)&(mb_strlen($key, 'UTF-8')!=1)&(mb_strlen($key, 'UTF-8')!=2)){
$key=mb_strtolower($key, 'UTF-8');

$res = mysql_query("SELECT COUNT(*) FROM `countries`");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей
echo '<table vertical-align="center">';
for($i=1;$i<=$total;$i++){
  $sel = "SELECT * FROM `countries` WHERE `num` = $i LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $name = $res['name'];
	  $name=mb_strtolower($name, 'UTF-8');
	  if (strstr($name,$key)!=FALSE){
		  $flag=TRUE;
		echo '<tr><td><hr><img src="' . $res['first_name'] .'"/><br><br><br><a href=' . $res['my_link'] .  '>'. $res['name'] .'</a></tr></td>';
	}
  }
}
}

$res = mysql_query("SELECT COUNT(*) FROM `cities`");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей

for($i=1;$i<=$total;$i++){
  $sel = "SELECT * FROM `cities` WHERE `num` = $i LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $name = $res['name'];
	  $name2= $res['country'];
	  $name=mb_strtolower($name, 'UTF-8');
	  $name2=mb_strtolower($name2, 'UTF-8');
	  if ((strstr($name,$key)!=FALSE) | (strstr($name2,$key)!=FALSE)) {
		  $flag=TRUE;
		echo '<tr><td><hr><img src="' . $res['firstname'] .'"/><br><br><br><a href=' . $res['my_link'] .  '>'. $res['name'].', '. $res['country'] .'</a></tr></td>';
	}
  }
}
}

$res = mysql_query("SELECT COUNT(*) FROM `articles`");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей

for($i=1;$i<=$total;$i++){
  $sel = "SELECT * FROM `articles` WHERE `id` = $i LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $name = $res['keywords'];
	  $name=mb_strtolower($name, 'UTF-8');
	  if ((strstr($name,$key)!=FALSE)) {
		  $flag=TRUE;
		echo '<tr><td><hr><a href=articles.php?art_id=' . $res['id']. '>' . $res['name'] . '</a><br>' . $res['description'] . '</tr></td>';
	}
  }
}
}

if(!$flag) echo 'ничего не найдено :(';
}
else echo 'Поисковый запрос очень мал!';
echo '</table>';
?>
</div>
</body>
</html>