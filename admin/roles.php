<?php
	$array = [
		"admin" => "Администратор", 
		"editor" => "Редактор",
		"user" => "Пользователь",
		"monitor" => "Монитор",
		"appeals" => "Обращения"
	];
	$selected = "";
	foreach ($array as $key=>$value) 
	{
		foreach($roles as $role)
			if($role == $key)
				$selected = "selected";
		echo "<option value='$key' $selected>$value</option>";
		$selected = "";
	}
/* 	foreach ($roles as $key=>$value) 
	{
		echo "<option value='$key'>$value</option>";
	} */
/* 	$selected = "";
	
	foreach($array as $item)
	{
		if($item == $class_name)
			$selected = "selected";
		if($item == "Нет")
		{
			echo"<option value='0' $selected>Нет</option>";
			continue;
		}
		echo"<option value='$item' $selected>$item</option>";
		$selected = "";
	} */

?>
