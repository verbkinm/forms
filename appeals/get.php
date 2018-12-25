<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>
	<body>
<?php 			
		$countCollaborators				=	trim(strip_tags($_POST['countCollaborators']));
		
		$for_whom						=	trim(strip_tags($_POST['for_whom']));
		$employee						= 	trim(strip_tags($_POST['employee']));
		$form_of_appeal					=	trim(strip_tags($_POST['form_of_appeal']));
		
		$date							=	date("Y-m-d");
		$time 							=  	date('H:i:s'); 	
		
		$surname						=	trim(strip_tags($_POST['surname']));
		$name 							= 	trim(strip_tags($_POST['name']));
		$patronymic						=	trim(strip_tags($_POST['patronymic']));
		
		$name_of_company				=	trim(strip_tags($_POST['name_of_company']));
		
		$email							=	trim(strip_tags($_POST['email']));
		$phone_number					=	trim(strip_tags($_POST['phone_number']));
		
		$text_of_appeal					=	trim(strip_tags($_POST['text_of_appeal']));
		
		$checkbox_email					=	trim(strip_tags($_POST['checkbox_email']));
		$checkbox_mail					=	trim(strip_tags($_POST['checkbox_mail']));
		$checkbox_take_it_personally	=	trim(strip_tags($_POST['checkbox_take_it_personally']));
		$mail							=	trim(strip_tags($_POST['mail']));
		
		$countCollaborators				=	trim(strip_tags($_POST['countCollaborators']));

		$url = md5(microtime() . rand(0, 9999));	
		
		if( !empty($_FILES['file']['name']) )
		{	
			$dirName = md5(microtime() . rand(0, 9999));
			mkdir("uploads/".$dirName, 0700);
			copy($_FILES['file']['tmp_name'],"uploads/".$dirName."/".basename($_FILES['file']['name']));
			
			$file_name = "uploads/".$dirName."/".basename($_FILES['file']['name']);			
		}
		
		function check($data) {
			if(empty($data) != 1)
				return FALSE;
			else
				return TRUE;			
		}
 	
		if( (check($surname) == 1) || (check($name) == 1) || (check($email) == 1) || (check($text_of_appeal) == 1) )
		{
			header("Location: index.php");
			exit();
		}
			
		include("lib/connect.php");

		$sql = "INSERT INTO appeals (for_whom, employee, form_of_appeal, date, time, surname, name, patronymic, name_of_company,
												email, phone_number, text_of_appeal, checkbox_email, checkbox_mail, mail, checkbox_take_it_personally, 
												file_name, url )
					VALUES 			  	 ('$for_whom', '$employee', '$form_of_appeal', '$date', '$time', '$surname', '$name', '$patronymic', '$name_of_company',
												'$email', '$phone_number', '$text_of_appeal', '$checkbox_email', '$checkbox_mail', '$mail', '$checkbox_take_it_personally', 
												'$file_name', '$url')";
		correct_or_error($mysqli, $sql, "<div class='message_correct'>Успешно создана новая запись!</div>");
		
		$appeals_id = $mysqli->insert_id;
		
		include("phpmailer/phpmailer_setting.php");
		
		sendMail($email, $appeals_id, $surname, $name, $patronymic, $url, true);

//теперь добавляем в базу соавторов и отправляем им письма 
		for($i = 0; $i < $countCollaborators; $i++) 
		{
			$surname		=	$_POST['surname'.$i];
			$name			=	$_POST['name'.$i];
			$patronymic	=	$_POST['patronymic'.$i];
			$emailCollaborator		=	$_POST['email'.$i];
			
			$sql = "INSERT INTO collaborators (appeals_id, surname, name, patronymic, email)
						VALUES ($appeals_id, '$surname', '$name', '$patronymic', '$emailCollaborator')";
						
			correct_or_error($mysqli, $sql, "");
			
			sendMail($emailCollaborator, $appeals_id, $surname, $name, $patronymic, $url, false);
		}
		
		header("Location: view.php?url=".$url);
?>	
	</body>
</html>
