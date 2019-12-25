<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/print_and_date.css">
  <link rel="stylesheet" href="../css/sort_table.css">

  <meta http-equiv="Refresh" content="15" />
  
  <title>Монитор - пропуски</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	require_once("../config/config.php");
	require_once("../lib/connect.php");
	require_once("../lib/lib_auth.php");
	require_once("../blocks/header.php");
	require_once("../blocks/menu.php");
	
	check_permission(['admin', 'user', 'monitor', 'monitor_passes']); 
	
	require_once("lib_monitors.php");
	
 	if(empty($_GET['date'])) {$date = date("Y-m-d");}
    else {$date=$_GET['date'];}
	
 	echo "
 	<div class='content'>	
 		<div class='print_and_date'>
	  		<div id='monitor_print'>
		  		<a href='../reports/report_monitor.php?monitor=passes&date=$date' class='' target='_blank'>Печать</a>
		  	</div>";
		insert_date_form();
		echo"
		</div>";
	require_once("tables/passes_table.php");	
	create_table($NOT_FOR_PRINT);
	
	echo"
	</div>";
	
	require_once("../blocks/footer.php");
?>
 </body>
</html>
