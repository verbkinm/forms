<?php
	$array = [
		"admin" => "Администратор", 
		"editor" => "Редактор",
		"user" => "Пользователь",
		"monitor" => "Наблюдатель",
		"monitor_eatery" => "Наблюдатель-столовая",
		"monitor_medic" => "Наблюдатель-медик",
		"monitor_passes" => "Наблюдатель-пропуски",
		"monitor_appeals" => "Наблюдатель-обращения",
		"appeals" => "Обращения",
		"soc-pedagog" => "Соц. педагог"
	];
	$selected = "";
	foreach ($array as $key=>$value) 
    {
        if(isset($roles))
        {
		    foreach($roles as $role)
			    if($role == $key)
			    	$selected = "selected";
		    echo "<option value='$key' $selected>$value</option>";
            $selected = "";
        }
	}
?>
