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
          <div id="logo">
          <img src="страны/logo.png">
          </div>
		<div class="main">
			<a href="index.php">Главная</a>
			</div>
			<div class="article artlist">
			<?php include ('find_func.php');?>
</div>
</body>
</html>