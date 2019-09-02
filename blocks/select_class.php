<?php				
	if( inRoles("admin") ) {
		include("block_number_of_classes.php");
	}
	else {
		if(empty($class)) {
			echo"
				<option>Нет</option>
			";
		}
		else {
			echo"
				<option>".$class."</option>
			";
		}
	}
?>
