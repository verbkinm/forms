<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
	   <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/sort_table.css">
		<script type='text/javascript' src='../js/sort_table.js'></script>
	   <title>История Мак-адресов:</title>
	</head>
	<body class="body_index">
		<?php
			session_start();
			
			include("../lib/connect_hosts.php");
	
			include("../lib/lib_auth.php");
			include ("../blocks/header.php");
			include ("../blocks/menu.php");
			
			check_permission(array('admin')); 
			
			$mac = $_GET['mac'];
		?>	
		<div class="content">	
			<table class="table_monitor">
		 		<caption>История  Мак-адреса:
		 		<?php
					echo $mac;
		 		?>
		 		</caption>  
				<thead>
					<tr>		
					   <td> № </td>
						<td>дата добавления</td>
						<td>ip адрес</td>
					</tr>
				</thead>
<?php			
				$query = "SELECT id FROM hosts WHERE mac='".$mac."';";	
				$result = check_error_db($mysqli, $query);
				$mac_id = $result->fetch_assoc()['id'];
				
				
				$query = "SELECT * FROM history WHERE mac_id='".$mac_id."';";	
				$result = check_error_db($mysqli, $query);
				
				$row_number=0;
				
				while ($request = $result->fetch_assoc()) {
					echo"
						<tr>
							<td>".++$row_number."</td>
							<td>".$request['created']."</td>
							<td>".$request['addr']."</td>";
				}
				echo"
				<thead>
					<tr>
						<td style='width: 10px;'>
							Итого:
						</td>
						<td colspan='2'>
							".$row_number."
						</td>			
		
					</tr>
				</thead>";

?>		
		</div>	
	 </body>
</html>
