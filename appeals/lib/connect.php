<?php	
	$mysqli = new mysqli('localhost', 'appeals', 'M4UC0wxkmEgpXZ5R', 'appeals'); 
	/* изменение набора символов на utf8 */
	if (!mysqli_set_charset($mysqli, "utf8")) {
		printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($mysqli));
	}
	if (mysqli_connect_errno()) { 
		echo "Ошибка подключения к серверу MySQL. Код ошибки:".mysqli_connect_error(); 
		exit; 
	} 
	require_once("lib_func.php");
?>
