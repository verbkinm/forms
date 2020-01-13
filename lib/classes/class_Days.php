<?php
	class Days
	{
		private $current_day;
		private $date;
		private $calss;
		private $class_name;
		private $day_name = 
		[
			1 => 'Пн',
			2 => 'Вт',
			3 => 'Ср',
			4 => 'Чт',
			5 => 'Пт',
			6 => 'Сб',
			7 => 'Вс'
		];
		private $total_in_day;
		
		public function __construct($current_day, $week_number, $date, $class, $class_name)
		{
			$this->current_day = $current_day;
			$this->week_number = $week_number;
			$this->date = $date;
			$this->class = $class;
			$this->class_name = $class_name;
		}

		public function __destruct()
		{
			
		}
		
		public function echo_days()
		{
			global $mysqli;	
			$sql = "SELECT * FROM passes WHERE class = $this->class AND class_name = '$this->class_name' AND week_number = $this->week_number";	
			$result = check_error_db($mysqli, $sql);
			
			if($result->num_rows > 7)
			{
				echo "<div class='message_incorrect'>Неверный ответ на запрос $sql <br> Кол-во дней превышает максимум</div>";
				exit(0);
			}
			$passed_id = [];
			while($request = $result->fetch_assoc())
				$passed_id[$request['day_number']] = $request['id'];
			
			foreach($passed_id as $day_number => $id)
			{
				$sql = "SELECT SUM(`absence_due_to_illness`) as absence_due_to_illness, 
							   SUM(`absence_for_a_good_reason`) as absence_for_a_good_reason, 
							   SUM(`absence_of_a_valid_reason`) as absence_of_a_valid_reason
						FROM passes_application 
						WHERE passes_id = $id";	
				$result = check_error_db($mysqli, $sql);	
				if($result->num_rows > 1 || $result->num_rows == 0)
				{
					echo "<div class='message_incorrect'>Неверный ответ на запрос $sql <br> В ответе должна быть одна строка</div>";
					exit(0);
				}
				$request = $result->fetch_assoc();
				$this->total_in_day[$day_number] = $request['absence_due_to_illness'] + $request['absence_for_a_good_reason'] + $request['absence_of_a_valid_reason'];
			}
			echo"
			<table>
				<tr>";
				for($i = 1; $i <= 7; ++$i)
				{
					if($i == $this->current_day)
						$class = 'button_day_selected';
					else
						$class = 'button_day';
					
					echo "<td><a href='?class_number=$this->class&class_name=$this->class_name&date=$this->date&day=$i' class='$class'>".$this->day_name[$i]."</a></td>";
				}
				echo
				"</tr>
				<tr>";
				for($i = 1; $i <= 7; ++$i)
				{
					if(isset($this->total_in_day[$i]))
						echo "<td style='text-align:center;'>(".$this->total_in_day[$i].")</td>";
					else
						echo "<td style='text-align:center;'>(0)</td>";
				}
				echo
				"</tr>
			</table>";
		}
	} 	
?>