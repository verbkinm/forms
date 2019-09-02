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
			
			$ip = $_GET['ip'];
		?>	
		<div class="content">	
			<table class="table_monitor">
		 		<caption>История  IP-адреса:
		 		<?php
					echo $ip;
		 		?>
		 		</caption>  
				<thead>
					<tr>		
					   <td> № </td>
						<td>дата добавления</td>
						<td>mac адрес</td>
					</tr>
				</thead>
<?php			
				$query = "SELECT mac_id FROM history WHERE addr='$ip';";	
				$result = check_error_db($mysqli, $query);
				
				$row_number=0;
				
				while ($request = $result->fetch_assoc()) {
					$sub_query = "SELECT * FROM hosts WHERE id=".$request['mac_id'].";";	
					$sub_result = check_error_db($mysqli, $sub_query);
					$sub_request = $sub_result->fetch_assoc();
					echo"
						<tr>
							<td>".++$row_number."</td>
							<td>".$sub_request['created']."</td>
							<td>
								<a href='mac_history.php?mac=".$sub_request['mac']."'>".$sub_request['mac']."</a>
							</td>";
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
