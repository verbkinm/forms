<!DOCTYPE HTML>

<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
  <title>Изменить данные</title>
 </head>
 <body class="body_registration">

<?php
	session_start();

	require_once("../../config/config.php");
	require_once("../../lib/connect.php");
	require_once("../../lib/lib_auth.php");
	require_once ("../../blocks/header.php");
	require_once ("../../blocks/ot/menu.php");
	
	check_permission(array('admin', 'ot_admin')); 

	$login = $_POST['login'];
	$user_name = $_POST['user_name'];
echo"	
	<div class='content'>
		<h1>Изменить данные пользователя</h1>
		<form action='edit_user_get.php' method='post'>
			<input name='hide' value='edit' hidden>
			<table class='table_set_data'>
				<tr>
					<td>Логин:</td>
					<td>
						<input name='login' required type='text' value='$login' readonly disable>
					</td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td>
						<input name='password' required type='password'>
					</td>
				</tr>
				<tr>
					<td>Имя пользователя:</td>
					<td>
						<input name='user_name' required type='text' value='$user_name'>
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

	require_once("../../blocks/footer.php");
?>
 </body>
</html>
