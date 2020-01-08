-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 31 2019 г., 13:50
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_db`
--
CREATE DATABASE IF NOT EXISTS `test_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_db`;

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_inserted_data` (IN `client_name` VARCHAR(100) CHARSET utf8mb4, IN `client_email` VARCHAR(100) CHARSET utf8mb4, IN `client_message` VARCHAR(4000) CHARSET utf8mb4, IN `client_date` DATE, OUT `correct_data` BOOLEAN)  BEGIN
	IF client_name REGEXP ('^[A-zА-я]+\s[A-zА-я]+\s[A-zА-я]+$') && client_email REGEXP '^[A-z0-9_-]+@[A-z0-9_-]+.[A-z]{2,4}$' THEN
		INSERT INTO test_db.messages(name, email, message, date) values (client_name, client_email, client_message, client_date);
        SET correct_data = true;
    ELSE
		SET correct_data = false;
    END IF;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(4000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
