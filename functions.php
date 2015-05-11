<?php	
function GetDataArt($art_id){
  $sel = "SELECT * FROM `articles` WHERE `id` = '$art_id' LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $title = $res['name'];
      $page_title = $res['article'];
      $desc = $res['description'];
      $var_date = $res['date'];
   }
    else{
      $title = 'К сожалению, такая страница отсутствует на данном сайте!';
     $page_title = 'К сожалению, такая страница отсутствует на данном сайте!';
      $var_date = $desc=  '';
    }
    $data_arr = array($title, $page_title, $desc, $var_date);
    return $data_arr;
  }
}

function GetCount(){
	$res = mysql_query("SELECT COUNT(*) FROM `articles`");
	$row = mysql_fetch_row($res);
	$total = $row[0]; 
	
	return $total;			
}