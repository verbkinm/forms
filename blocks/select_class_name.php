<?php				
	if( inRoles("admin") ) 
	{
		require_once('block_class_letters.php');
	}
	else 
	{
		if(empty($class_name)) 
			echo "<option>Нет</option>";
		else 
			echo"<option>$class_name</option>";
	}
?>
