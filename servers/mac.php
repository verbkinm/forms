<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
	   <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/sort_table.css">
		<script type='text/javascript' src='../js/sort_table.js'></script>
	   <title>Список Мак-адресов:</title>
	</head>
	<body class="body_index">
<?php
			session_start();
			
			include("../lib/connect_hosts.php");
	
			include("../lib/lib_auth.php");
			include ("../blocks/header.php");
			include ("../blocks/menu.php");
			
			check_permission(array('admin')); 
?>	
		<div class="content">	
			<table class="table_monitor">
		 		<caption>Список Мак-адресов:</caption>  
				<thead>
					<tr>		
					   <td> № </td>
						<td>mac:</td>
						<td>последние ip адрес</td>
						<td>дата создания</td>
					</tr>
				</thead>
<?php			
				$query = "SELECT * FROM hosts ORDER BY mac ASC";	
				$result = check_error_db($mysqli, $query);
				$row_number=0;
				$ip_number = 0;

				while ($request = $result->fetch_assoc()) {
					echo"
						<tr>
							<td>".++$row_number."</td>
							<td>";
							
								$history = historyMacCount($request['id']);
								if($history != NULL)
									echo "<a href='mac_history.php?mac=".$request['mac']."'>".$request['mac'], $history."</a>";
								else
									echo $request['mac'];
									
								echo 	
								"</td>
							<td>";
							$sub_query = "SELECT * FROM history AS h1 WHERE mac_id=".$request['id']." AND created = (SELECT MAX(created) FROM history WHERE mac_id=".$request['id'].") ORDER BY h1.created;";
							$sub_result = check_error_db($mysqli, $sub_query);
							while ($sub_request = $sub_result->fetch_assoc()) {
								$history = historyIpCount($sub_request['addr']);
								if($history != NULL)
									echo "<a href='ip_history.php?ip=".$sub_request['addr']."'>".$sub_request['addr'], $history."</a><br>";
								else
									echo $sub_request['addr']."<br>";
									
								++$ip_number;
							}
						echo"
							</td>
							<td>".$request['created']."</td>
						</tr>
					";
				}
				echo"
				<thead>
					<tr>
						<td style='width: 10px;'>
							Итого:
						</td>
						<td>
							".$row_number."
						</td>			
						<td>
							".$ip_number."
						</td>		
						<td>
						</td>
					</tr>
				</thead>";

function historyMacCount($mac_id)
{
	global $mysqli;
	$count = 0;
	$query = "SELECT * FROM history WHERE mac_id=".$mac_id.";";
	$result = check_error_db($mysqli, $query);
	$num_rows = mysqli_num_rows($result);
	
	if($num_rows > 1)
		return " - история($num_rows)";
	else
		return NULL;
}
function historyIpCount($ip)
{
	global $mysqli;
	$count = 0;
	$query = "SELECT * FROM history WHERE addr='".$ip."';";
	$result = check_error_db($mysqli, $query);
	$num_rows = mysqli_num_rows($result);
	
	if($num_rows > 1)
		return " - история($num_rows)";
	else
		return NULL;
}
?>		
		</div>	
<?php
	include("../blocks/footer.php");
?>
	 </body>
</html>
