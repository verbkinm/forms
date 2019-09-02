<?php				
	echo"<option value='0'>Нет</option>";
	$selected = "";
	for($i = 1; $i < 12; $i++)
	{
		if($i == $class)
			$selected = "selected";
		echo"<option value='$i' $selected>$i</option>";
		$selected = "";
	}		
?>