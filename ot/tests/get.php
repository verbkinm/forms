<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='15000; URL=../index.php'>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
  <title>Отправка данных</title>
 </head>
 <body>
<?php
	session_start();  

	require_once("../../lib/connect.php");
	require_once("../../lib/lib_auth.php");
	require_once ("../../blocks/header.php");
	require_once ("../../blocks/ot/menu.php");
	
	check_permission(array('admin', 'ot_admin')); 
	
	echo"
	<div class='content'>";
	
	if($_POST['hide']=="add_question") 
		add_question();
	elseif($_POST['hide']=="update_question") 
		update_question();
	else 
		echo"<h3>Неккоректные данные!</h3>";
	
	
	function add_question()
	{
		global $mysqli;
        $section = strip_tags($_POST['section']);
		$title = strip_tags($_POST['title']);
		$question = strip_tags($_POST['question']);

        $sql = "SELECT * FROM ot_tests WHERE section = $section 
				AND title = '$title'";	
		$result = check_error_db($mysqli, $sql);
        if ($result->num_rows > 0) 
        {
			update_question();
			// $request = $result->fetch_assoc();
			// $passes_id = $request['id'];
			// $sql = "DELETE FROM passes_application WHERE passes_id = $passes_id";
			// correct_or_error($mysqli, $sql, "<div class='message_correct'>Данные удалены!</div>");
		}
		else
		{
			$sql = "INSERT INTO ot_tests (section, title, question)
					VALUES ('$section', '$title', '$question')";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			$tests_id = $mysqli->insert_id;
		}
		$i = 0;
		while($i < 50) //50 - максимальное значение ответов в одном тесте
		{	
			if(isset($_POST["answer$i"]))
			{
				$answer = $_POST["answer$i"];
				$is_correct = 0;
				if(isset($_POST["is_correct$i"]) && $_POST["is_correct$i"] == 'on')
					$is_correct = 1;

				$sql = "INSERT INTO ot_answer_choice (tests_id, answer, is_correct)
						VALUES ($tests_id, '$answer', '$is_correct')";
				correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			}
			$i++;
		}	
	}
	
	function update_question()
	{
		global $mysqli;
	
	}
	
	$mysqli->close();
	require_once("../../blocks/footer.php");
?>
	</div>
 </body>
</html>

