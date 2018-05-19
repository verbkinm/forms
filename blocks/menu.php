<div class="menu_div">	
	<div class="wrap">
		<ul class="ul_menu">
			<li><a href="http://forms.litsey-yugorsk.ru/testing">Главная</a></li>
			<li><a href="#">Столовая</a>
				<ul>
					<li><a href="http://forms.litsey-yugorsk.ru/testing/forms/eatery_set.php">Подать заявку</a></li>
					<li><a href="http://forms.litsey-yugorsk.ru/testing/monitors/monitor.php">Просмотр заявок</a></li>
					<li><a href="http://forms.litsey-yugorsk.ru/testing/forms/print_eatery_form.php">Печать заявок</a></li>
				</ul>			
			</li>
			<li><a href="#">Мед. кабинет</a>
				<ul>
					<li><a href="http://forms.litsey-yugorsk.ru/testing/forms/medic_set.php">Подать заявку</a></li>
					<li><a href="http://forms.litsey-yugorsk.ru/testing/monitors/monitor_medic.php">Просмотр заявок</a></li>
				</ul>
			</li>
			<li><a href="#">Соц. педагог</a></li>
			<?php
				if($_SESSION['role'] == "admin") {
					echo"
						<li><a href='#'>АДМИН.</a>
							<ul>
								<li><a href='http://forms.litsey-yugorsk.ru/testing/admin/list.php'>Список пользователей</a></li>
								<li><a href='http://forms.litsey-yugorsk.ru/testing/admin/registration_form.php'>Добавить пользователя</a></li>
								<li><a href='#'>...</a></li>
							</ul>
						</li>
				";
				}
			?>
		</ul>
	</div>
</div>