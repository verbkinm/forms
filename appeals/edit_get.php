<?php
	session_start();
			
	include("../lib/connect.php");
	include("../lib/lib_auth.php");
	
	check_permission(array('admin', 'appeals')); 
	
	$login	= $_SESSION['login'];
	$author = $_SESSION['user_name'];
	
// не подключаю из файла lib/connect.php т.к. идёт дублирование переменных и фунций
	unset($mysqli);
	$mysqli = new mysqli('localhost', 'appeals', 'M4UC0wxkmEgpXZ5R', 'appeals'); 
	/* изменение набора символов на utf8 */
	if (!mysqli_set_charset($mysqli, "utf8")) {
		printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($mysqli));
	}
	if (mysqli_connect_errno()) { 
		echo "Ошибка подключения к серверу MySQL. Код ошибки:".mysqli_connect_error(); 
	}
	
	$id		= $_POST['id'];
	$date 	= date("Y/m/d");
	$time 	= date("H:i:s");
	$status = $_POST['status'];
	$answer = $_POST['answer'];
	
	$email = $mysqli->query("SELECT email FROM appeals WHERE id = '$id' ")->fetch_object()->email;
	$surname = $mysqli->query("SELECT surname FROM appeals WHERE id = '$id' ")->fetch_object()->surname;
	$name = $mysqli->query("SELECT name FROM appeals WHERE id = '$id' ")->fetch_object()->name;
	$patronymic = $mysqli->query("SELECT patronymic FROM appeals WHERE id = '$id' ")->fetch_object()->patronymic;
	$url = $mysqli->query("SELECT url FROM appeals WHERE id = '$id' ")->fetch_object()->url;
	
	
	$sql = "INSERT history (appeals_id, date, time, status, author, answer)
			VALUES		  ($id, '$date', '$time', '$status', '$author', '$answer')";
	correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");

	$sql = "UPDATE appeals SET status = '$status'
			WHERE id = $id";
	correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
	
//теперь отправляем письма соавторам
	include("phpmailer/phpmailer_setting.php");
	
	sendMail($email, $id, $surname, $name, $patronymic, $url, true);
	
	$sql = "SELECT * FROM collaborators WHERE appeals_id = $id ";
	echo "id".$id."<br>";
	$result = check_error_db($mysqli, $sql);
	while($request = $result->fetch_assoc()) 
	{
		$surname			=	$request['surname'];
		$name				=	$request['name'];
		$patronymic			=	$request['patronymic'];
		$emailCollaborator	=	$request['email'];
	
		sendMail($emailCollaborator, $id, $surname, $name, $patronymic, $url, false);
	}
		
	header("Location: edit.php?id=".$id);
?>	
