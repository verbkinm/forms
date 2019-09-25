<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/print_and_date.css">
  <meta http-equiv="Refresh" content="15" />
  <title>Монитор - медик</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include ("../blocks/header.php");
	include ("../blocks/menu.php");
	
	check_permission(array('admin', 'user', 'monitor'));
	
	include("lib_monitors.php");
	
 	if(empty($_GET['date'])) {$date = date("Y-m-d");}
 	else {$date=$_GET['date'];}
 	
 	echo "
 	<div class='content'>	

 		<div class='print_and_date'>
	  		<div id='monitor_print'>
		  		<a href='../reports/report_monitor.php?monitor=medic&date=".$date."' class='' target='_blank'>Печать</a>
		  	</div>";
	insert_date_form();
	echo"
		 <table class='table_monitor'>
		 <caption>Информация о количестве отсутствующих - данные на " .$date. " - ".date("H:i:s")."</caption>  
				<thead>
					<tr>		
					   <td> № </td>
						<td>Класс</td>
						<td>Кол-во <br>отсутствующих:</td>
						<td>Отсутствующие <br>по болезни <br>(простуда, ОРВИ, ГРИПП и т.д.)</td>
						<td>Отсутствующие <br>по болезни - первично <br>(простуда, ОРВИ, ГРИПП и т.д.)</td>
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
$result->free();
$mysqli->close();
?>
	</table>
	</div>
<?php
	include("../blocks/footer.php");
?>
 </body>
</html>
