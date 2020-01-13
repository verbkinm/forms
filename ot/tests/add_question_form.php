<!DOCTYPE HTML>

<html lang="ru">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
  <title>Создание теста</title>
 </head>
 <body class="body_registration">

<?php
	session_start();

	require_once("../../config/config.php");
	require_once("../../lib/connect.php");
	require_once("../../lib/lib_auth.php");
	require_once ("../../blocks/header.php");
	require_once ("../../blocks/ot/menu.php");
	
    check_permission(array('admin', 'ot_admin')); 

	if(isset($POST['test_id']))
		$test_id = $POST['test_id'];
	else
		$test_id = -1
	;
	$sql = "SELECT * FROM ot_tests WHERE id = $test_id";
	$result = check_error_db($mysqli, $sql);
	$request = $result->fetch_assoc();
		
echo"	
	<div class='content'>
		<h3>Создание нового теста</h3>
		<form action='get.php' method='post'>
			<input name='hide' value='add_question' hidden>
			<table class='table_set_data' style='width: 90%'>
				<tr>
					<td>Название раздела:</td>
					<td>
						<input name='section' required type='text' value=".$request['section'].">
					</td>
				</tr>
				<tr>
					<td>Название теста:</td>
					<td>
						<input name='title' required type='text' value=".$request['title'].">
					</td>
				</tr>
				
				<tr>
					<td colspan='2'><br><hr></td>
				</tr>";
				
				one_question();
				
				echo"
				<tr>
					<td colspan='2' style='text-align:left;'>
						<br><input type='button' value='Добавить вопрос' class='button_set' add_question(this)>
					</td>
				</tr>
				
				<tr>
					<td colspan='2' style='text-align:center;'>
						<br><input type='submit' value='Создать' class='button_set' >
					</td>
				</tr>
			</table>
		</form>
	</div>
";
	function one_question()
	{
		global $test_id;
		global $mysqli;
		$counter = 0;
		
		$sql = "SELECT * FROM ot_questions WHERE tests_id = $test_id";
		$result = check_error_db($mysqli, $sql);
		
		echo" 
		<div>";
			if($result->num_rows > 0)
			{	
				while ($request = $result->fetch_assoc()) 
				{
					echo"
					<tr>
						<td colspan='2' class='question_number'><h3>Вопрос №</h3></td>
					</tr>
					<tr>
						<td colspan='2'>
							<input name='question$counter' required type='text' value=".$request['question'].">
						</td>
					</tr>";
				}
			}
			else
			{
				echo"
				<tr>
					<td colspan='2' class='question_number'><h3>Вопрос №</h3></td>
				</tr>
				<tr>
					<td colspan='2'><input name='question$counter' required type='text'></td>
				</tr>";	
			}
			
			echo"

			<tr>
				<td colspan='2'><h3>Варианты ответа</h3></td>
			</tr>
			<tr>
				<td colspan='2'>
					<table class='table_answer'>
						<thead>
							<td style='width:20px;'>№</td>
							<td style='width:100%;'>Вопрос</td>
							<td style='width:40px;'>Верный <br>ответ</td>
							<td style='width:35px;'></td>
						</thead>";
						
						$sql = "SELECT * FROM ot_answer_choice WHERE tests_id = $test_id";
						$result = check_error_db($mysqli, $sql);
						$counter = 0;
						while ($request = $result->fetch_assoc()) 
						{
							$checked;
							if($request['is_correct_answer'] == true)
								$checked = 'checked';	
							echo"
							<tr class='rows_with_data_fields'>
								<td></td>
								<td><input name='answer$counter' value='".$request['answer']."' required></td>
								<td><input type='checkbox' name='is_correct$counter' $checked></td>
								<td class='remove_unit'><input type='button' onclick='remove(this)'></td>
							</tr>";
							$counter++;
						}
					echo"	
						<tr>
							<td colspan='4' class='add_unit' style='text-align: left;'>
								<input id='add_button' type='button' onclick='add(this);'>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</div>";
	}
	
	
	$mysqli->close();
	require_once("../../blocks/footer.php");
?>
 </body>
 	<script type="text/javascript" src="../../js/ot/answers.js">	
		table_row_numbers();
	</script>
	 <script type="text/javascript" src="../../js/ot/questions.js">	
		questions_numbers();
	</script>
</html>
