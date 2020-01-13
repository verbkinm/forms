<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='5; URL=list.php'>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
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
	if( $_POST['hide'] == "edit" ) {
		
		$login = strip_tags($_POST['login']);
		$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user_name 	= strip_tags($_POST['user_name']);
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$sql = "UPDATE auth SET login = '$login', password = '$password', user_name = '$user_name',  class = 0, class_name = '0'
				WHERE id = '$user_id'";
		correct_or_error($mysqli, $sql, "Запись успешно обновлена =)<br>");
		
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
