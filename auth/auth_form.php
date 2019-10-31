<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/auth_form.css">
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	<title>Авторизация</title></title>
 </head>
 <body class="body_auth_form">
<?php
	session_start(); //Запускаем сессии
	
	require_once("../lib/connect.php");  	
	require_once ("../lib/lib_auth.php");
	require_once ("../blocks/header.php");
	
	echo"
	<div class='content'>";
	if (isset($_POST["login"]) && isset($_POST["password"])) //Если логин и пароль были отправлены
	{ 
	    if (!auth($_POST["login"], $_POST["password"],$mysqli)) //Если логин и пароль введен не правильно
	        echo "<h2 style=\"color:red;\">Логин или пароль введен не правильно!</h2>";
	}
	if(isset($_SESSION["is_auth"]) && $_SESSION["is_auth"])
	{
		header('Location: ../index.php');
	}
	else 
	{
		echo"
		<!-- <div class='message_incorrect'>База данных до 12.10.18 была повреждена! <br>Для восстановления данных за текущую неделю - обратитесь в бухгалтерия<br></div> -->
		<h3>Авторизация:</h3>
		<form method='post' action='/auth/auth_form.php?sign=now' class='auth_form'>
			<table class='table_auth_form'>
				<tr>
					<td>Логин:</td>
					<td>";
						$val = (isset($_POST['login'])) ? $_POST['login'] : null;
						echo"
						<input type='text' name='login' required value='$val'/><br/>
					</td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td> 
						<input type='password' name='password' required value='' /><br/>
					</td>
				</tr>
				<tr>	
					<td colspan='2'><input type='submit' value='Войти' class='button_set'/></td>	
				</tr>
			</table>
		</form>
		<h3>Вербкин М.С. : +7 904 471 47 81</h3>";
	}
	echo"
	</div>";
?>

 </body>
</html>
