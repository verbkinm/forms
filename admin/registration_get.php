<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='15; URL=registration_form.php'>
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
	if( $_POST['hide'] == "registration" ) {
		
		$login 		= strip_tags($_POST['login']);
		$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		$class 		= strip_tags($_POST['class']);
		$class_name = strip_tags($_POST['class_name']);
		if( ($class == "0") || ($class_name == "0") ) {$class=$class_name=0;}	
		$user_name 	= strip_tags($_POST['user_name']);
		
		$roles = array();
		foreach($_POST['roles'] as $role) 
			array_push($roles, $role);
			
		$date 		= date("Y/m/d");
		$time 		= date("H:i:s");
		
		$sql = "SELECT * FROM auth WHERE login = '$login' ";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO auth (	login, 		password, 	  user_name, 	class,  class_name,      date,		time)
						VALUES 			  ('$login', 	'$password', '$user_name', $class, '$class_name', '$date', '$time' )";
			correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись<br>");
			
			$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
			
			foreach($roles as $role){
				$sql = "INSERT INTO roles (	user_id, role)
						VALUES 			  ('$user_id', 	'$role' )";
				correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись в таблицы roles<br>");
			}
			$sql = "INSERT INTO eatery_user_data 	(user_id)
				VALUES 			  							($user_id)";
			correct_or_error($mysqli, $sql, "новая запись в таблице eatery_user_data<br>");
			$sql = "INSERT INTO medic_user_data 	(user_id)
				VALUES 			  							($user_id)";
			correct_or_error($mysqli, $sql, "новая запись в таблице medic_user_data<br>");
		}
		else {
			echo "Логин уже сужествует"; 
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
