<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='5; URL=list.php'>
  <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../../css/style.css">
  <title>Регистрация пользователя</title>
 </head>
 <body>
<?php
	session_start();

	include("../../lib/connect.php");
	include("../../lib/lib_auth.php");
	include ("../../blocks/header.php");
	include ("../../blocks/ot/menu.php");
	
	check_permission(array('admin', 'ot_admin')); 
		
	echo"
		<div class='content'>
	";		
	if( $_POST['hide'] == "delete_user" ) 
	{
		
		$login = $_POST['login'];
		
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$sql = "DELETE FROM `auth` WHERE login = '$login'";	
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Пользователь успешно удален<br>");
		
		$sql = "DELETE FROM `roles` WHERE user_id = '$user_id'";
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Запись о ролях успещно удалена из таблицы roles<br>");	
		
		$mysqli->close();
	}
	else 
		echo"<h3>Неккоректные данные!</h3>";
	
	echo"
		</div>
	";
	
	require_once("../../blocks/footer.php");
?>
 </body>
</html>
