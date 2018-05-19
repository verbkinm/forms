<?php				
	if($_SESSION['role'] == "admin") {
		echo"
			<option value='А'>А</option>
			<option value='Б'>Б</option>
			<option value='В'>В</option>
			<option value='Г'>Г</option>
		";
	}
	else {
		if(empty($class_name)) {
			echo"
				<option>Нет</option>
			";
		}
		else {
			echo"
				<option>".$class_name."</option>
			";
		}
	}
?>