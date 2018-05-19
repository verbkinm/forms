<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <title>Данные формы</title>
 </head>
 <body class="body_registration">

<?php
	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	check_permission(array('admin')); 

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
							<option disabled>Выберите класс</option>
							<option value='0'>Нет</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
							<option value='7'>7</option>
							<option value='8'>8</option>
							<option value='9'>9</option>
							<option value='10'>10</option>
							<option value='11'>11</option>
						</select>
						<select size='1' required name='class_name' >
							<option disabled>Выберите класс</option>
							<option value='0'>Нет</option>
							<option value='А'>А</option>
							<option value='Б'>Б</option>
							<option value='В'>В</option>
							<option value='Г'>Г</option>
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
						<select size='1' required name='role' id='select_role' >
							<option disabled>Выберите роль пользователя</option>
							<option value='user'>Пользователь</option>
							<option value='monitor'>Монитор</option>
							<option value='admin'>Администратор</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:center;'>
						<br><input type='submit' value='Отправить' class='button_set'>
					</td>
				</tr>
			</table>
		</form>
	</div>
";
	
	$mysqli->close();
?>
 </body>
</html>
