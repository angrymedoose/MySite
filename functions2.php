<?php	
	function GetDataArt($art_id){
  $sel = "SELECT * FROM `cities` WHERE `id` = '$art_id' LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $name = $res['name'];
      $country = $res['country'];
      $about_pict = $res['pictures'];
      $link = $res['countrylink'];
      $first_name = $res['firstname'];
      $about = $res['about'];
      $text = $res['text'];
      $flag = $res['flag'];
   }
    else{
      $title = 'К сожалению, такая страница отсутствует на данном сайте!';
     $page_title = 'К сожалению, такая страница отсутствует на данном сайте!';
      $var_date = $desc=  '';
    }
    $data_arr = array($name, $country, $about_pict, $link, $first_name, $about,$text,$flag);
    return $data_arr;
  }
}
?>