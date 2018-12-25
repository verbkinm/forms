<!DOCTYPE HTML>
<html>
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
	 </body>
</html>

