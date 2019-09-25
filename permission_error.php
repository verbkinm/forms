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
			<h3>Не достаточно прав для просмотра данной страницы!</h3>
		</div>	
<<<<<<< HEAD
		<?php
			include("blocks/footer.php");
		?>
=======
>>>>>>> 96fbb39bab25e3cde3e5123e76034f31567814a4
	 </body>
</html>