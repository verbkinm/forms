<?php	

	$mysqli = new mysqli('localhost', 'forms', 'u9G9BF0?Iv@%', 'forms'); 
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
