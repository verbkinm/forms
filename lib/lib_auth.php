<?php
 function isAuth() {
	
 	if (isset($_SESSION["is_auth"])) { //Если сессия существует
	  	if(time() - $_SESSION['timestamp'] > 700) { //subtract new timestamp from the old one
			unset($_SESSION['is_auth'], $_SESSION['login'], $_SESSION['timestamp'], $_SESSION["role"], $_SESSION["user_name"]);
		   header("Location: http://forms.litsey-yugorsk.ru/testing/"); //redirect to index.php
		   exit;
		} 
		else {
	 		$_SESSION['timestamp'] = time(); //set new timestamp
		}
   	return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
   }
   else 
   	return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
   }
function auth($login, $password, $mysqli) {
	$sql = "SELECT * FROM auth WHERE login = '$login' AND password = '$password' 	";	
		
	$result = check_error_db($mysqli, $sql);
	
  	if ($result->num_rows == 0) { //Если логин и пароль введены не правильно
		$_SESSION["is_auth"] = false;
		return false; 
  	}
 	else { 
  		$_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
		$_SESSION["login"] = $login; //Записываем в сессию логин пользователя
		$role = $mysqli->query("SELECT role FROM auth WHERE login = '$login'")->fetch_object()->role;
		$_SESSION["role"] = $role;
		$user_name = $mysqli->query("SELECT user_name FROM auth WHERE login = '$login'")->fetch_object()->user_name;
		$_SESSION["user_name"] = $user_name;
		
		$datetime = date('Y-m-d H:i:s'); 	
		$ip 		 =	$_SERVER['REMOTE_ADDR'];
		$sql	= "UPDATE auth SET last_login = '$datetime', login_ip = '$ip' WHERE login = '$login'";
		$result = check_error_db($mysqli, $sql);	

		$_SESSION['timestamp'] = time();		
				
		return true;
  	}
 }
function getLogin() {
	if (isAuth()) { //Если пользователь авторизован
		return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
  	}
}
function out() {
	$_SESSION = array(); //Очищаем сессию
  	session_destroy(); //Уничтожаем
}
function check_permission($users) {
  foreach($users as $user)
  {
		if($_SESSION['role'] == $user) {
			return;
		}
  }
  header('Location: http://forms.litsey-yugorsk.ru/testing/permission_error.php'); 
}
?>
