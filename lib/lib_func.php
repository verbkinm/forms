<?php
function correct_or_error($mysqli, $sql, $text) 
{
	if ($mysqli->query($sql) === TRUE) 
		echo $text;
	else
		echo "<div class='message_incorrect'>Ошибка: " . $sql . "<br></div>" . $mysqli->error;
}
function check_error_db($mysqli, $sql) 
{
	if (!$result = $mysqli->query($sql)) 
	{
		echo "<div class='message_incorrect'>Извините, возникла проблема в работе сайта.<br></div>";
		echo "Запрос: " . $sql . "\n";
		echo "Номер_ошибки: " . $mysqli->errno . "\n";
		echo "Ошибка: " . $mysqli->error . "\n";
		exit;
	}
	return $result;
}
?>