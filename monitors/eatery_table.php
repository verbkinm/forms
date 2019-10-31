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
			echo "<caption>Заявки в столовую - данные на " .date("d-m-Y", strtotime($date)). "</caption>";
		}
		else
		{
			echo "<caption><a href='?date=$yesterday'><< </a>Заявки в столовую - данные на " .date("d-m-Y", strtotime($date)). " <a href='?date=$tomorrow'> >></a> </caption>";
		}
		echo"
		<thead>
			<tr>		
			   <td style='width:4%;'> № </td>
				<td style='width:6%'>Класс</td>
				<td style='width:6%'>Кол-во <br> детей</td>
				<td style='width:9%'>Кол-во <br>льготников</td>
				<td id='td_names_lg' >Ф.И.О. <br>льготников</td>
				<td style='width:10%'>Классный <br>руководитель</td>
				<td style='width:9%'>Время <br>добавления</td>";
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
		$total_count_lg = 0;
		
		for ($i = $_class_numbers[0]; $i <= count($_class_numbers); $i++) 
		{
			$sql = "SELECT * FROM eatery WHERE date = '$date' AND class = '$i' ORDER BY class_name";	
			$result = check_error_db($mysqli, $sql);
			while ($request = $result->fetch_assoc()) 
			{
				echo"
				<tr>
					<td>". ++$row_count ."</td>
					<td>". $request['class'], $request['class_name'] . "</td>
					<td>". $request['count']. "</td>
					<td>". $request['count_lg']. "</td>
					<td>". $request['names_lg']. "</td>
					<td>". $request['user_name']. "</td>
					<td>". $request['time']. "</td>";
					if(!$is_for_print &&  (inRoles("admin") || inRoles("editor")) )
					{
						echo"
						<td>
							<form action='../forms/eatery_edit.php' method='post'>
								<input name='id' value='".$request['id']."' hidden>
								<input type='submit' value='' class='form_edit_button'>
							</form>
						</td>";
					}
				echo
				"</tr>";
				$total_count += $request['count'];
				$total_count_lg += $request['count_lg'];
			}
		}
		echo"
		<thead>
			<tr>
				<td colspan='2'>Итого:</td>
				<td>$total_count</td>			
				<td>$total_count_lg</td>";
				$col = 0;
				if(!$is_for_print && (inRoles("admin") || inRoles("editor")) )
					$col=1;					
				else
					$col = 0;
				
				echo "<td colspan='".strval(3+$col)."'>		
			</tr>
		</thead>";
		
		if($row_count==0) 
		{
			echo "
			<tr>
				<td colspan='".strval(7+$col)."'><H1>Данные на это число отсутствуют!</H1></td>
			</tr>";
		}
		$result->free();
		$mysqli->close();
		
		echo"
		</table>";
	}
?>