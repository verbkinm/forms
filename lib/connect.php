<?php	
	$mysqli = new mysqli('localhost', 'forms', 'forms', 'forms'); 
	/* изменение набора символов на utf8 */
	if (!mysqli_set_charset($mysqli, "utf8")) {
		printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($mysqli));
	}
	if (mysqli_connect_errno()) { 
		echo "Ошибка подключения к серверу MySQL. Код ошибки:".mysqli_connect_error(); 
		exit; 
	} 
	include("lib_func.php");
?>
