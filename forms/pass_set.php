<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <title>Пропуски форма</title>
 </head>
 <body class="set">

<?php  
	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	check_permission(array('admin', 'user')); 
	
	$_SESSION['ticket'] = "missing";

echo "
	<div class='content'>	
		<h3>Отсутствующие</h3>
		<form action='get.php' method='post'>
			<input name='hide' value='missing' hidden>
			<table class='table_set_data'>
				<tr>
					<td>
						Класс
					</td>
					<td>
						<select size='1' required name='class' >
							<option disabled>Выберите класс</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
							<option value='7'>7</option>
							<option value='8'>8</option>
							<option value='9'>9</option>
							<option value='10'>10</option>
							<option value='11'>11</option>
						</select>
						<select size='1' required name='class_name' >
							<option disabled>Выберите класс</option>
							<option value='А'>А</option>
							<option value='Б'>Б</option>
							<option value='В'>В</option>
							<option value='Г'>Г</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Количество обучающихся:
					</td>
					<td>
						<input name='count' required type='number' min='0' max='100' value='0'>
					</td>
				</tr>
				<tr>
					<td>
						Отсутствуют по болезни<br>(Ф.И. об-ся, кол-во часов):
					</td>
					<td>
						<textarea name='number_of_patients'></textarea>
					</td>
				</tr>
				<tr>
					<td>
						По неуважительной причине<br>(Ф.И. об-ся, кол-во часов):
					</td>
					<td>
						<textarea name='not_a_good_reason'></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Принятые меры (если имеются обучающиеся по неуважительной причине):
					</td>
					<td>
						<textarea name='accepted_measure'></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Классный руководитель:
					</td>
				<td>
					<input name='user_name' required type='text'>
				</td>
				</tr>
				<tr>
					<td colspan='2' >
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
