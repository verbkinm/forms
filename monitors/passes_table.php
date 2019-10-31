<?php	
	function create_table($is_for_print)
	{	
		global $date;
		global $_class_numbers;
		global $mysqli;
		
		$current_time = strtotime($date);
		$next_week = date('Y-m-d',$current_time + 86400 * 7);
		$previos_week = date('Y-m-d',$current_time - 86400 * 7);
		
		$first_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 1)*86400);
		$last_day_in_week = date('d-m-Y',$current_time-(date('N',$current_time) - 7)*86400);
		
		$total_absence_due_to_illness = 0;
		$total_absence_of_a_valid_reason = 0;
		$total_absence_for_a_good_reason = 0;
						
		echo"
		<table class='table_monitor'>";
			 
		if($is_for_print)
		{
			echo"<caption>Данные об отсутствующих на период с ".$first_day_in_week." по ".$last_day_in_week."</caption>";
		}
		else
		{
			echo"<caption><a href='?date=$previos_week'><< </a>Данные об отсутствующих на период с ".$first_day_in_week." по ".$last_day_in_week." <a href='?date=$next_week'> >></a></caption>";
		}
		echo"
		<thead>
			<tr>		
				<td> № </td>
				<td>Класс</td>
				<td>Пропуски <br>по болезням</td>
				<td>Пропуски по заявлению <br>родителей и <br>уважительной причине</td>
				<td>Пропуски по <br>неуважительной <br>причине</td>
				<td>Всего <br>для ученика</td>
				<td>Всего <br>в классе</td>
				<td>Классный <br>руководитель</td>
				<td>Дата и <br>время подачи</td>";
				if(!$is_for_print && (inRoles("admin") || inRoles("editor"))  )
				{
					echo"
					<td>Изменить <br>данные</td>";
				}
			echo "
			</tr>
		</thead>";

		$week_number = date("W", strtotime($first_day_in_week));
		$counter = 0;
		for ($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++) 
		{
			$sql = "SELECT * FROM passes WHERE week_number = '$week_number' AND class = $i ORDER BY class_name";
			$result = check_error_db($mysqli, $sql);		
			
			while ($request = $result->fetch_assoc()) 
			{
				++$counter;
				$full_class_name = $request['class'].$request['class_name'];
				$user_name = $request['user_name'];
				$date_time = date("d-m-Y H:i:s", strtotime($request['date_time']));
				echo"
				<tr>
					<td>$counter</td>
					<td>$full_class_name</td>";
					$passes_id = $request['id'];
					$sub_sql = "SELECT * FROM passes_application WHERE passes_id = $passes_id ORDER BY student_name";
					$sub_result = check_error_db($mysqli, $sub_sql);
					
					$children = array();
					while ($sub_request = $sub_result->fetch_assoc()) 
					{
						$children[$sub_request['student_name']] = array($sub_request['absence_due_to_illness'], $sub_request['absence_for_a_good_reason'], $sub_request['absence_of_a_valid_reason']);
					}
					
					print_children_data($children, 0);
					print_children_data($children, 1);
					print_children_data($children, 2);
					total_absence($children, $total_absence_due_to_illness, $total_absence_of_a_valid_reason, $total_absence_for_a_good_reason);
					
					echo"
					<td>$user_name</td>
					<td>$date_time</td>";
					if(!$is_for_print &&  (inRoles("admin") || inRoles("editor")) )
					{
						echo"
						<td>
							<form action='../forms/pass_edit.php' method='post'>
								<input name='passes_id' value='$passes_id' hidden>
								<input type='submit' value='' class='form_edit_button'>
							</form>
						</td>";
					}
				echo"
				</tr>";
			}
		}
		echo"
		<thead>
			<tr>
				<td colspan='2'>
					Итого:
				</td>
				<td>$total_absence_due_to_illness</td>		
				<td>$total_absence_of_a_valid_reason</td>					
				<td>$total_absence_for_a_good_reason</td>";
				$total = $total_absence_due_to_illness + $total_absence_of_a_valid_reason + $total_absence_for_a_good_reason;
				echo"
				<td colspan='2'>$total</td>";
				$col = 0;
				if(!$is_for_print && (inRoles("admin") || inRoles("editor")) )
					$col=1;					
				else
					$col = 0;
				
				echo "<td colspan='".strval(3+$col)."'>
			</tr>
		</thead>";
		
		if($total == 0) 
		{
			echo"
			<tr>
				<td colspan='".strval(9+$col)."'><H1>Данные на этот период отсутствуют!</H1></td>
			</tr>";
		}
		$result->free();
		$mysqli->close();
		
		echo"
		</table>";
	}
	
	function print_children_data($children, $field_number)
	{
		echo "<td>";
		$children_names = array_keys($children);
		foreach($children as $child_name => $val)
		{
			echo $child_name." - ".$children[$child_name][$field_number]."<br>";
		}
		echo "</td>";
	}
	
	function total_absence($children, &$total_absence_due_to_illness, &$total_absence_of_a_valid_reason, &$total_absence_for_a_good_reason)
	{		
		$sum = 0;
		echo"<td>";
		foreach($children as $child_name => $val)
		{
			$sum_for_one_child = $children[$child_name][0] + $children[$child_name][1] + $children[$child_name][2];
			echo $child_name." - ".$sum_for_one_child."<br>";
			$sum += $children[$child_name][0] + $children[$child_name][1] + $children[$child_name][2];
			
			$total_absence_due_to_illness += $children[$child_name][0];
			$total_absence_of_a_valid_reason += $children[$child_name][1];
			$total_absence_for_a_good_reason += $children[$child_name][2];
		}		
		echo"
		</td>
		<td>$sum</td>";
	}
?>