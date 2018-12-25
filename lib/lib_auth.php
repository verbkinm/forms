<?php
 function isAuth() {
	if ( (isset($_SESSION["is_auth"])) && ($_SESSION["is_auth"] == "true") ) { //Если сессия существует
	  	if(time() - $_SESSION['timestamp'] > 700) { //subtract new timestamp from the old one
			unset($_SESSION['is_auth'], $_SESSION['login'], $_SESSION['timestamp'], $_SESSION["role"], $_SESSION["user_name"]);
		   header("Location: http://".$_SERVER['SERVER_NAME']."/"); //redirect to index.php
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
	if (!password_verify($password, $mysqli->query("SELECT password FROM auth WHERE login = '$login'")->fetch_object()->password)) {
		$_SESSION["is_auth"] = false;
		return false; 
  	}
 	else { 
  		$_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
		$_SESSION["login"] = $login; //Записываем в сессию логин пользователя
		$_SESSION['user_id'] = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;
		$id = $_SESSION['user_id'];
		
		$_SESSION['roles'] = array();
		$result = $mysqli->query("SELECT role FROM roles WHERE user_id = $id");
		while ($request = $result->fetch_assoc()) 
			array_push($_SESSION['roles'], $request['role']);
		$_SESSION["user_name"] = $mysqli->query("SELECT user_name FROM auth WHERE login = '$login'")->fetch_object()->user_name;
		//$_SESSION["user_name"] = $user_name;
		
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
function inRoles($str_role)
{
	foreach($_SESSION['roles'] as $role){
		if(strcmp($str_role, $role) == 0)
			return true;
	}
	return false;
}
function check_permission($users) {
  foreach($users as $user)
  {
		if(inRoles($user) ) {
			return;
		}
  }
  header("Location: http://".$_SERVER['SERVER_NAME']."/permission_error.php"); 
}
function onlyRole($array, $str_role)
{
	if( (count($array) == 1) && (strcmp($array[0], $str_role) == 0) )
		return true;
	return false;
}
?>
