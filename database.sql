-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2020 г., 00:13
-- Версия сервера: 10.3.13-MariaDB
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
-- База данных: `marlin_2020`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `permissions` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standart user', ''),
(2, 'Administrator', '{\"admin\":1}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 1,
  `time` date NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `group_id`, `time`, `status`) VALUES
(54, 'robot@mail.ru', 'Robot', '$2y$10$j7AHr2iEUz3YRCVIU/swVurFD9RZ2NG8ZJe82rzxPOedc/s/Z2wHa', 1, '2020-04-24', 'password: robot'),
(55, 'newuser@co.com', 'DiCaprio', '$2y$10$vPlhY6qqteMMzi.7U5QTVe1rzy.TA8yJA/qSxcEkufEeOrAaXyc.C', 1, '2020-04-24', 'Leonardo'),
(56, 'batman@bat.com', 'Batman', '$2y$10$OG0Y3ubwsP5GXt8kngk1sOpL5Z5jwO07ZR2KihUzqLJtpKQaMER9u', 1, '2020-04-24', 'password: admin'),
(57, 'Hulk@hulk.com', 'Hulk', '$2y$10$jAB200YSJOUOJi4EQ3DDbeAt1zZJEIto0nGlTw0/nqShXGoAMEnBK', 1, '2020-04-24', 'зеленый, пароль  не помню'),
(59, 'dsd@ww.co', 'Jean-Claude', '$2y$10$YIl9GailJedlQKjYx3RvfOmd2W4TSNDT09JjSudDxp/dGINrrvGQa', 1, '2020-04-24', 'status — состояние дел, состояние, положение'),
(60, 'donald@tramp.co', 'Donald', '$2y$10$rEucZVsoPKmbb8PtvjCPeetrrQIsG4Xa0.p.7vlcQT0ogDQzYUiIW', 2, '2020-04-24', 'прэзидент! и теперь админ'),
(61, 'XiJinping@mail.ru', 'XiJinping', '$2y$10$yiu.MPjYy.ooymC/./b6n.hoPWkQWgk6fSYpHCgy4SV6JBAZdFGPS', 1, '2020-04-25', 'прэзидент, пароль: XiJinping'),
(62, 'admin@admin.com', 'admin', '$2y$10$jVpKf6ncnu3ILXFQ4kOtDuGN4nB3kFmRIisJmyJVb3tG.CXEkLtIO', 2, '2020-04-25', 'password: admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `hash`) VALUES
(14, 33, 'ddd5a02699143f4d8c663a1ea88cd6df198b457d3ddf15102003602a73db0ecc'),
(17, 32, 'ebd4599605a85c4e0370d925de317027477b3f60fba6840eae1cbc08ef379a2f'),
(21, 48, '95a975935a3865ac8916579a60dac88a3619e4e018a4f27740ae964fd56befa1'),
(30, 54, '1b3d77e6a52e148373ba5314479b4bdaca3cb58a4ed9a2fb92dacbc6eaf8f220'),
(38, 62, '53d6e81f9f72007df07fffee083fabed71f8f8d3da90278ed4ce9e77a7033314');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
