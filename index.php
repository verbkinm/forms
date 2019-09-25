<!DOCTYPE HTML>
<<<<<<< HEAD
<html  lang="ru">
=======
<html>
>>>>>>> 96fbb39bab25e3cde3e5123e76034f31567814a4
	<head>
		<meta charset="utf-8">
	   <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="css/style.css">
	   <title>Главная</title>
	</head>
	<body class="body_index">
	
		<?php
			session_start();
			
			include("lib/connect.php");
			include("lib/lib_auth.php");
			include ("blocks/header.php");
			include ("blocks/menu.php");
		?>	
		
		<div class="content">	
			<div>
				<a href="forms/eatery_set.php" class="button">Заявки на питание</a>
				<a href="forms/medic_set.php" class="button">Подача информации о количестве больных</a>
			</div>
			<div>
				<a href="monitors/monitor.php" class="button">Просмотр заявок</a>
				<a href="monitors/monitor_medic.php" class="button">Просмотр данных</a>
			</div>	
		</div>	
<<<<<<< HEAD
		<?php
			include("blocks/footer.php");
		?>
=======
>>>>>>> 96fbb39bab25e3cde3e5123e76034f31567814a4
	 </body>
</html>

