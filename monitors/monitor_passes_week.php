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
		
	check_permission(['admin', 'soc-ped']); 

	if(empty($_GET['class_number']) || empty($_GET['class_name']) || empty($_GET['date']))
		header("Location: http://".$_SERVER['SERVER_NAME']."/permission_error.php"); 
	
	$class = $_GET['class_number'];
	$class_name	= $_GET['class_name'];	
	$date = $_GET['date'];
	
	$sql_auth = "SELECT id,user_name FROM auth WHERE class = $class
				 AND class_name = '$class_name'";	
	$result_auth = check_error_db($mysqli, $sql_auth);
	$result = mysqli_fetch_array($result_auth);
	
	$user_name = $result['user_name'];
	$current_time = strtotime($date);
	$next_week = date('Y-m-d',$current_time + 86400 * 7);
	$previos_week = date('Y-m-d',$current_time - 86400 * 7);
	
	$first_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 1) * 86400);
	$last_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 7) * 86400);
	
	if(isset($_GET['day']))
		$current_day = $_GET['day'];
	else
		$current_day = date("N");
	
	$week_number = date("W", $current_time);
	$sql = "SELECT * FROM passes WHERE class = $class 
			AND class_name = '$class_name' 
			AND week_number = $week_number 
			AND day_number = $current_day";	
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
    	<!-- <div class='message_incorrect'>Внимание! <br> Раздел в разработке! <br> <br></div> -->
		<form action='get.php' method='post'>
			<input name='hide' value='missing' hidden>
			<input name='current_day' value='$current_day' hidden>
			<input name='week_number' value='$week_number' hidden>
			<table class='table_set_data'>
				<caption>
					<a href='?class_number=$class&class_name=$class_name&date=$previos_week&day=$current_day'><< </a>
					Данные об отсутствующих на период с $first_day_in_week по $last_day_in_week
					<a href='?class_number=$class&class_name=$class_name&date=$next_week&day=$current_day'> >></a></caption>
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
						<input type='text' readonly value='$class' style='width:157px; height:25px;'>
						<input type='text' readonly value='$class_name' style='width:157px; height:25px;'>
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
								</tr>";
								$counter++;
							}
							echo"
							
							<tr>
								<td colspan='6' class='add_unit' style='text-align: left;'>
									<input hidden id='add_button' type='button' onclick='add();'> <!-- /оставляем, чтобы работал подсчет -->
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
						<input type='text' readonly value='$user_name'>
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
