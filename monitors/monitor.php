<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/print_and_date.css">
  <meta http-equiv="Refresh" content="15" />
  
  <title>Монитор - столовая</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include("../blocks/header.php");
	include("../blocks/menu.php");
	
	check_permission(array('admin', 'user', 'monitor')); 
	
	include("lib_monitors.php");
	
 	if(empty($_GET['date'])) {$date = date("Y-m-d");}
 	else {$date=$_GET['date'];}
 	
 	echo "
 	<div class='content'>	
 	
 		<div class='print_and_date'>
	  		<div id='monitor_print'>
		  		<a href='../reports/report_monitor.php?monitor=eatery&date=".$date."' class='' target='_blank'>Печать</a>
		  	</div>";
	insert_date_form();
	echo"

	</div>
		 
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
						<td>Время <br>добавления</td>";
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
					<td colspan='".strval(7+$col)."'><H1>Данные на это число отсутствуют!</H1></td>
				</tr>";
	}
$result->free();
$mysqli->close();
?>
	</table>
	</div>
 </body>
</html>
