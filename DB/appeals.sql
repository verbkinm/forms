-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 02 2019 г., 12:14
-- Версия сервера: 5.6.44
-- Версия PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `appeals`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appeals`
--

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL,
  `for_whom` varchar(50) DEFAULT NULL,
  `employee` varchar(50) DEFAULT NULL,
  `form_of_appeal` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `patronymic` varchar(50) DEFAULT NULL,
  `name_of_company` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `text_of_appeal` text,
  `checkbox_email` varchar(5) DEFAULT 'on',
  `checkbox_take_it_personally` varchar(5) NOT NULL DEFAULT 'off',
  `checkbox_mail` varchar(5) NOT NULL DEFAULT 'off',
  `mail` varchar(100) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'В обработке'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appeals`
--

INSERT INTO `appeals` (`id`, `for_whom`, `employee`, `form_of_appeal`, `date`, `time`, `surname`, `name`, `patronymic`, `name_of_company`, `email`, `phone_number`, `text_of_appeal`, `checkbox_email`, `checkbox_take_it_personally`, `checkbox_mail`, `mail`, `file_name`, `url`, `status`) VALUES
(137, 'Руководителю организации', 'Директор', 'Жалоба', '2018-12-25', '14:18:19', 'Вербкин', 'Михаил', 'Сергеевич', 'Лицей', 'verbkinm@yandex.ru', '+55555', 'пств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпрпств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпрпств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпрпств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпрпств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпрпств ап\r\n\r\nапр\r\n\r\nап ываыва\r\n\r\nра\r\n\r\nпр', 'on', 'on', 'on', 'дом', 'uploads/20c9d7c11a420b631391c796209ca8a1/®ªã¬¥­â Microsoft Word.docx', '65e09f2ed1bff38655aba48b17dde8d6', 'Отклонено'),
(138, 'Любому должностному лицу', 'ФИО', 'Предложение', '2019-01-24', '15:03:46', 'Вербкин', 'Михаил', '', '', 'verbkinm@ya.ru', '', 'fhfgh', 'on', '', '', '', '', 'fddd1181edff07d9b0dbf91a65758f46', 'Отклонено'),
(139, 'Любому должностному лицу', 'кому угодно', 'Предложение', '2019-01-25', '11:44:38', 'Вербкин', 'Михаил', '', '', 'verbkinm@ya.ru', '', 'тест', 'on', '', '', '', 'uploads/f100466ec94de874ed0e87b14c70d0f9/hi-tech-technology-processor.jpg', 'ca00c1fde2b324dc7757eb12fc46d297', 'Отклонено');

-- --------------------------------------------------------

--
-- Структура таблицы `collaborators`
--

CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL,
  `appeals_id` int(11) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `patronymic` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `collaborators`
--

INSERT INTO `collaborators` (`id`, `appeals_id`, `surname`, `name`, `patronymic`, `email`) VALUES
(66, 137, 'Вербкин1', 'Михаил1', '', 'verbkinm@gmail'),
(67, 137, 'Булшаков', 'Евгений', 'Батькович', 'verbkinm@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `appeals_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `appeals_id`, `date`, `time`, `status`, `author`, `answer`) VALUES
(63, 137, '2018-12-25', '14:27:05', 'В обработке', '87', 'я думаю!\r\n !\r\n...'),
(64, 137, '2018-12-25', '15:01:12', 'Отклонено', '2', '!!!!!'),
(65, 137, '2018-12-25', '15:01:35', 'Дан ответ отправителю', 'Администратор', ''),
(66, 137, '2019-01-09', '09:01:19', 'Отклонено', 'Секретарь', 'дтит оыолдчмсыосмлд\r\nл\r\nхана'),
(67, 138, '2019-01-24', '15:05:07', 'Отклонено', 'Секретарь', '!!!'),
(68, 138, '2019-01-25', '10:45:48', 'Дан ответ отправителю', 'Приёмная', ''),
(69, 139, '2019-01-26', '09:03:40', 'Дан ответ отправителю', 'Администратор', ''),
(70, 139, '2019-03-13', '09:18:05', 'Отклонено', 'Администратор', ''),
(71, 138, '2019-03-13', '09:18:17', 'Отклонено', 'Администратор', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appeals`
--
ALTER TABLE `appeals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Индексы таблицы `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT для таблицы `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT для таблицы `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
