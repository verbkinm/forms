<?php
	if ($_GET["is_exit"] == 1) {
		out(); //Выходим
		header("Location: http://".$_SERVER['SERVER_NAME']."/auth/auth_form.php");
	}
	if($_GET['sign'] != now) {
		if (isAuth()) {  
		    $login = getLogin() ;
		}
		else {
			header("Location: http://".$_SERVER['SERVER_NAME']."/auth/auth_form.php?sign=now");
		}
	}
echo"
<!-- <script type='text/javascript' src='../snow-fall.js'></script> -->
   <header>
   	<div class='header_text'>
   		<a href='http://".$_SERVER['SERVER_NAME']."'>Система \"O<sub>3</sub>\" </a>
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
