<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='15; URL=registration_form.php'>
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
	if( $_POST['hide'] == "registration" ) {
		
		$login = strip_tags($_POST['login']);
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user_name 	= strip_tags($_POST['user_name']);
		$date = date("Y/m/d");
		$time = date("H:i:s");
		
		$sql = "SELECT * FROM auth WHERE login = '$login' ";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) 
		{
			$sql = "INSERT INTO auth (	login, 		password, 	  user_name, 	class,  class_name,      date,		time)
						VALUES 			  ('$login', 	'$password', '$user_name', 0, '0', '$date', '$time' )";
			correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись<br>");
			
			$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
			
			$sql = "INSERT INTO roles (	user_id, role)
					VALUES 			  ('$user_id', 	'ot_user' )";
			correct_or_error($mysqli, $sql, "Успешно создана новая учетная запись в таблицы roles<br>");
		}
		else 
			echo "Логин уже сужествует"; 
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
