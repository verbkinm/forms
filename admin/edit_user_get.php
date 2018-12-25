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
	
	check_permission(array('admin')); 
	
	echo"
		<div class='content'>
	";		
	if( $_POST['hide'] == "edit" ) {
		
		$login 		= strip_tags($_POST['login']);
		$class 		= strip_tags($_POST['class']);
		$class_name = strip_tags($_POST['class_name']);
		if( ($class == "0") || ($class_name == "0") ) {$class=$class_name=0;}		
		$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user_name 	= strip_tags($_POST['user_name']);
		
		$roles = array();
		foreach($_POST['roles'] as $role) 
			array_push($roles, $role);
			
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$sql = "UPDATE auth SET login = '$login', password = '$password', user_name = '$user_name',  class = '$class', class_name = '$class_name'
					WHERE id = '$user_id'";
		correct_or_error($mysqli, $sql, "Запись успешно обновлена =)<br>");
		
		$sql = "DELETE FROM roles WHERE user_id = '$user_id'";
		$result = check_error_db($mysqli, $sql);
		correct_or_error($mysqli, $sql, "Запись о пользователе успещно удалена из roles<br>");
		
		foreach($roles as $role){
			$sql = "INSERT INTO roles (	user_id, role)
					VALUES 			  ('$user_id', 	'$role' )";
			correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись в таблицы roles<br>");
		}
		
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
