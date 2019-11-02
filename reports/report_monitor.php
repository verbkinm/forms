<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/print_monitor.css">
  
  <title>Печать</title>
 </head>
 <body class="monitor">
	<table>
 <?php
 	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	
	if(isset($_GET['date']))
		$date = $_GET['date'];
			
	if($_GET['monitor'] == 'eatery') 
	{
	 	require_once("../monitors/tables/eatery_table.php");
		create_table($FOR_PRINT);
	}
	elseif($_GET['monitor'] == 'medic') 
	{
		require_once("../monitors/tables/medic_table.php");
		create_table($FOR_PRINT);
	}
	elseif($_GET['monitor'] == 'passes')
	{
		require_once("../monitors/tables/passes_table.php");
		create_table($FOR_PRINT);
	}
	elseif($_GET['monitor'] == 'passes_period')
	{
		$date_begin	= $_GET['date_begin'];
		$date_end = $_GET['date_end'];
		$class = $_GET['class'];
		$class_name = $_GET['class_name'];	
		require_once("../monitors/tables/passes_table.php");
		create_table_period();
	}
?>
		
	</table>
 </body>
</html>
