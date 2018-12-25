<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
<?php 	
	include("lib/connect.php");
	$searchId	=	$_POST['searchId'];
	
	if(empty($searchId) )
		header("Location: index.php");
		
	$sql = "SELECT * FROM appeals WHERE id = '$searchId'";
	$request = check_error_db($mysqli, $sql);
	$result = mysqli_fetch_array($request);
		

	if(empty($result['email']) )
	{
		echo "
				<div class='wrapper'>
					<p><h1 style='color:red; text-align: center;'>Неверный номер обращения!</h1></p>
					<p><b><h1 align='center'><a href='index.php'>Перейти к обращению</a></h1></b></p>
				</div>";
		exit();
	}			
//настройки для почтового агента				
	include("phpmailer/phpmailer_setting.php");
	sendMail($result['email'], $searchId, $result['surname'], $result['name'], $result['patronymic'], $result['url'], true);
	
	$sql2 = "SELECT * FROM collaborators WHERE appeals_id = '$searchId'";
	$request2 = check_error_db($mysqli, $sql2);

	while ($row = mysqli_fetch_array($request2) ) {
		sendMail($row['email'], $searchId, $row['surname'], $row['name'], $row['patronymic'], $result['url'], false);
   }
   
	header("Location: search.html");
?>	

	</body>
</html>
