<?php	
	function GetDataArt($art_id){
  $sel = "SELECT * FROM `countries` WHERE `id` = '$art_id' LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
    echo('Не удалось взять данные из БД!');
  }
  else{
    if(mysql_num_rows($query)>0){
      $res = mysql_fetch_array($query);
      $about = $res['about'];
      $pictures = $res['pictures'];
      $about_pict = $res['about_pict'];
      $name = $res['name'];
	  $first_pict = $res['first_pict'];
      $first_name = $res['first_name'];
      $geo = $res['geo'];
      $climate = $res['climate'];
	  $people = $res['people'];
      $money = $res['money'];
      $food = $res['food'];
      $advice = $res['advice'];
	  $city = $res['link'];
	  $talk = $res['talk'];
   }
    else{
      $title = 'К сожалению, такая страница отсутствует на данном сайте!';
     $page_title = 'К сожалению, такая страница отсутствует на данном сайте!';
      $var_date = $desc=  '';
    }
    $data_arr = array($about, $pictures, $about_pict , $name,$first_pict, $first_name, $geo,$climate,$people,$money, $food, $advice, $city,$talk);
    return $data_arr;
  }
}
?>