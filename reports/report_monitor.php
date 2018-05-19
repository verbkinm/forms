<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/print_monitor.css">
  
  <title>Печать</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	
	$date = $_GET['date'];
			
	if($_GET['monitor'] == "eatery") {
	 	echo "
	 		<div class='content'>	
				<table class='table_monitor'>
			 		<caption>Заявки в столовую - данные на " .$date. " - ".date("H:i:s")."</caption>  
						<thead>
							<tr>		
							   <td> № </td>
								<td>Класс</td>
								<td>Кол-во <br> детей</td>
								<td>Кол-во <br>льготников</td>
								<td id='td_names_lg' >Ф.И.О. <br>льготников</td>
								<td>Классный <br>руководитель</td>
								<td>Время <br>добавления</td>
							</tr>
						</thead>";
			
		// Выполняем запрос SQL
		$row_count=0;
		for ($i = 1; $i <= 11; $i++) {
			$sql = "SELECT * FROM eatery WHERE date = '$date' AND class = '$i' ORDER BY class_name";	
			$result = check_error_db($mysqli, $sql);
			while ($request = $result->fetch_assoc()) {
				echo"
				<tr>
					<td>". ++$row_count ."</td>
					<td>". $request['class'], $request['class_name'] . "</td>
					<td>". $request['count']. "</td>
					<td>". $request['count_lg']. "</td>
					<td>". $request['names_lg']. "</td>
					<td>". $request['user_name']. "</td>
					<td>". $request['time']. "</td>
				</tr>";
			}
		}
		if($row_count==0) {
			echo "
					<tr>
						<td colspan='7'><H1>Данные на это число отсутствуют!</H1></td>
					</tr>";
		}
	}
	
	if($_GET['monitor'] == "medic") {
		echo "
		 	<div class='content'>	
				 <table class='table_monitor'>
				 <caption>Информация о количестве отсутствующих - данные на " .$date. " - ".date("H:i:s")."</caption>  
						<thead>
							<tr>		
							   <td> № </td>
								<td>Класс</td>
								<td>Кол-во <br>отсутствующих:</td>
								<td>Отсутствующие <br>по болезни</td>
								<td>Отсутствующие <br>по болезни - первично</td>
								<td>Классный <br>руководитель</td>
								<td>Время <br>добавления</td>
							</tr>
						</thead>";
				
			// Выполняем запрос SQL
			$row_count						= 0;
			$total_count					= 0;
			$total_number_of_patients 	= 0;
			$total_patients_primary 	= 0;
			
			for ($i = 1; $i <= 11; $i++) {
				$sql = "SELECT * FROM medic WHERE date = '$date' AND class = '$i' ORDER BY class_name";	
				$result = check_error_db($mysqli, $sql);
				while ($request = $result->fetch_assoc()) {
					echo"
					<tr>
						<td>". ++$row_count ."</td>
						<td>". $request['class'], $request['class_name'] . "</td>
						<td>". $request['count']. "</td>
						<td>". $request['number_of_patients']. "</td>
						<td>". $request['patients_primary']. "</td>
						<td>". $request['user_name']. "</td>
						<td>". $request['time']. "</td>
					</tr>";
					$total_count					+= $request['count'];
					$total_number_of_patients 	+= $request['number_of_patients'];
					$total_patients_primary 	+= $request['patients_primary'];
				}
		
			}
			echo"
				<thead>
					<tr>
						<td colspan='2'>
							Итого:
						</td>
						<td>
							".$total_count."
						</td>			
						<td>
							".$total_number_of_patients."
						</td>		
						<td>
							".$total_patients_primary."
						</td>		
						<td colspan='2'>
		
						</td>		
					</tr>
				</thead>
			";
			if($row_count==0) {
				echo "
						<tr>
							<td colspan='7'><H1>Данные на это число отсутствуют!</H1></td>
						</tr>";
			}
	}
	
	$result->free();
	$mysqli->close();
?>
	</table>
	</div>
 </body>
</html>
