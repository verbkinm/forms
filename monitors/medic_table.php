<?php
	function create_table($is_for_print)
	{
		global $date;
		global $_class_numbers;
		global $mysqli;
		
		$current_time = strtotime($date);
		$tomorrow = date('Y-m-d',$current_time + 86400);
		$yesterday = date('Y-m-d',$current_time - 86400);
		
		echo"
		<table class='table_monitor'>";
		if($is_for_print)
		{
			echo" <caption>Информация о количестве отсутствующих - данные на $date</caption>";
		}
		else
		{
			echo" <caption><a href='?date=$yesterday'><< </a>Информация о количестве отсутствующих - данные на $date<a href='?date=$tomorrow'> >></a> </caption>";
		}
		echo"
		<thead>
			<tr>		
			   <td> № </td>
				<td>Класс</td>
				<td>Кол-во <br>отсутствующих:</td>
				<td>Отсутствующие <br>по болезни <br>(простуда, ОРВИ, ГРИПП и т.д.)</td>
				<td>Отсутствующие <br>по болезни - первично <br>(простуда, ОРВИ, ГРИПП и т.д.)</td>
				<td>Классный <br>руководитель</td>
				<td>Время <br>добавления</td>";
				if(!$is_for_print && (inRoles("admin") || inRoles("editor"))  )
				{
					echo"
					<td>Изменить <br>данные</td>";
				}
			echo "
			</tr>
		</thead>";
		
		$row_count = 0;
		$total_count = 0;
		$total_number_of_patients = 0;
		$total_patients_primary = 0;
		
		for ($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++) 
		{
			$sql = "SELECT * FROM medic WHERE date = '$date' AND class = '$i' ORDER BY class_name";	
			$result = check_error_db($mysqli, $sql);
			while ($request = $result->fetch_assoc()) 
			{
				echo"
				<tr>
					<td>". ++$row_count ."</td>
					<td>". $request['class'], $request['class_name'] . "</td>
					<td>". $request['count']. "</td>
					<td>". $request['number_of_patients']. "</td>
					<td>". $request['patients_primary']. "</td>
					<td>". $request['user_name']. "</td>
					<td>". $request['time']. "</td>";
					if(!$is_for_print &&  (inRoles("admin") || inRoles("editor")) )
					{
						echo"
						<td>
							<form action='../forms/medic_edit.php' method='post'>
								<input name='id' value='".$request['id']."' hidden>
								<input type='submit' value='' class='form_edit_button'>
							</form>
						</td>";
					}
				echo
				"</tr>";
				$total_count += $request['count'];
				$total_number_of_patients += $request['number_of_patients'];
				$total_patients_primary += $request['patients_primary'];
			}
		}
		echo"
		<thead>
			<tr>
				<td colspan='2'>Итого:</td>
				<td>$total_count</td>			
				<td>$total_number_of_patients</td>		
				<td>$total_patients_primary</td>";
				$col = 0;
				if(!$is_for_print && (inRoles("admin") || inRoles("editor")) )
					$col=1;					
				else
					$col = 0;
				
				echo "<td colspan='".strval(3+$col)."'>	
			</tr>
		</thead>";
		
		if($row_count == 0) 
		{
			echo "
			<tr>
				<td colspan='".strval(7+$col)."'><H1>Данные на это число отсутствуют!</H1></td>
			</tr>";
		}
		$result->free();
		$mysqli->close();
		echo"</table>";
	}
?>