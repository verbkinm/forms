<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/print_and_date.css">
  <link rel="stylesheet" href="../css/sort_table.css">
  <script type='text/javascript' src='../js/sort_table.js'></script>
  <meta http-equiv="Refresh" content="15" />
  
  <title>Монитор - пропуски</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include("../blocks/header.php");
	include("../blocks/menu.php");
	
	check_permission(array('admin', 'soc_pedagog', 'monitor')); 
	
	include("lib_monitors.php");
	
 	if(empty($_GET['date'])) {$date = date("Y-m-d");}
    else {$date=$_GET['date'];}

    $date = date('Y-m-d');
	$current_time = strtotime($date);
	$first_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 1)*86400);
	
	
 	echo "
 	<div class='content'>	
 	
 		<div class='print_and_date'>
	  		<div id='monitor_print'>
		  		<a href='../reports/report_monitor.php?monitor=missing&date=".$date."' class='' target='_blank'>Печать</a>
		  	</div>";
	insert_date_form();
	echo"

	</div>
		 
		 <table class='table_monitor'>
		 <caption>Данные об отсутствующих на период с ".$first_day_in_week." по ".date("d-m-Y")."</caption>  
				<thead>
					<tr>		
					   <td style='width:4%;'> № </td>
						<td style='width:6%'>Класс</td>
						<td style='width:6%'>Кол-во <br> детей</td>
						<td style='width:9%'>Кол-во <br>льготников</td>
						<td id='td_names_lg' >Ф.И.О. <br>льготников</td>
						<td style='width:10%'>Классный <br>руководитель</td>
						<td style='width:9%'>Время <br>добавления</td>";
						if( inRoles("admin") || inRoles("editor")  )
						{
							echo"
							<td>Редактировать</td>";
						}
					echo "
					</tr>
				</thead>";
		
	// Выполняем запрос SQL
	$row_count=0;
	$total_count					= 0;
	$total_count_lg				= 0;
	
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
				<td>". $request['time']. "</td>";
				if( inRoles("admin") || inRoles("editor") )
				{
					echo"
					<td>
						<form action='../forms/eatery_edit.php' method='post'>
							<input name='id' 			value='".$request['id']."' hidden>
							<input type='submit' value='' class='form_edit_button'>
						</form>
					</td>";
				}
			echo"</tr>";
			$total_count					+= $request['count'];
			$total_count_lg 				+= $request['count_lg'];
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
					".$total_count_lg."
				</td>";
				if( inRoles("admin") || inRoles("editor") )
					$col=1;
				else
					$col=0;;
				
				echo "<td colspan='".strval(3+$col)."'>
				
				</td>		
			</tr>
		</thead>
	";
	if($row_count==0) {
		echo "
				<tr>
					<td colspan='".strval(7+$col)."'><H1>Данные на этот период отсутствуют!</H1></td>
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
