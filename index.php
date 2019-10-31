<!DOCTYPE HTML>
<html  lang="ru">
	<head>
		<meta charset="utf-8">
	   <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="css/style.css">
	   <title>Главная</title>
	</head>
	<body class="body_index">
	
	<?php
		session_start();
		
		require_once("lib/connect.php");
		require_once("lib/lib_auth.php");
		require_once("blocks/header.php");
		require_once("blocks/menu.php");
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
	<?php
		require_once("blocks/footer.php");
	?>
	 </body>
</html>

