<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/print_monitor.css">
  
  <title>Печать</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	
	$date = $_GET['date'];
			
	if($_GET['monitor'] == 'eatery') 
	{
	 	require_once("../monitors/eatery_table.php");
		create_table($FOR_PRINT);
	}
	elseif($_GET['monitor'] == 'medic') 
	{
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
		$row_count = 0;
		$total_count = 0;
		$total_number_of_patients = 0;
		$total_patients_primary = 0;
		
		for ($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++)
		{
			$sql = "SELECT * FROM medic WHERE date = '$date' AND class = '$i' ORDER BY class_name";	
			$result = check_error_db($mysqli, $sql);
			while ($request = $result->fetch_assoc()) 
			{
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
				$total_count += $request['count'];
				$total_number_of_patients += $request['number_of_patients'];
				$total_patients_primary += $request['patients_primary'];
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
				<td colspan='2'></td>		
			</tr>
		</thead>
		";
		if($row_count == 0) 
		{
			echo "
			<tr>
				<td colspan='7'><H1>Данные на это число отсутствуют!</H1></td>
			</tr>";
		}
	}
	elseif($_GET['monitor'] == 'passes')
	{
		require_once("../monitors/passes_table.php");
		create_table($FOR_PRINT);
	}
?>
		</table>
	</div>
 </body>
</html>
