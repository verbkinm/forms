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

	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
	check_permission(array('admin', 'editor')); 

	$id = -1;
	if(isset($_POST['id']))
		$id = $_POST['id'];
	else
		header("Location: http://".$_SERVER['SERVER_NAME']."/permission_error.php"); 
	
	
	$sql = "SELECT * FROM eatery WHERE id = $id ";	
	$result = check_error_db($mysqli, $sql);
	$request = mysqli_fetch_array($result);	
	
echo"	
	<div class='content'>
		<h3>Изменение данных заявки №".$request['id']."</h3>
		<form action='get.php' method='post'>
		<input name='hide' value='eatery_edit' hidden>
		<input name='id' value='".$request['id']."' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>";
					echo"
					<select size='1' required name='class' disabled>
						<option selected>".$request['class']."</option>";
						echo"
					</select>
					<select size='1' required name='class_name' disabled>
						<option selected>".$request['class_name']."</option>";
					echo"
					</select>
					</td>
				</tr>
				<tr>
					<td>
						Количество детей:
					</td>
					<td>
						<input name='count' required type='number' min='0' max='100' value='".$request['count']."'> 
					</td>
				</tr>
				<tr>
					<td>
						Из них - льготников:
					</td>
					<td>
						<input name='count_lg' required type='number' min='0' max='100' value='".$request['count_lg']."'>
					</td>
				</tr>
				<tr>
					<td>
						Ф.И. льготников:
					</td>
					<td>
						<textarea name='names_lg'>".$request['names_lg']."</textarea>
					</td>
				</tr>
				<tr>
					<td>
						Классный руководитель:
					</td>
					<td>
						";
						echo"
						<select name='user_name' size='1' required id='select_user' disabled>
							<option selected>".$request['user_name']."</option>";
							echo"
						</select>
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

	require_once("../blocks/footer.php");
?>
 </body>
</html>
