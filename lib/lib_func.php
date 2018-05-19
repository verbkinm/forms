<?php
function correct_or_error($mysqli, $sql, $text) {
	if ($mysqli->query($sql) === TRUE) {
		echo $text;
	} 
	else {
		echo "<div class='message_incorrect'>Ошибка: " . $sql . "<br></div>" . $mysqli->error;
	}
}
function check_error_db($mysqli, $sql) {
	if (!$result = $mysqli->query($sql)) {
    // О нет! запрос не удался. 
    echo "<div class='message_incorrect'>Извините, возникла проблема в работе сайта.<br></div>";

    // И снова: не делайте этого на реальном сайте, но в этом примере мы покажем, 
    // как получить информацию об ошибке:
    echo "Ошибка: Наш запрос не удался и вот почему: \n";
    echo "Запрос: " . $sql . "\n";
    echo "Номер_ошибки: " . $mysqli->errno . "\n";
    echo "Ошибка: " . $mysqli->error . "\n";
    exit;
	}
	return $result;
}
?>