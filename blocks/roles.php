<?php
	$selected = "";
	foreach ($_roles as $key=>$value) 
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
