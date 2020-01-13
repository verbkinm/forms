<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Пропуски форма</title>
 </head>
 <body class="set">

<?php  
	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
	require_once ("../lib/classes/class_Days.php");
		
	check_permission(['admin', 'user']); 
	
	$login = $_SESSION['login'];
	
	$sql_auth = "SELECT * FROM auth WHERE login = '$login'";	
	$result_auth = check_error_db($mysqli, $sql_auth);
	$result = mysqli_fetch_array($result_auth);
	
	$user_id 	= $result['id'];
	$user_name	= $result['user_name'];
	$class 		= $result['class'];
	$class_name	= $result['class_name'];	

	if(empty($_GET['date'])) {$date = date("Y-m-d");}
    else {$date=$_GET['date'];}
	
	$current_time = strtotime($date);
	$next_week = date('Y-m-d',$current_time + 86400 * 7);
	$previos_week = date('Y-m-d',$current_time - 86400 * 7);
	
	$first_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 1) * 86400);
	$last_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 7) * 86400);
	
	$disabled = "";
	if( !inRoles("admin") ) 
		$disabled = "disabled";
	
	if(isset($_GET['day']))
		$current_day = $_GET['day'];
	else
		$current_day = date("N");
	
	$week_number = date("W", $current_time);
	$sql = "SELECT * FROM passes WHERE class = $class AND class_name = '$class_name' AND week_number = $week_number AND day_number = $current_day";	
	$result = check_error_db($mysqli, $sql);
	$request = mysqli_fetch_array($result);	
	$passes_id = $request['id'];	
	if($passes_id == NULL)
		$passes_id = -1;
	$sql = "SELECT * FROM passes_application WHERE passes_id = $passes_id";	
	$result = check_error_db($mysqli, $sql);
	
	$days = new Days($current_day, $week_number, $date, $class, $class_name);
echo "
	<div class='content'>	
        <h1>Отсутствующие</h1>
		<div class='message_incorrect'>Внимание! <br> Отсутствующие подаються поурочно, а не за целый день! <br> <br></div>
    	<!-- <div class='message_incorrect'>Внимание! <br> Раздел в разработке! <br> <br></div> -->
		<form action='get.php' method='post'>
			<input name='hide' value='missing' hidden>
			<input name='current_day' value='$current_day' hidden>
			<input name='week_number' value='$week_number' hidden>
			<table class='table_set_data'>
				<caption><a href='?date=$previos_week&day=$current_day'><< </a>Данные об отсутствующих на период с $first_day_in_week по $last_day_in_week<a href='?date=$next_week&day=$current_day'> >></a></caption>
				<tr>
					<td colspan='2'>";
					$days->echo_days();
					echo
					"</td>
				</tr>
				
				<tr>
					<td colspan='2'><hr></td>
				</tr>
				
				<tr>
					<td>Класс</td>
					<td>
						";
						if($disabled == "disabled") 
							echo "<input hidden name='class' value='$class'>";
						echo"
						<select size='1' required name='class' $disabled>
							<option disabled>Выберите класс</option>";
							require_once("../blocks/select_class.php");
						echo"
						</select>
						";
						if($disabled == "disabled") 
							echo "<input hidden name='class_name' value='$class_name'>";
						echo"
						<select size='1' required name='class_name' $disabled>
							<option disabled>Выберите класс</option>";
							require_once("../blocks/select_class_name.php");
						echo"
						</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'><hr></td>
				</tr>
				
				<tr>
					<td colspan='2'>
						<table class='table_passes'>
							<thead>
								<td style='width:20px;'>№</td>
								<td style='width:200px;'>Ф.И.О. ученика</td>
								<td>По болезни</td>
								<td>По уважительной причине</td>
								<td>По неуважительной причине</td>
								<td>Всего</td>
								<td style='width:40px;'></td>
                            </thead>";
							
							$counter = 0;
							while ($request = $result->fetch_assoc()) 
							{
								echo"
								<tr class='rows_with_data_fields'>
									<td></td>
									<td><input name='name_of_patients$counter' value='".$request['student_name']."' required></td>
									<td><input type='number' min='0' max='100' name='absence_due_to_illness$counter' value='".$request['absence_due_to_illness']."'  onchange='data_change(this)' required></td>
									<td><input type='number' min='0' max='100' name='absence_for_a_good_reason$counter'value='".$request['absence_for_a_good_reason']."' onchange='data_change(this)' required></td>
									<td><input type='number' min='0' max='100' name='absence_of_a_valid_reason$counter' value='".$request['absence_of_a_valid_reason']."' onchange='data_change(this)' required></td>
									<td><input type='number' value='0' readonly required></td>
									<td class='remove_unit' colspan='2'><input type='button' onclick='remove(this)'></td>
								</tr>";
								$counter++;
							}
							echo"
							
							<tr>
								<td colspan='7' class='add_unit' style='text-align: left;'>
									<input id='add_button' type='button' onclick='add();'>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td>Итого:</td>
					<td><input id='total' type='number' min='0' max='1000' name='pass_count' value='0' readonly required></td>
				</tr>
				<tr>
					<td colspan='2'><hr></td>
				</tr>
				
				<tr>
					<td>Классный руководитель:</td>
					<td>
						";
						if($disabled == "disabled")
							echo "<input hidden name='user_name' value='$user_name'>";
						echo"
						<select name='user_name' size='1' required id='select_user' $disabled>
							<option disabled>Выберите пользователя</option>";
							require_once("../blocks/users_list.php");
							echo"
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='2' >";
						$disabled_submit = "";
						if( (($class == "0") || ($class_name == "0")) && !inRoles("admin") ) 
							$disabled_submit = "disabled";
						echo"
						<br><input type='submit' value='Отправить' class='button_set' $disabled_submit>
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
	<script type="text/javascript" src="../js/passes/passes.js">	
		table_row_numbers();
	</script>
</html>
