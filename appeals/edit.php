<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="style-answer.css">
		<title>Обращение</title>
	</head>
	<body>
	<?php
		session_start();
				
		require_once("../lib/connect.php");
		require("../lib/lib_auth.php");
		require ("../blocks/header.php");
		require ("../blocks/menu.php");
		require("blocks/status.php");
		
		check_permission(array('admin', 'appeals')); 
		
		$sql = "SELECT * FROM auth WHERE id = '$id'";
		
// не подключаю из файла lib/connect.php т.к. идёт дублирование переменных и фунций
		$mysqli = new mysqli('localhost', 'appeals', 'M4UC0wxkmEgpXZ5R', 'appeals'); 
		/* изменение набора символов на utf8 */
		if (!mysqli_set_charset($mysqli, "utf8")) {
			printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($mysqli));
		}
		if (mysqli_connect_errno()) { 
			echo "Ошибка подключения к серверу MySQL. Код ошибки:".mysqli_connect_error(); 
		}
	
		$id		=	$_GET['id'];
				
		$sql_auth = "SELECT * FROM appeals WHERE id = '$id'";
		$result_auth = check_error_db($mysqli, $sql_auth);
		$result = mysqli_fetch_array($result_auth);
		
		$status	=	$result['status'];
		
		function checked($checkboxName) {
			global $result;
			if( strcmp($result[$checkboxName], "on") == 0) 
				return "checked";
			else
				return "";
		}
		
		echo"		
		<div class='content'>	
			<table class='table_appeals'>
				<caption>Сведения об обращении №".$result['id']."</caption>
				<tr>
					<td>			
						<p><b>Дата и время подачи обращения: </b>".$result['date']." - ".$result['time']."</p>
						
						<p><b>Статус обращения: </b>

						".setStatusColor($result['status'])."
						
						<p><b>Кому адресовано: </b>".$result['for_whom']."<br>
						<b>Ф.И.О. адресата: </b>".$result['employee']."<br>
						<b>Форма обращения: </b>".$result['form_of_appeal']."<br>
						</p>
						
						<p><b>Информация о заявителе:</b></p>
						<p><b>Фамилия: </b>".$result['surname']."<br>
						<b>Имя: </b>".$result['name']."<br>
						<b>Отчество: </b>".$result['patronymic']."<br>
						</p>
						<p><b>Наименование организации (юридического лица): </b>".$result['name_of_company']."<br>
						<b>e-mail: </b>".$result['email']."<br>
						<b>Контактный телефон: </b>".$result['phone_number']."<br>
						</p>
						
						<p>
							<b>Текст обращения:</b>
							<div class='block_answer' >
							".str_replace("\n", "<br>", $result['text_of_appeal'])."
							</div>
						</p>";
						
			
						$id = $result['id'];
						$sql = "SELECT * FROM collaborators  WHERE appeals_id = '$id'";
						$result2 = check_error_db($mysqli, $sql);
						$num_rows = mysqli_num_rows($result2);
						if($num_rows > 0)
						{
							echo "
							<p><b>Соавторы: </b></p>
						";
							while ($request = $result2->fetch_assoc()) {
								echo"
								<p>
									<b>Фамилия:</b> ".$request['surname']."<br>
									<b>Имя: </b> ".$request['name']."<br>
									<b>Отчество: </b>".$request['patronymic']." <br>
									<b>e-mail: </b>".$request['email']."<br>
								</p>";
							}
						}
						echo "
								<p><b>Ответ прислать</b>:<br>
									<input type='checkbox' ".checked('checkbox_email')." disabled />по электронной почте<br>					
									<input type='checkbox' ".checked('checkbox_take_it_personally')." disabled />заберу лично<br>
									<input type='checkbox' ".checked('checkbox_mail')." disabled />на мой почтовый адрес<br>
									<p><b>Почтовый адрес: </b>".$result['mail']."</p>		
								</p>
								<p><b>Прикреплённый файл: </b>";
								if( empty($result['file_name']) )
									echo "отсутствует";
								else
									echo "<a href='".$result['file_name']."' download>скачать</a>";
						echo "
								</p>";
						$sql = "SELECT * FROM history WHERE appeals_id = '$id' ORDER BY date";	
						$result3 = check_error_db($mysqli, $sql);
						$num_rows = mysqli_num_rows($result3);	
						if($num_rows > 0){
							echo"
							<p>
								<h3>Ответы:</h3>
							</p>
							<div class='answer_form'>";
								
								while ($request3 = $result3->fetch_assoc()) {
									echo "
										<div class='one_answer'>
											<div class='left_block_answer'>
												".
													$request3['author']
													."<br>".
													$request3['date']." - ".$request3['time']
													."<br>Статус: ".
													setStatusColor($request3['status'])
												."
											</div>
											<div class='right_block_answer'>
												".
													str_replace("\n", "<br>", $request3['answer'])
												."
											</div>
										</div>
										";
								}
						}
						else
							echo "
								<p>
									<h3>Ответов ещё нет.</h3>
								</p>
								";
								
						echo"
						</div>
						<br>	
						<form  action='edit_get.php' method='post' class='answer_form' onsubmit='return disableButtonOnClick()' >
							<p>
								<h3>Дать ответ:</h3>
							</p>
							Выбрать статус: ";
							echo getCurrentStatus($result['status']);
						echo "
							<textarea name='answer' class='answer'></textarea>
							<input id='buttonSubmit' type='submit' value='Отправить ответ' />
							<input hidden name='id' value='".$id."' />
							<br>
						</form>
						<br>
					</td>
				</tr>
				";			
				
		?>	
			</table>
		</div>	
	 </body>
	 <script>
 //отключение кнопки поиска после однократного нажатия, чтобы исключить многократное отправление писем		
	function disableButtonOnClick()
	{
		var elem = document.getElementById('buttonSubmit');
		elem.setAttribute("disabled", "");
		elem.setAttribute("value", "Подождите ...");
		return true;
	}
	 </script>
</html>
