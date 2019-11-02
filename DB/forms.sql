-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 02 2019 г., 12:36
-- Версия сервера: 5.7.27-log
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
-- База данных: `forms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `login` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `class` int(2) DEFAULT NULL,
  `class_name` varchar(1) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_ip` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auth`
--

INSERT INTO `auth` (`id`, `login`, `password`, `user_name`, `class`, `class_name`, `date`, `time`, `last_login`, `login_ip`) VALUES
(15, 'admin', '$2y$10$CfswB90VKMQ.pBtuQnvzBOGTgSzPxiqW346aGQeZP3TVXmW3nR8XS', 'Администратор', 0, '0', '2018-05-12', '08:50:12', '2019-11-02 11:31:53', '192.168.100.253');

-- --------------------------------------------------------

--
-- Структура таблицы `eatery`
--

CREATE TABLE `eatery` (
  `id` int(11) NOT NULL,
  `class` int(2) DEFAULT NULL,
  `class_name` varchar(2) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `count_lg` int(11) DEFAULT NULL,
  `user_name` varchar(65) DEFAULT NULL,
  `names_lg` text NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `eatery_user_data`
--

CREATE TABLE `eatery_user_data` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `count` int(100) DEFAULT '0',
  `count_lg` int(100) DEFAULT '0',
  `names_lg` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Структура таблицы `medic`
--

CREATE TABLE `medic` (
  `id` int(11) NOT NULL,
  `class` int(2) NOT NULL,
  `class_name` varchar(2) NOT NULL,
  `count` int(11) NOT NULL,
  `number_of_patients` int(11) NOT NULL,
  `patients_primary` int(11) NOT NULL,
  `user_name` varchar(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `medic_user_data`
--

CREATE TABLE `medic_user_data` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `count` int(100) DEFAULT '0',
  `number_of_patients` int(100) DEFAULT '0',
  `patients_primary` int(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `passes`
--

CREATE TABLE `passes` (
  `id` int(11) NOT NULL,
  `class` int(2) NOT NULL,
  `class_name` varchar(1) NOT NULL,
  `user_name` varchar(65) NOT NULL,
  `week_number` int(2) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `passes_application`
--

CREATE TABLE `passes_application` (
  `id` int(11) NOT NULL,
  `passes_id` int(11) NOT NULL,
  `student_name` varchar(65) DEFAULT NULL,
  `absence_due_to_illness` int(2) NOT NULL DEFAULT '0',
  `absence_for_a_good_reason` int(2) NOT NULL DEFAULT '0',
  `absence_of_a_valid_reason` int(2) NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `eatery`
--
ALTER TABLE `eatery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `eatery_user_data`
--
ALTER TABLE `eatery_user_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `medic`
--
ALTER TABLE `medic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `medic_user_data`
--
ALTER TABLE `medic_user_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `passes`
--
ALTER TABLE `passes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `passes_application`
--
ALTER TABLE `passes_application`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `eatery`
--
ALTER TABLE `eatery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `eatery_user_data`
--
ALTER TABLE `eatery_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `medic`
--
ALTER TABLE `medic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `medic_user_data`
--
ALTER TABLE `medic_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `passes`
--
ALTER TABLE `passes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `passes_application`
--
ALTER TABLE `passes_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
