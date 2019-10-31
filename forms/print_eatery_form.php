<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Печать заявок в столовую</title>
 </head>
 <body class="body_print_eatery_report">

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
	
	$count  	= $result['count'];
	$count_lg  	= $result['count_lg'];
	$names_lg	= $result['names_lg'];

	$disabled = "";
	if( !inRoles("admin") )
		$disabled = "disabled";
	
	$date = date('Y-m-d');
	$current_time = strtotime($date);
	$first_day_in_week = date('Y-m-d',$current_time-(date('N',$current_time) - 1)*86400);
	
	
echo "
<div class='content'>	
	<h3>Печать заявок в столовую</h3>
	<form action='../reports/report_eatery_pdf.php' method='post'>
		<input name='hide' value='report_eatery_pdf' hidden>
		<table class='table_set_data' class='table_print_eatery_report'>
			<tr>
				<td>
					Класс
				</td>
				<td>
					";
					if($disabled == "disabled") 
					{
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
			<tr>
				<td colspan='2'>
					<hr>
				</td>
			</tr>
			<tr>
				<td>
					Интервал:
				</td>
				<td>
					<div class='interval'>
						<div class='interval_start'>
							<input type='date' name='date_begin' value='".$first_day_in_week."' class='date'>
						</div>
						<div class='interval_end'>
							<input type='date' name='date_end' value='".$date."' class='date'>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'>
					<hr>
				</td>
			</tr>
			
			</tr>
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
				<td colspan='2' >
					<br><input type='submit' value='Печать' class='button_set'>
				</td>
			</tr>
		</table>
	</form>
</div>
  ";
	
	$mysqli->close();

	include ("../blocks/footer.php");
?>
 </body>
</html>
