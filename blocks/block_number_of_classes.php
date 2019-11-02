<?php				
	echo"<option value='0'>Нет</option>";
	$selected = "";
	for($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++)
	{
		if(isset($class) && $i == $class)
			$selected = "selected";
		echo"<option value='$i' $selected>$i</option>";
		$selected = "";
	}		
?>
