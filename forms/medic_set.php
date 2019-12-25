<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Данные формы</title>
 </head>
 <body  class="set">
<?php
	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
	check_permission(['admin', 'user']); 
		
	$login = $_SESSION['login'];
	
	$sql_auth = "SELECT * FROM auth WHERE login = '$login'";	
	$result_auth = check_error_db($mysqli, $sql_auth);
	$result = mysqli_fetch_array($result_auth);
	
	$user_id = $result['id'];
	$user_name = $result['user_name'];
	$class = $result['class'];
	$class_name	= $result['class_name'];
	
	$sql_eatery_user_data = "SELECT * FROM medic_user_data WHERE user_id = '$user_id'";
	$result_eatery_user_data = check_error_db($mysqli, $sql_eatery_user_data);
	$result = mysqli_fetch_array($result_eatery_user_data);
	
	$count = $result['count'];
	$number_of_patients = $result['number_of_patients'];
	$patients_primary = $result['patients_primary'];

    $disabled = "";
	if( !inRoles("admin") ) {
		$disabled = "disabled";
	}
echo "
	<div class='content'>	
		<h1>Ведомость о количестве больных</h1>
		<div class='message_incorrect'>Внимание! <br> После отправки - данные заявки исправить нельзя! <br> <br></div>
		<form action='get.php' method='post'>
			<input name='hide' value='medic' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
					";
						if($disabled == "disabled")
							echo"<input hidden name='class' value='$class'>";
						echo"
						<select size='1' required name='class' $disabled>
							<option disabled>Выберите класс</option>";
							require_once("../blocks/select_class.php");
						echo"
						</select>";
						if($disabled == "disabled")
							echo"<input hidden name='class_name' value='$class_name'>";
						echo"
						<select size='1' required name='class_name' $disabled>
							<option disabled>Выберите класс</option>";
							require_once("../blocks/select_class_name.php");
						echo"
						</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'>
						<hr>
					</td>
				</tr>
				
				<tr>
					<td>
						Количество отсутствующих:
					</td>
					<td>
						<input name='count' required type='number' min='0' max='100' value='".$count."'>
					</td>
				</tr>
				<tr>
					<td>
						Отсутствующие по болезни <br>(простуда, ОРВИ, ГРИПП и т.д.):
					</td>
					<td>
						<input name='number_of_patients' required type='number' min='0' max='100' value='".$number_of_patients."'>
					</td>
				</tr>
				<tr>
					<td>
						Первичных по болезни <br>(простуда, ОРВИ, ГРИПП и т.д.):
					</td>
					<td>
						<input name='patients_primary' required type='number' min='0' max='100' value='".$patients_primary."'>
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
					";
						if($disabled == "disabled") {
							echo"
								<input hidden name='user_name' value='".$user_name."'>
							";
						}
						echo"
						<select name='user_name' size='1' required id='select_user' ".$disabled.">
							<option disabled>Выберите пользователя</option>";
							require_once("../blocks/users_list.php");
							echo"
						</select>
					</td>
				</tr>
								
				<tr>
                    <td colspan='2'>";
                    $disabled_submit = "";
					if( (($class == "0") || ($class_name == "0")) && (!inRoles("admin")) ) {$disabled_submit="disabled";}
					echo"
						<br><input type='submit' value='Отправить' class='button_set' ".$disabled_submit.">
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
