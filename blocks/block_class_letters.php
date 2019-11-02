<?php
	$selected = "";
	echo"<option value='0'>Нет</option>";
	foreach($_class_letters as $item)
	{
		if(isset($class_name) && $item == $class_name)
			$selected = "selected";
		echo"<option value='$item' $selected>$item</option>";
		$selected = "";
	}
?>
