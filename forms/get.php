<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <META HTTP-EQUIV='Refresh' CONTENT='15; URL=../index.php'>
  <link rel="stylesheet" href="../css/style.css">
  <title>Отправка данных</title>
 </head>
 <body>
<?php
	session_start();

	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	require_once ("../blocks/menu.php");
	
	check_permission(array('admin', 'user', 'editor')); 
	
	echo"
	<div class='content'>";
	
	if($_POST['hide']=="medic") 
	{
		medic();
	}
    elseif($_POST['hide'] == "eatery") 
    {
		eatery();
	}
    elseif($_POST['hide'] == "eatery_edit") 
    {			
		eatery_edit();
	}
    elseif($_POST['hide'] == "missing") 
    {
		missing();
	}
	// elseif($_POST['hide'] == "missing_edit")
	// {
		// $passes_id = $_POST['passes_id'];
		// $sql = "DELETE FROM passes_application WHERE passes_id = $passes_id";	
		// correct_or_error($mysqli, $sql, "<div class='message_correct'>Данные удалены!</div>");
		
        // $i = 0;
        // while($i < 50) //50 - максимальное значение учеников
        // {	
			// if(isset($_POST["name_of_patients$i"]))
            // {
				// $name_of_patients = $_POST["name_of_patients$i"];
                // $absence_due_to_illness = $_POST["absence_due_to_illness$i"];
                // $absence_for_a_good_reason = $_POST["absence_for_a_good_reason$i"];
                // $absence_of_a_valid_reason =  $_POST["absence_of_a_valid_reason$i"];
    
	    	    // $sql = "INSERT INTO passes_application (passes_id, student_name, absence_due_to_illness, absence_for_a_good_reason, absence_of_a_valid_reason)
						// VALUES ($passes_id, '$name_of_patients', $absence_due_to_illness, $absence_for_a_good_reason, $absence_of_a_valid_reason)";
		        // correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
            // }
            // $i++;
        // }
	// }
	else 
		echo"<h3>Неккоректные данные!</h3>";
	
	
	function medic()
	{
		global $mysqli;
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$class = strip_tags($_POST['class']);
		$class_name = strip_tags($_POST['class_name']);
		if( ($class == "0") || ($class_name == "0") ) {$class=$class_name=0;}		
		$count = strip_tags($_POST['count']);
		$number_of_patients = strip_tags($_POST['number_of_patients']);
		$patients_primary = strip_tags($_POST['patients_primary']);
		$user_name = strip_tags($_POST['user_name']);
		$date = date("Y/m/d");
		$time = date("H:i:s");
			
		$sql = "SELECT * FROM medic WHERE date = '$date' AND class = $class AND  class_name = '$class_name' 	";	
		$result = check_error_db($mysqli, $sql);
        if ($result->num_rows == 0) 
        {
			$sql = "INSERT INTO medic (class, class_name, 	count, 	number_of_patients, 	patients_primary, 	user_name, 	date, 	time)
					VALUES ($class,'$class_name',$count, 	$number_of_patients, $patients_primary, 	'$user_name', '$date', '$time' )";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
		
			$sql = "UPDATE medic_user_data SET count = $count, number_of_patients = $number_of_patients, patients_primary='$patients_primary'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "");
		}
		else
			echo "<div class='message_incorrect'>Заявка на сегодняшний день уже была отправлена, повторная отправка данных - невозможна!</div>";
		$mysqli->close();	
		
	}
	
	function eatery()
	{
		global $mysqli;
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$class = strip_tags($_POST['class']);
		$class_name = strip_tags($_POST['class_name']);
		if( ($class == "0") || ($class_name == "0") ) {$class=$class_name=0;}		
		$count = strip_tags($_POST['count']);
		$count_lg = strip_tags($_POST['count_lg']);
		$user_name = strip_tags($_POST['user_name']);
		$names_lg = strip_tags($_POST['names_lg']);
		$date = date("Y/m/d");
		$time = date("H:i:s");
			
		$sql = "SELECT * FROM eatery WHERE date = '$date' AND class = $class AND  class_name = '$class_name' 	";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO eatery (class, class_name, count, count_lg, names_lg, user_name, date, time)
			VALUES ( $class, '$class_name', $count, $count_lg, '$names_lg', '$user_name' , '$date', '$time' )";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			
			$sql = "UPDATE eatery_user_data SET count = $count, count_lg = $count_lg, names_lg='$names_lg'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "");
		}
		else
		{
			echo "<div class='message_incorrect'>Заявка на сегодняшний день уже была отправлена, повторная отправка данных - невозможна!</div";
		}
		$mysqli->close(); 	
	}
	
	function eatery_edit()
	{
		global $mysqli;
		$id	= strip_tags($_POST['id']);	
		$count = strip_tags($_POST['count']);
		$count_lg = strip_tags($_POST['count_lg']);
		$names_lg = strip_tags($_POST['names_lg']);
			
		$sql = "SELECT * FROM eatery WHERE id = '$id' ";	
		$result = check_error_db($mysqli, $sql);
		$request = $result->fetch_assoc();

		$sql = "UPDATE eatery SET count = $count, count_lg = $count_lg, names_lg='$names_lg' WHERE id = '$id' ";
		correct_or_error($mysqli, $sql, "<div class='message_correct'>Запись успешно обновлена!</div>");
		$mysqli->close();	
	}
	
	function missing()
	{
		global $mysqli;
		
		$class = strip_tags($_POST['class']);
		$class_name = strip_tags($_POST['class_name']);
		$current_day = strip_tags($_POST['current_day']);
		if( ($class == "0") || ($class_name == "0") ) {$class=$class_name=0;}		
        $user_name = strip_tags($_POST['user_name']);
		$week_number = strip_tags($_POST['week_number']);
		if($week_number != date("W"))
		{
			echo "<div class='message_incorrect'>Изменение данных возможно только на некущую неделю!</div>";
			exit();
		}

        $sql = "SELECT * FROM passes WHERE week_number = $week_number 
				AND class = $class AND  class_name = '$class_name' 
				AND day_number = $current_day";	
		$result = check_error_db($mysqli, $sql);
        if ($result->num_rows > 0) 
        {
			$request = $result->fetch_assoc();
			$passes_id = $request['id'];
			$sql = "DELETE FROM passes_application WHERE passes_id = $passes_id";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Данные удалены!</div>");
		}
		else
		{
			$sql = "INSERT INTO passes (class, class_name, user_name, week_number, day_number)
					VALUES ( $class, '$class_name', '$user_name', $week_number, $current_day)";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			$passes_id = $mysqli->insert_id;
		}
		$i = 0;
		while($i < 50) //50 - максимальное значение учеников
		{	
			if(isset($_POST["name_of_patients$i"]))
			{
				$name_of_patients = $_POST["name_of_patients$i"];
				$absence_due_to_illness = $_POST["absence_due_to_illness$i"];
				$absence_for_a_good_reason = $_POST["absence_for_a_good_reason$i"];
				$absence_of_a_valid_reason =  $_POST["absence_of_a_valid_reason$i"];

				$sql = "INSERT INTO passes_application (passes_id, student_name, absence_due_to_illness, absence_for_a_good_reason, absence_of_a_valid_reason)
						VALUES ($passes_id, '$name_of_patients', $absence_due_to_illness, $absence_for_a_good_reason, $absence_of_a_valid_reason)";
				correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			}
			$i++;
		}	
	}
?>
	</div>
 </body>
</html>
