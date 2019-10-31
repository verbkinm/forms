<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <script type="text/javascript" src="../js/passes/passes.js"></script>
  <title>Пропуски форма</title>
 </head>
 <body class="set">

<?php  
	session_start();

	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
		
	check_permission(array('admin', 'editor')); 
	
	$passes_id = -1;
	if(isset($_POST['passes_id']))
		$passes_id = $_POST['passes_id'];
	else
		header("Location: http://".$_SERVER['SERVER_NAME']."/permission_error.php"); 
	
	$sql = "SELECT * FROM passes WHERE id = $passes_id";	
	$result = check_error_db($mysqli, $sql);
	$request = mysqli_fetch_array($result);	
	
	$class = $request['class'];
	$class_name = $request['class_name'];
	$full_class_name = $class.$class_name;
	
	$user_name = $request['user_name'];
	
	$sql = "SELECT * FROM passes_application WHERE passes_id = $passes_id";	
	$result = check_error_db($mysqli, $sql);

echo "
	<div class='content'>	
        <h3>Изменение данных об отсутствующих для заявки №$passes_id</h3>
		<form action='get.php' method='post'>
			<input name='hide' value='missing_edit' hidden>
			<input name='passes_id' value='$passes_id' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
						<select size='1' required name='class' disabled>
							<option selected>$class</option>
						</select>
						<select size='1' required name='class_name' disabled>
							<option selected>$class_name</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'>
						<hr>
					</td>
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
					<td>
						Итого:
					</td>
					<td>
						<input id='total' type='number' min='0' max='1000' name='pass_count' value='0' readonly required>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<hr>
					</td>
				</tr>
				
				<tr>
					<td>
						Классный руководитель:
					</td>
					<td>
						<select name='user_name' size='1' required id='select_user' disabled>
							<option selected>$user_name</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan='2' >
						<br><input type='submit' value='Изменить' class='button_set'>
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
