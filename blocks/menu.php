<?php
echo "
<div class='menu_div'>	
	<div class='wrap'>
		<ul class='ul_menu'>
			<li><a href='http://".$_SERVER['SERVER_NAME']."/'>Главная</a></li>
			<li><a href='#'>Столовая</a>
				<ul>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/forms/eatery_set.php'>Подать заявку</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/monitors/monitor.php'>Просмотр заявок</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/forms/print_eatery_form.php'>Печать заявок</a></li>
				</ul>			
			</li>
			<li><a href='#'>Мед. кабинет</a>
				<ul>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/forms/medic_set.php'>Подать заявку</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/monitors/monitor_medic.php'>Просмотр заявок</a></li>
				</ul>
			</li>
			<li><a href='#'>Соц. педагог</a>
				<ul>
                    <li><a href='http://".$_SERVER['SERVER_NAME']."/forms/pass_set.php'>Подать заявку</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/monitors/monitor_passes.php'>Текущая неделя</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/monitors/monitor_passes_period.php'>Выбор периода</a></li>
				</ul>
			</li>
			<li><a href='#'>Обращения</a>
				<ul>
					<li><a href='http://обращения.лицейюгорск.рф' target='_blank'>Подать обращение</a></li>
					<li><a href='http://".$_SERVER['SERVER_NAME']."/monitors/monitor_appeals.php'>Список обращений</a></li>
				</ul>
			</li>";
			if( inRoles("admin") ) 
			{
				echo"
					<li><a href='#'>АДМИН.</a>
						<ul>
							<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/list.php'>Список пользователей</a></li>
							<li><a href='http://".$_SERVER['SERVER_NAME']."/admin/registration_form.php'>Добавить пользователя</a></li>
							<li><a href='http://".$_SERVER['SERVER_NAME']."/servers/mac.php'>Таблица MAC адресов</a></li>
							<li><a href='#'>...</a></li>
						</ul>
					</li>
				";
			}
		echo"		
		</ul>
	</div>
</div>";
?>
