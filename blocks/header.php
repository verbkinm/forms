<?php
	if ($_GET["is_exit"] == 1) {
		out(); //Выходим
		header('Location: http://forms.litsey-yugorsk.ru/testing/auth/auth_form.php');
	}
	if($_GET['sign'] != now) {
		if (isAuth()) {  
		    $login = getLogin() ;
		}
		else {
			header('Location: http://forms.litsey-yugorsk.ru/testing/auth/auth_form.php?sign=now');
		}
	}
echo"
   <header>
   	<div class='header_text'>
   		<a href='http://forms.litsey-yugorsk.ru/testing/index.php'	>Система \" O<sub>3</sub> \"</a>
   	</div>
   	<div class='login_block'>";
   		if(isAuth()) {
				echo"Добро пожаловать, <strong>".$_SESSION['user_name']."</strong> <a href='?is_exit=1'>Выйти</a>";
			}				
			else {
				echo"Пожалуйста, войдите в систему!";
			}
			echo"
		</div>
  	</header>
  ";
?>
