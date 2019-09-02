<?php
function insert_date_form()
{
	global $date;
	echo "
		<div id='monitor_form'>
		  	<form action='' method='get'>
				Выбор даты:
				<input type='date' name='date' value='".$date."' class='date'>
				<input type='submit' value='Перейти' >
			</form>
		</div>
	";
}
?>