<?php
	$array = ["Нет", "А", "Б", "В", "Г", "Д"];
	$selected = "";
	
	foreach($array as $item)
	{
		if(isset($class_name) && $item == $class_name)
			$selected = "selected";
		if($item == "Нет")
		{
			echo"<option value='0' $selected>Нет</option>";
			continue;
		}
		echo"<option value='$item' $selected>$item</option>";
		$selected = "";
	}
?>
