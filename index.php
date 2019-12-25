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
		
		if( inRoles('ot') ) 
			header("Location: http://".$_SERVER['SERVER_NAME']."/ot");
		
		require_once("blocks/header.php");
		require_once("blocks/menu.php");
	?>	
	
	<div class="content">	
		<table class='button_table'>
			<tr>
				<td><a href="forms/eatery_set.php" id='eatery'></a></td>
				<td><a href="monitors/monitor.php" id='monitor'></a></td>
				<td><a href="forms/pass_set.php" id='passes'></a></td>
			</tr>
			<tr>
				<td><a href="monitors/monitor.php" id='eatery-view'></a></td>
				<td><a href="monitors/monitor_medic.php" id='monitor-view'></a></td>
				<td><a href="monitors/monitor_passes.php" id='passes-view'></a></td>
			</tr>	
		</table>
	</div>	
	<?php
		require_once("blocks/footer.php");
	?>
	 </body>
</html>

