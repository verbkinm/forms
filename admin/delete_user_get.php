<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='5; URL=list.php'>
  <link rel="stylesheet" href="../css/style.css">
  <title>Регистрация пользователя</title>
 </head>
 <body>
<?php
	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
		
	echo"
		<div class='content'>
	";		
	if( $_POST['hide'] == "delete_user" ) {
		
		$login = $_POST['login'];
		
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$sql = "DELETE FROM `auth` WHERE login = '$login'";	
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Пользователь успешно удален<br>");
		
		$sql = "DELETE FROM `eatery_user_data` WHERE user_id = '$user_id'";
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Запись о пользователе успещно удалена из таблицы eatery_user_data<br>");
		$sql = "DELETE FROM `medic_user_data`	WHERE user_id = '$user_id'";
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Запись о пользователе успещно удалена из таблицы medic_user_data<br>");	
		
		$mysqli->close();
	}
	else {
		echo"
			<h3>Неккоректные данные!</h3>
		";
	}
	echo"
		</div>
	";
	
?>
 </body>
</html>
