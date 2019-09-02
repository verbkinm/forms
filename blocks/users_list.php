<?php
	if( !inRoles("admin") ) {
	
		if(empty($user_name)) {
			echo"
				<option>Нет</option>
			";	
		}	
		else {
			echo"
				<option>".$user_name."</option>
			";
		}
	}
	else {
		$sql = "SELECT user_name FROM auth ORDER BY user_name ASC";	 
		$result = check_error_db($mysqli, $sql);
		
		while ($request = $result->fetch_assoc()) {
			echo"
				<option>".$request['user_name']."</option>
			";
		}
	}
	
?>
