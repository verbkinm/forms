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
	
	echo"
		<div class='content'>
	";		
	if( $_POST['hide'] == "registration" ) {
		
		$login 		= $_POST['login'];
		$password 	= $_POST['password'];
		$class 		= $_POST['class'];
		$class_name = $_POST['class_name'];
		$user_name 	= $_POST['user_name'];
		$role			= $_POST['role'];
		$date 		= date("Y/m/d");
		$time 		= date("H:i:s");
		
		$sql = "SELECT * FROM auth WHERE login = '$login' ";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO auth (	login, 		password, 	  user_name, 	class,  class_name,     role,	  date,		time)
						VALUES 			  ('$login', 	'$password', '$user_name', $class, '$class_name', '$role','$date', '$time' )";
			correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись, ");
			
			$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
			
			if( $role != "monitor" ) {
				$sql = "INSERT INTO eatery_user_data 	(user_id)
					VALUES 			  							($user_id)";
				correct_or_error($mysqli, $sql, "новая запись в таблице eatery_user_data, ");
				$sql = "INSERT INTO medic_user_data 	(user_id)
					VALUES 			  							($user_id)";
				correct_or_error($mysqli, $sql, "новая запись в таблице medic_user_data, ");
			}
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
