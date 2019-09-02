<?php
// Файлы phpmailer
	require 'class.phpmailer.php';
	require 'class.smtp.php';
	
	function sendSelfMail($appeals_id)
	{
		$phpmail = new PHPMailer;
		
		$phpmail->isSMTP(); 
		$phpmail->Host = 'smtp.mail.ru';  
		$phpmail->SMTPAuth = true;                      
		$phpmail->Username = 'litsey.yugorsk'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
		$phpmail->Password = 'Litseist2015'; // Ваш пароль
		$phpmail->SMTPSecure = 'ssl';                            
		$phpmail->Port = 465;
		$phpmail->setFrom('litsey.yugorsk@mail.ru'); // Ваш Email
		$phpmail->addAddress('litsey.yugorsk@mail.ru'); // Email получателя
		$phpmail->isHTML(true); 
		$phpmail->Subject = "Лицей им. Г.Ф. Атякшева. Поступило новое обращение!";
		$phpmail->Body = "Поступило новое обращение <a href='https://forms.litsey-yugorsk.ru/appeals/edit.php?id=".$appeals_id."'>ссылка на просмотр обрщения</a>";
		$phpmail->send();
		
	}
	
	function sendMail($email, $author_id, $surname, $name, $patronymic, $url, $author) {
//						обращения.лицейюгорск.рф
		$SERVER_NAME = "xn--80abnmycp7evc.xn--c1adifgbzqj8bzf.xn--p1ai";
		$phpmail = new PHPMailer;
		
		$phpmail->isSMTP(); 
		$phpmail->Host = 'smtp.mail.ru';  
		$phpmail->SMTPAuth = true;                      
		$phpmail->Username = 'litsey.yugorsk'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
		$phpmail->Password = 'Litseist2015'; // Ваш пароль
		$phpmail->SMTPSecure = 'ssl';                            
		$phpmail->Port = 465;
		$phpmail->setFrom('litsey.yugorsk@mail.ru'); // Ваш Email
		$phpmail->addAddress($email); // Email получателя
		
		//$phpmail->addCustomHeader ("Precedence: bulk"); 
		//$phpmail->addCustomHeader ("X-Mailer: phpmailer");
		
	// Письмо
		$phpmail->isHTML(true); 
		$phpmail->Subject = "Лицей им. Г.Ф. Атякшева. Обращение №".$author_id; // Заголовок письма
		if($author) {
		$phpmail->Body    = "
			Уважаемый(ая), ".$surname." ".$name." ".$patronymic.",
			Вы получили это письмо, так как указали этот адрес при отправке обращения в Лицей им.Г.Ф. Атякшева.
			Чтобы проверить статус обращения перейдите по 
			<a href='http://".$SERVER_NAME."/view.php?url=".$url."'>ссылке</a>
			<br>
			С уважением,
			Лицей им. Г.Ф. Атякшева
			litsey.yugorsk@mail.ru"; // Текст письма
		}
		else {
			$phpmail->Body    = "
			Уважаемый(ая), ".$surname." ".$name." ".$patronymic.",
			Вы получили это письмо, так как вас указали в качестве соавтора при отправке обращения в Лицей им.Г.Ф. Атякшева.
			Чтобы проверить статус обращения перейдите по 
			<a href='http://".$SERVER_NAME."/view.php?url=".$url."'>ссылке</a>
			<br>
			С уважением,
			Лицей им. Г.Ф. Атякшева
			litsey.yugorsk@mail.ru"; // Текст письма
		}
	// Отправка 
		$phpmail->send();
		//if(!$phpmail->send()) {
		    //echo 'Письмо не отправлено.';
		    //echo 'Mailer Error: ' . $phpmail->ErrorInfo;
		    //exit();
		//}
	}
?>
