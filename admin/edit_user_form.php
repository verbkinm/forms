<!DOCTYPE HTML>
<html>
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
	$role 		= $_POST['role'];
	
echo"	
	<div class='content'>
		<h3>Изменить данные пользователя</h3>
		<form action='edit_user_get.php' method='post'>
			<input name='hide' value='edit' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
						<select size='1' required name='class' >
							<option disabled>Выберите класс</option>
							<option value='0'>Нет</option>";
							$i = 1;
							while($i < 12) {
								if( ($i) == $class ) {
									$selected = "selected";
								}
								echo"
									<option value='".$i."' ".$selected.">".$i++."</option>
								";	
								unset($selected);
							}
						echo"
						</select>
						<select size='1' required name='class_name' >
							<option disabled>Выберите класс</option>
							<option value='0'>Нет</option>";
							/*192 - А, 196 - Г*/
							$i = 192;
							while($i < 196) {
								$char = chr($i++);
								$utf8_char = iconv('CP1251', 'UTF-8', $char);
								if( $utf8_char == $class_name ) {
									$selected = "selected";
								}
								echo"
									<option value='".$utf8_char."' ".$selected.">".$utf8_char."</option>
								";	
								unset($selected);
							}
						echo"
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Логин:
					</td>
					<td>
						<input name='login' required type='text' value='".$login."'>
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
