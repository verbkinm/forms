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
	
	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
	check_permission(array('admin', 'soc-pedagog')); 

	$login = $_SESSION['login'];
	
	$sql_auth = "SELECT * FROM auth WHERE login = '$login'";	
	$result_auth = check_error_db($mysqli, $sql_auth);
	$result = mysqli_fetch_array($result_auth);
	
	$user_id = $result['id'];
	$user_name = $result['user_name'];
	$class = $result['class'];
	$class_name	= $result['class_name'];
	
	$sql_eatery_user_data = "SELECT * FROM eatery_user_data WHERE user_id = '$user_id'";
	$result_eatery_user_data = check_error_db($mysqli, $sql_eatery_user_data);
	$result = mysqli_fetch_array($result_eatery_user_data);
	
	$count = $result['count'];
	$count_lg = $result['count_lg'];
	$names_lg = $result['names_lg'];

	$disabled = "";
	if( !inRoles("admin") )
		$disabled = "disabled";
	
	$date = date('Y-m-d');
	$current_time = strtotime($date);
	
	$next_week = date('Y-m-d',$current_time + 86400 * 7);
	$previos_week = date('Y-m-d',$current_time - 86400 * 7);
		
	$first_day_in_week = date('Y-m-d',$current_time-(date('N',$current_time) - 1)*86400);
	$last_day_in_week = date('Y-m-d',$current_time-(date('N',$current_time) - 7)*86400);
	
echo "
<div class='content'>	
	<h3>Выбор периода для отчета</h3>
	<form action='../reports/report_passes_period.php' method='post'>
		<table class='table_set_data' >
			<tr>
				<td>Класс</td>
				<td>
					<select size='1' required name='class'>
						<option disabled>Выберите класс</option>
						<option value='0'>Все</option>";
						for($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++)
							echo"<option value='$i'>$i</option>";
					echo"
					</select>
					<select size='1' required name='class_name'>
						<option disabled>Выберите класс</option>
						<option value='0'>Все</option>";
						foreach($_class_letters as $item)
							echo"<option value='$item'>$item</option>";
					echo"
					</select>
				</td>
			<tr>
				<td colspan='2'><hr></td>
			</tr>
			<tr>
				<td>Интервал:</td>
				<td>
					<div class='interval'>
						<div class='interval_start'>
							<input type='date' name='date_begin' value='$first_day_in_week' class='date'>
						</div>
						<div class='interval_end'>
							<input type='date' name='date_end' value='$last_day_in_week' class='date'>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><hr></td>
			</tr>
			
			<tr>
				<td colspan='2' >
					<br><input type='submit' value='Отчет' class='button_set'>
				</td>
			</tr>
		</table>
	</form>
</div>
  ";
	
	$mysqli->close();

	require_once ("../blocks/footer.php");
?>
 </body>
</html>
