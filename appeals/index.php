<html lang="ru">
	<head>
		<title>
			Форма подачи
		</title>
		<noscript><meta http-equiv="refresh" content="0;URL=http://404" /></noscript>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

<div class="wrapper">
		<p style="text-align: center; font-size: 22px;">
			Отправка нового обращения в Лицей им.Г.Ф. Атякшева!<br>
			Прежде чем отправить обращение, ознакомьтесь с документом, пройдя по этой <a href="inf.htm">ссылке</a>.
		</p>
			<table class="table">
				<tr>
					<td class="td1" >Поиск по номеру обращения:</td>
					<td class="td2" >
							<form method="post"  action="search_get.php" onsubmit="return disableButtonOnClick('searchButton')">
								<div style="width: 100%;">
									<input style="width: 80%;" id="search" name="searchId" type="number" min="0" placeholder="Введите номер обращения" required />
									<input style="width: 19%;" type="submit" id="searchButton" name="searchButton" value="поиск" />
								</div>
							</form>		
					</td>
				</tr>
			</table>
			<form id="form" action="get.php" method="post" enctype="multipart/form-data" onsubmit="return disableButtonOnClick('buttonSubmit')">
			<table id="table" class="table"> 
				<tr>
					<td class="td1"><span style="color: red;">*</span>Кому:</td>
					<td class="td2">
						<select name="for_whom">
  							<option>Любому должностному лицу</option>
  							<option>Руководителю организации</option>
  							<option>Секретарю</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Укажите Ф.И.О. сотрудника, если знаете:
					</td>
					<td>
						<input name="employee" type="text" placeholder="Ф.И.О. сотрудника" />
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>Форма обращения:
					</td>
					<td>
						<select name="form_of_appeal">
							<option>Предложение</option>
  							<option>Жалоба</option>
  							<option>Заявление</option>
  						</select>
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>Фамилия:
					</td>
					<td>
						<input name="surname" type="text" required placeholder="Введите Вашу фамилию" />
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>Имя:
					</td>
					<td>
						<input name="name" type="text" required placeholder="Введите Ваше имя" />
					</td>
				</tr>
				<tr>
					<td>
						Отчество:
					</td>
					<td>
						<input name="patronymic" type="text" placeholder="Введите Ваше отчество" />
					</td>
				</tr>
				<tr>
					<td>
						Наименование организации (юридического лица):
					</td>
					<td>
						<input name="name_of_company" type="text" placeholder="Введите наименование Вашей организации" />
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>e-mail
					</td>
					<td>
						<input name="email" type="email" required placeholder="Введите адрес Вашей электронной почты" />
					</td>
				</tr>
				<tr>
					<td>
						Контактный телефон:
					</td>
					<td>
						<input name="phone_number" type="tel" placeholder="Введите Ваш контактный телефон" />
					</td>
				</tr>
				<tr>
					<td>
						Соавтор(ы):
					</td>
					<td>
						<input id="addCollaboratorButton" type="button" value="Добавить" onclick="addCollaborators()" />
						<input type="number" value=0 hidden id="countCollaborators" name="countCollaborators" />
					</td>
				</tr>
				</table>
				
				<table class="table">
				<tr>
					<td>
						<span style="color: red;">*</span>Текст обращения:
					</td>
					<td>
						<textarea name="text_of_appeal" placeholder="Введите текст обращения" required ></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>Прошу прислать мне ответ
					</td>
					<td>
						<input name="checkbox_email" type="checkbox" checked required id="checkbox_email" /> 
							<label for="checkbox_email">по электронной почте </label><br>						
						<input name="checkbox_take_it_personally" type="checkbox" id="checkbox_take_it_personally" />
							<label for="checkbox_take_it_personally">заберу лично</label><br>
						<input id="checkBoxMail" name="checkbox_mail" type="checkbox" onchange="visibleMailInput()" />
							<label for="checkBoxMail">на мой почтовый адрес</label><br>
						<input id="mail" name="mail" type="text" placeholder="Введите свой почтовый адрес" disabled required /><br>
					</td>
				</tr>
				<tr>
					<td>
						Прикрепить файл:
					</td>
					<td style="font-size: 10px;">
						<input name="file" type="file" id="file" /><br>
						Максимальный размер файла: 5 МБ.<br>
						Допустимые типы файлов: pdf, doc, docx, jpeg, jpg, zip, rar.
					</td>
				</tr>
				<tr>
					<td>
						<span style="color: red;">*</span>Математический пример:
					</td>
					<td>
						<span id="math0"></span>
						<input  type="number" id="captcha"  required  oninvalid="this.setCustomValidity('Введите правильное значение')" oninput="check(this)" placeholder="Введите верный ответ" />
					</td>
				</tr>
				<tr>
					<td colspan="2" >
						<input type="checkbox"  required id="accept" />
							<label for="accept">Я даю согласие на обработку моих персональных данных в соответствии с «Политикой обработки персональных данных организации».</label>
					</td>
				</tr>			
			</table>
			<div class="buttonSubmit">
				<input id="buttonSubmit" type="submit" value="Отправить"  />
			</div>
		</form>
</div>
	</body>
	<script type="text/javascript" >
		//global var	
		var collaboratorNumber = 0;
		var a = -1;
		var b = -1;

//		проверка ввода математического примера		
		function check(element) {
/*			console.log("a=: "+a);
			console.log("b=: "+b);*/
			if(element.value == a+b) {
				element.setCustomValidity('');
			}
			else {
				element.setCustomValidity('Введите правильное значение');
			} 
		}
		
//		добавление соавторов
		function addCollaborator(td1Text, td2Name, required, inputType){
			var tbody = document.getElementById('table').getElementsByTagName("TBODY")[0];
			var tr1 = document.createElement("TR")
			var td1 = document.createElement("TD")
			td1.appendChild(document.createTextNode(td1Text))
			var td2 = document.createElement("TD")
			if(td2Name != null){
				var input = document.createElement("input");
				input.setAttribute('type', inputType);
				input.setAttribute('name', td2Name);
				if (required)
					input.setAttribute('required', '');	
				td2.appendChild (input);
			}
			tr1.appendChild(td1);
			tr1.appendChild(td2);
			tbody.appendChild(tr1);
		}
//		добавление соавторов
		function addCollaborators(){
			if(collaboratorNumber > 4)
			{
				addCollaboratorButton.setAttribute("disabled", "");
				return;
			}
			addCollaborator(collaboratorNumber+1+'.', 	null, true, "text");
			addCollaborator('*Фамилия:', 	'surname'+collaboratorNumber, true, "text");
			addCollaborator('*Имя:', 		'name'+collaboratorNumber, true, "text");
			addCollaborator('Отчество:',  'patronymic'+collaboratorNumber, false, "text");
			addCollaborator('*e-mail:', 	'email'+collaboratorNumber, true, "email");
			collaboratorNumber = collaboratorNumber+1;
			
			countCollaborators.setAttribute('value', collaboratorNumber);
		}
	
//		генерация математического примера	
		var a = Math.round(Math.random() * (10 - 0) + 0);
		var b = Math.round(Math.random() * (10 - 0) + 0);
		document.getElementById("math0").innerHTML = String(a) + "+" + String(b) + "=";
		
//		очистка поля математического примера
		captcha.value = "";
		
//проверка загружемого файла
		file.addEventListener("change", function(event) {
	    	var i = 0,
	      	files = file.files;
	        	len = files.length;	 
	    	for (; i < len; i++) {
	//      	console.log("Filename: " + files[i].name);
	//       console.log("Type: " + files[i].type);
	        	if (files[i].size > 5242880) {
	        		console.log("Size: " + files[i].size + " bytes");
	        		alert("Недопустимый размер загружаемого файла!");
	        		file.value = "";    
	        		return;    		
	        	}
	        	
				f = files[i].name.split('.'); 
				var ext = f[f.length-1];
	    		
	    		if(ext == "pdf" || ext == "doc" || ext == "docx" || ext == "jpeg" || ext == "jpg" || ext == "zip" || ext == "rar")
	    		{
	    			console.log("Type: " + files[i].type);
	    		}
	    		else {
	    			alert(ext+" - неподдерживаемый формат файла!");
	        		file.value = "";    
	        		return; 
	    		}
	    	}
		}, false);
		
//		показать или скрыть поле для вода почтового адрса
		function visibleMailInput() {
			if (checkBoxMail.checked) {
				mail.removeAttribute("disabled");
			}
			else {
				mail.setAttribute("disabled", "");
			}
		}	

//отключение кнопки поиска после однократного нажатия, чтобы исключить многократное отправление писем		
		function disableButtonOnClick(id)
		{
			var elem = document.getElementById(id);
			if(search.value > -1 ){
				elem.setAttribute("disabled", "");
				elem.setAttribute("value", "Подождите ...");
				return true;
			}
			return false;
		}
//		
/*		var our_string = window.navigator.userAgent;
		if(our_string.indexOf('MSIE') + 1){
			window.location.href = 'cap.html';
		}*/
	</script>
</html>
