<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/print_and_date.css">
  
	<title>Печать</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once("../blocks/header.php");
	require_once("../blocks/menu.php");
	
	check_permission(['admin', 'sco-pedagog']); 
	
	$date_begin	= $_POST['date_begin'];
	$date_end = $_POST['date_end'];
	$class = $_POST['class'];
	$class_name = $_POST['class_name'];	
	
 	echo "
 	<div class='content'>
		<div id='monitor_print'>
			<a href='../reports/report_monitor.php?monitor=passes_period&date_begin=$date_begin&date_end=$date_end&class=$class&class_name=$class_name' target='_blank'>Печать</a>
		</div>";
	
	require_once("../monitors/tables/passes_table.php");	
	create_table_period();
	
	echo"
	</div>";
	
	require_once("../blocks/footer.php");
?>
		</table>
	</div>
 </body>
</html>
