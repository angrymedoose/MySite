<?php	
                    include ('db_conn.php');
                    $key=$_POST["num"];
                    $flag = FALSE;
                    $key=trim($key);

                    if ((mb_strlen($key, 'UTF-8')!=0)&(mb_strlen($key, 'UTF-8')!=1)&(mb_strlen($key, 'UTF-8')!=2)){
                         echo '<table vertical-align="center">';
                         $query = "SELECT * FROM `countries` WHERE name LIKE '%" . $key . "%'";
                         $q = mysql_query($query);

                        while ($res = mysql_fetch_assoc($q)) {
                               echo '<tr><td><hr><a href=' . $res['my_link'] .  '><img src="' . $res['first_name'] .'"/></a><br><br><br><a href=' . $res['my_link'] .  '>'. $res['name'] .'</a></tr></td>';
                                   $flag = true;
                        }
                        
                         $query = "SELECT * FROM `cities` WHERE name LIKE '%" . $key . "%'";
                         $q = mysql_query($query);

                        while ($res = mysql_fetch_assoc($q)) {
                               echo '<tr><td><hr><a href=' . $res['my_link'] .  '><img src="' . $res['firstname'] .'"/></a><br><br><br><a href=' . $res['my_link'] .  '>'. $res['name'].', '. $res['country'] .'</a></tr></td>';
                                   $flag = true;
                        }
                        
                        $query = "SELECT * FROM `cities` WHERE country LIKE '%" . $key . "%'";
                         $q = mysql_query($query);

                        while ($res = mysql_fetch_assoc($q)) {
                               echo '<tr><td><hr><a href=' . $res['my_link'] .  '><img src="' . $res['firstname'] .'"/></a><br><br><br><a href=' . $res['my_link'] .  '>'. $res['name'].', '. $res['country'] .'</a></tr></td>';
                                   $flag = true;
                        }
                        
                        
                         $query = "SELECT * FROM `articles` WHERE keywords LIKE '%" . $key . "%'";
                         $q = mysql_query($query);

                        while ($res = mysql_fetch_assoc($q)) {
                               echo '<tr><td><hr><a href=articles.php?art_id=' . $res['id']. '>' . $res['name'] . '</a><br>' . $res['description'] . '</tr></td>';
                                   $flag = true;
                        }
                       

                         if(!$flag) echo 'ничего не найдено :(';
                         }
                         else echo 'Поисковый запрос очень мал!';
                         echo '</table>';
                         