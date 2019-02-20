<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Данные формы</title>
 </head>
 <body class="set">

<?php
	session_start();
	
	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	check_permission(array('admin', 'user')); 

	$login = $_SESSION['login'];
	
	$sql_auth = "SELECT * FROM auth WHERE login = '$login'";	
	$result_auth = check_error_db($mysqli, $sql_auth);
	$result = mysqli_fetch_array($result_auth);
	
	$user_id 	= $result['id'];
	$user_name	= $result['user_name'];
	$class 		= $result['class'];
	$class_name	= $result['class_name'];
	
	$sql_eatery_user_data = "SELECT * FROM eatery_user_data WHERE user_id = '$user_id'";
	$result_eatery_user_data = check_error_db($mysqli, $sql_eatery_user_data);
	$result = mysqli_fetch_array($result_eatery_user_data);
	
	$count  		= $result['count'];
	$count_lg  	= $result['count_lg'];
	$names_lg	= $result['names_lg'];

	if( !inRoles("admin") ) {
		$disabled = "disabled";
	}	
echo "
<div class='content'>	
	<h3>Заявка в столовую</h3>
	<div class='message_incorrect'>Внимание! <br> После отправки - данные заявки исправить нельзя! <br> <br></div>
	<form action='get.php' method='post'>
		<input name='hide' value='eatery' hidden>
		<table class='table_set_data'>
			<tr>
				<td>
					Класс
				</td>
				<td>
					";
					if($disabled == "disabled") {
						echo"
							<input hidden name='class' value='".$class."'>
						";
					}
					echo"
					<select size='1' required name='class' ".$disabled.">
						<option disabled>Выберите класс</option>";
						include("../blocks/select_class.php");
					echo"
					</select>
					";
					if($disabled == "disabled") {
						echo"
							<input hidden name='class_name' value='".$class_name."'>
						";
					}
					echo"
					<select size='1' required name='class_name' ".$disabled.">
						<option disabled>Выберите класс</option>";
						include("../blocks/select_class_name.php");
					echo"
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Количество детей:
				</td>
				<td>
					<input name='count' required type='number' min='0' max='100' value='".$count."'> 
				</td>
			</tr>
			<tr>
				<td>
					Из них - льготников:
				</td>
				<td>
					<input name='count_lg' required type='number' min='0' max='100' value='".$count_lg."'>
				</td>
			</tr>
			<tr>
				<td>
					Ф.И. льготников:
				</td>
				<td>
					<textarea name='names_lg'>".$names_lg."</textarea>
				</td>
			</tr>
			<tr>
				<td>
					Классный руководитель:
				</td>
				<td>
					";
					if($disabled == "disabled") {
						echo"
							<input hidden name='user_name' value='".$user_name."'>
						";
					}
					echo"
					<select name='user_name' size='1' required id='select_user' ".$disabled.">
						<option disabled>Выберите пользователя</option>";
						include("../blocks/users_list.php");
						echo"
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2' >";
					if( (($class == "0") || ($class_name == "0")) && !inRoles("admin") ) {$disabled_submit="disabled";}
					echo"
					<br><input type='submit' value='Отправить' class='button_set'".$disabled_submit.">
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
