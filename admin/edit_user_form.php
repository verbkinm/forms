<!DOCTYPE HTML>

<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <title>Изменить данные</title>
 </head>
 <body class="body_registration">

<?php
	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	check_permission(array('admin')); 

	$login 		= $_POST['login'];
	$class 		= $_POST['class'];
	$class_name = $_POST['class_name'];
	$user_name 	= $_POST['user_name'];
	$roles   	= $_POST['array_roles'];
	
	
echo"	
	<div class='content'>
		<h3>Изменить данные пользователя</h3>";
		
		foreach($roles as $item)
			echo "$item";
		
		echo"
		<form action='edit_user_get.php' method='post'>
			<input name='hide' value='edit' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
						<select size='1' required name='class' >
							<option disabled>Выберите класс</option>";
						include("../blocks/block_number_of_classes.php");
						echo"
						</select>
						<select size='1' required name='class_name' >
							<option disabled>Выберите класс</option>";
							include("../blocks/block_class_letters.php");
						echo"
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Логин:
					</td>
					<td>
						<input name='login' required type='text' value='".$login."' readonly disable>
					</td>
				</tr>
				<tr>
					<td>
						Пароль:
					</td>
					<td>
						<input name='password' required type='password'>
					</td>
				</tr>
				<tr>
					<td>
						Классный руководитель:
					</td>
					<td>
						<input name='user_name' required type='text' value='".$user_name."'>
					</td>
				</tr>
				<tr>
					<td>
						Роль:
					</td>
					<td>
						<select required name='roles[]' id='select_role' multiple >
							<option disabled>Выберите роль пользователя</option>";
							include("roles.php");
						echo "</select>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:center;'>
						<br><input type='submit' value='Изменить' class='button_set'>
					</td>
				</tr>
			</table>
		</form>
	</div>
";
	$mysqli->close();

	include("../blocks/footer.php");
?>
 </body>
</html>
