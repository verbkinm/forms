<?php
echo "
<div class='menu_div'>	
	<div class='wrap'>
		<ul class='ul_menu'>
			<li><a href='http://".$_SERVER['SERVER_NAME']."/'>Главная</a></li>
			<li><a href='#'>Тесты</a>
				<ul>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/list.php'>Список тестов</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/registration_form.php'>Добавить тест</a></li>
				</ul>
			</li>
			<li><a href='#'>Библиотек</a>
				<ul>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/list.php'>Список разделов</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/registration_form.php'>Добавить раздел</a></li>
				</ul>
			</li>
			<li><a href='#'>АДМИН.</a>
				<ul>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/list.php'>Список пользователей</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/registration_form.php'>Добавить пользователя</a></li>
				</ul>
			</li>		
		</ul>
	</div>
</div>";
?>
