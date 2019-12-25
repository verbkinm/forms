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

	</div>	
	<?php
		require_once("blocks/footer.php");
	?>
	 </body>
</html>

