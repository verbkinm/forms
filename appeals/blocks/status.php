<?php
	function setStatusColor($str)
	{
		switch ($str) 
		{
		    case "В обработке":
		        return "<span style='color: blue;'>В обработке</span>";
		        break;
		    case "Дан ответ отправителю":
		        return "<span style='color: green;'>Дан ответ отправителю</span>";
		        break;
		    case "Отклонено":
		        return "<span style='color: red;'>Отклонено</span>";
		        break;
		}
	}
	
	function getCurrentStatus($str_status) 
	{
		switch ($str_status) 
		{
		    case "В обработке":
		        return "
		        				<select name='status' style='width: 200px;'>
			        				<option selected>В обработке</option>
			        				<option>Дан ответ отправителю</option>
									<option>Отклонено</option>
			        			</select> 
			        		";
		        break;
		    case "Дан ответ отправителю":
		        return "
		        				<select name='status' style='width: 200px;'>
			        				<option>
			        					<b>В обработке</b>
			        				</option>
			        				<option selected>Дан ответ отправителю</option>
									<option>Отклонено</option>
			        			</select> 
			        		";
		        break;
		    case "Отклонено":
		        return "
		        				<select name='status' style='width: 200px;'>
			        				<option>
			        					<b>В обработке</b>
			        				</option>
			        				<option>Дан ответ отправителю</option>
									<option selected>Отклонено</option>
			        			</select> 
			        		";
		        break;
		}		
	}
?>
