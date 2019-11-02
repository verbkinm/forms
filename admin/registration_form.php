<!DOCTYPE HTML>

<html lang="ru">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <title>Данные формы</title>
 </head>
 <body class="body_registration">

<?php
	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
    check_permission(array('admin')); 

    $roles = [];

echo"	
	<div class='content'>
		<h3>Регистрация пользователя</h3>
		<form action='registration_get.php' method='post'>
			<input name='hide' value='registration' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
						<select size='1' required name='class' >
							<option disabled>Выберите класс</option>";
						require_once("../blocks/block_number_of_classes.php");
						echo"
						</select>
						<select size='1' required name='class_name' >
							<option disabled>Выберите класс</option>";
							require_once("../blocks/block_class_letters.php");
						echo"
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Логин:
					</td>
					<td>
						<input name='login' required type='text'>
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
						Имя пользователя:
					</td>
					<td>
						<input name='user_name' required type='text'>
					</td>
				</tr>
				<tr>
					<td>
						Роль:
					</td>
					<td>
						<select size=5 required name='roles[]' id='select_role' multiple>
							<option disabled>Выберите роль пользователя</option>";
							require_once("../blocks/roles.php");
						echo "</select>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:center;'>
						<br><input type='submit' value='Создать' class='button_set'>
					</td>
				</tr>
			</table>
		</form>
	</div>
";
	
	$mysqli->close();

	require_once("../blocks/footer.php");

?>
 </body>
</html>
