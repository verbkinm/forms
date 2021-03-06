<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/print_and_date.css">
  <meta http-equiv="Refresh" content="15" />
  
  <title>Монитор - обращения</title>
 </head>
 <body class="monitor">
 <?php
 	session_start();

	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	include("../blocks/header.php");
	include("../blocks/menu.php");
	include("../appeals/blocks/status.php");
	
	check_permission(array('admin', 'appeals', 'monitor', 'monitor_appeals'));
	
// не подключаю из файла lib/connect.php т.к. идёт дублирование переменных и фунций
	unset($mysqli);
	$mysqli = new mysqli('localhost', 'appeals', 'M4UC0wxkmEgpXZ5R', 'appeals'); 
	/* изменение набора символов на utf8 */
	if (!mysqli_set_charset($mysqli, "utf8")) {
		printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($mysqli));
	}
	if (mysqli_connect_errno()) { 
		echo "Ошибка подключения к серверу MySQL. Код ошибки:".mysqli_connect_error(); 
		exit; 
	} 
 	
 	echo "
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
		 <table class='table_monitor'>
		 <caption>Список обращений</caption>  
				<thead>
					<tr>		
					    <td> № </td>
					    <td> Тип <br>обращения </td>
						<td>Ф.И.О.</td>
						<td>email</td>
						<td>Статус</td>
						<td> Просмотр</td>
						<td>Время и дата<br>добавления</td>
					</tr>
				</thead>";
		
	// Выполняем запрос SQL
	$row_count=0;
	
	$sql = "SELECT * FROM appeals ORDER BY id";	
	$result = check_error_db($mysqli, $sql);
	while ($request = $result->fetch_assoc()) {
		echo"
		<tr>
			<td>".$request['id']."</td>
			<td>".$request['form_of_appeal']."</td>
			<td>".$request['surname']." ".$request['name']." ".$request['patronymic']."</td>
			<td>".$request['email']."</td>
			<td>".setStatusColor($request['status'])."</td>
			<td> <a href='http://".$_SERVER['SERVER_NAME']."/appeals/edit.php?id=".$request['id']."'>открыть</a></td>
			<td>".$request['time']." \ ".$request['date']."</td>";
		"</tr>";
		$row_count++;
	}
	echo"
		<thead>
			<tr>
				<td>
					Итого: ".$row_count."
				</td>	
				<td colspan='6'>
				</td>	
			</tr>
		</thead>
	";
	if($row_count==0) {
		echo "
				<tr>
					<td colspan='7'><H1>Данные отсутствуют!</H1></td>
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
