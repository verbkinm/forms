<?php				
	if( inRoles("admin") ) {
		include("block_class_letters.php");
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
