-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 25 2018 г., 15:16
-- Версия сервера: 5.6.41
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forms.test`
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
(1, 'admin', '$2y$10$zo/seK8RIsc4Moz7cDFmUuh3nQnHdxxrCc90krR.Y.CVgxYztPcQ.', 'Администратор', 0, '0', '2018-12-13', '12:20:18', '2018-12-25 15:08:43', '192.168.3.13');

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
-- Дамп данных таблицы `eatery`
--


-- --------------------------------------------------------

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
-- Дамп данных таблицы `eatery_user_data`
--

INSERT INTO `eatery_user_data` (`id`, `user_id`, `count`, `count_lg`, `names_lg`) VALUES
(1, 1, 0, 0, NULL);

-- --------------------------------------------------------

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
-- Дамп данных таблицы `medic`
--


-- --------------------------------------------------------

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
-- Дамп данных таблицы `medic_user_data`
--

INSERT INTO `medic_user_data` (`id`, `user_id`, `count`, `number_of_patients`, `patients_primary`) VALUES
(1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `missing`
--

CREATE TABLE `missing` (
  `id` int(11) NOT NULL,
  `class` int(2) NOT NULL,
  `class_name` varchar(1) NOT NULL,
  `count` int(100) DEFAULT NULL,
  `number_of_patients` text,
  `not_a_good_reason` text,
  `accepted_measure` text,
  `user_name` varchar(65) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `role`) VALUES
(1, 1, 'admin');

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
-- Индексы таблицы `missing`
--
ALTER TABLE `missing`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `eatery`
--
ALTER TABLE `eatery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `eatery_user_data`
--
ALTER TABLE `eatery_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `medic`
--
ALTER TABLE `medic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `medic_user_data`
--
ALTER TABLE `medic_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `missing`
--
ALTER TABLE `missing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
