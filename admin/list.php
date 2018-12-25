<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
	   <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
	   <title>Список пользователей</title>
	</head>
	<body class="body_list">
		<?php
			session_start();
			
			include("../lib/connect.php");
			include("../lib/lib_auth.php");
			include ("../blocks/header.php");
			include ("../blocks/menu.php");
			
			check_permission(array('admin')); 
		?>	
		<div class="content">
			<table class="table_user_list">
		 		<caption>Список пользователей</caption>  
				<thead>
					<tr>		
					   <td> № </td>
						<td>Логин</td>
						<td>Роль</td>
						<td>Класс</td>
						<td>Ф.И.О.</td>
						<td>Дата и время регистрации</td>
						<td>Последний вход</td>
						<td>IP</td>
						<td>Операции</td>
					</tr>
				</thead>
		<?php
		
		$sql = "SELECT * FROM auth ORDER BY login ASC";	
		$result = check_error_db($mysqli, $sql);
		
		$row_count=0;
		while ($request = $result->fetch_assoc()) {
			echo"
			<tr>
				<td>". ++$row_count ."</td>
				<td>".$request['login']."</td>
				<td>";
					$login = $request['login'];
					$user_id = $mysqli->query("SELECT * FROM auth WHERE login = '$login'")->fetch_object()->id;
					$sql2 = "SELECT * FROM roles WHERE user_id = '$user_id' ";	
					$result2 = check_error_db($mysqli, $sql2);
					while ($request2 = $result2->fetch_assoc()) 
						echo $request2['role']."<br>";				
				echo"
				</td>";
				if( ($request['class'] == 0) && ($request['class_name'] == 0) ) {
					echo"
						<td>Нет</td>
					";
				}
				else {
					echo"
						<td>".$request['class'], $request['class_name']."</td>
					";
				}
				echo"

				<td>". $request['user_name']. "</td>
				<td>". $request['date']." - ".$request['time']. "</td>
				<td>". $request['last_login']. "</td>
				<td><a href = 'https://gateway-bsd.litsey-yugorsk.ru:10000' target='_blank'>". $request['login_ip']."</a></td> 
				<td>
					<form action='edit_user_form.php' method='post'>
						<input name='hide' value='delete_user' hidden>
						<input name='class' 			value='".$request['class']."' hidden>
						<input name='class_name' 	value='".$request['class_name']."' hidden>
						<input name='login' 			value='".$request['login']."' hidden>
						<input name='user_name' 	value='".$request['user_name']."' hidden>
						<input name='role' 			value='".$request['role']."' hidden>
						<input type='submit' value='' class='form_edit_button'>
					</form>
					<form action='delete_user_get.php' method='post'>
						<input name='hide' value='delete_user' hidden>
						<input name='login' value='".$request['login']."' hidden>
						<input type='submit' value='' class='form_delete_button'>
					</form>
				</td>
			</tr>";
		}
		?>		
			</table>
		</div>	
	 </body>
</html>
