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
	if( $_POST['hide'] == "edit" ) {
		
		$login 		= $_POST['login'];
		$class 		= $_POST['class'];
		$class_name = $_POST['class_name'];
		$password	= $_POST['password'];
		$user_name 	= $_POST['user_name'];
		$role 		= $_POST['role'];
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$sql = "UPDATE auth SET login = '$login', password = '$password', role = '$role', user_name = '$user_name',  class = '$class', class_name = '$class_name'
					WHERE id = '$user_id'";
		correct_or_error($mysqli, $sql, "Запись успешно обновлена =)");
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
