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

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	echo"
		<div class='content'>
	";
	
	if($_POST['hide']=="medic") {
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$class 					= $_POST['class'];
		$class_name 			= $_POST['class_name'];
		$count 					= $_POST['count'];
		$number_of_patients 	= $_POST['number_of_patients'];
		$patients_primary 	= $_POST['patients_primary'];
		$user_name 				= $_POST['user_name'];
		$date 					= date("Y/m/d");
		$time 					= date("H:i:s");
			
		$sql = "SELECT * FROM medic WHERE date = '$date' AND class = $class AND  class_name = '$class_name' 	";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO medic (class, class_name, 	count, 	number_of_patients, 	patients_primary, 	user_name, 	date, 	time)
						VALUES 			  ($class,'$class_name',$count, 	$number_of_patients, $patients_primary, 	'$user_name', '$date', '$time' )";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
		
			$sql = "UPDATE medic_user_data SET count = $count, number_of_patients = $number_of_patients, patients_primary='$patients_primary'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "");
		}
		else{
			$sql = "UPDATE medic SET count = $count, number_of_patients = $number_of_patients, patients_primary=$patients_primary, user_name = '$user_name',  time = '$time'
					WHERE class = $class AND class_name = '$class_name' ";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Запись успешно обновлена!</div>");
			
			$sql = "UPDATE medic_user_data SET count = $count, number_of_patients = $number_of_patients, patients_primary='$patients_primary'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "");
		}
		$mysqli->close();	
	}
	elseif($_POST['hide'] == "eatery") {
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$class 		= $_POST['class'];
		$class_name = $_POST['class_name'];
		$count 		= $_POST['count'];
		$count_lg 	= $_POST['count_lg'];
		$user_name 	= $_POST['user_name'];
		$names_lg 	= $_POST['names_lg'];
		$date 		= date("Y/m/d");
		$time 		= date("H:i:s");
			
		$sql = "SELECT * FROM eatery WHERE date = '$date' AND class = $class AND  class_name = '$class_name' 	";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO eatery (class, class_name, count, count_lg, names_lg, user_name, date, time)
			VALUES ( $class, '$class_name', $count, $count_lg, '$names_lg', '$user_name' , '$date', '$time' )";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
			
			$sql = "UPDATE eatery_user_data SET count = $count, count_lg = $count_lg, names_lg='$names_lg'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "!!!");
		}
		else{
			$sql = "UPDATE eatery SET count = $count, count_lg = $count_lg, names_lg='$names_lg', user_name = '$user_name',  time = '$time'
					WHERE class = $class AND class_name = '$class_name' ";	
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Запись успешно обновлена!</div>");
			
			$sql = "UPDATE eatery_user_data SET count = $count, count_lg = $count_lg, names_lg='$names_lg'
					WHERE user_id = $user_id";	
			correct_or_error($mysqli, $sql, "");
		}
		$mysqli->close(); 		
	}
	elseif($_POST['hide'] == "missing") {
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		
		$class 					= $_POST['class'];
		$class_name 			= $_POST['class_name'];
		$count 					= $_POST['count'];
		$number_of_patients 	= $_POST['number_of_patients'];
		$not_a_good_reason	= $_POST['not_a_good_reason'];
		$accepted_measure		= $_POST['accepted_measure'];
		$teacher 				= $_POST['teacher'];
		$date 					= date("Y/m/d");
		$time 					= date("H:i:s");
			
		$sql = "SELECT * FROM missing WHERE date = '$date' AND class = $class AND  class_name = '$class_name' 	";	
		$result = check_error_db($mysqli, $sql);
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO missing (class, 	class_name, 	count, number_of_patients, 	not_a_good_reason, 		accepted_measure, 	user_name, date, time)
			VALUES 							 ( $class, '$class_name', $count, '$number_of_patients', '$not_a_good_reason', 	'$accepted_measure' , '$user_name', '$date', '$time' )";
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div");
		}
		else{/*
			$sql = "UPDATE eatery SET count = $count, number_of_patients = '$number_of_patients', not_a_good_reason='$not_a_good_reason', accepted_measure = '$accepted_measure', user_name = '$user_name',  time = '$time'
					WHERE class = $class AND class_name = '$class_name' ";	
			correct_or_error($mysqli, $sql, "<div class='message_correct'>Запись успешно обновлена!</div>");*/
		}
		$mysqli->close(); 	
	}
	else {
		echo"
			<h3>Неккоректные данные!</h3>
		";
	}
	echo"
		</div>
	";

	
?>
 </body>
</html>
