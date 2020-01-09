-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 09 2020 г., 17:46
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_inserted_data` (IN `client_name` VARCHAR(100) CHARSET utf8mb4, IN `client_email` VARCHAR(100) CHARSET utf8mb4, IN `client_message` VARCHAR(4000) CHARSET utf8mb4, IN `client_date` DATE, OUT `correct_data` JSON)  BEGIN
	DECLARE correct_client_name BOOLEAN DEFAULT false;
    DECLARE correct_client_email BOOLEAN DEFAULT false;

	IF client_name REGEXP ('^[A-zА-я-]+\\s[A-zА-я-]+\\s[A-zА-я-]+$') THEN		
        SET correct_client_name = true;
    ELSE
		SET correct_client_name = false;
    END IF;
    
    IF client_email REGEXP '^[A-z0-9_-]+@[A-z0-9_-]+.[A-z]{2,4}$' THEN
    	SET correct_client_email = true;
    ELSE
    	SET correct_client_email = false;
    END IF;     
    
   SELECT JSON_MERGE(
       JSON_OBJECT('correctClientName', correct_client_name),
       JSON_OBJECT('correctClientEmail', correct_client_email)
    ) INTO correct_data;
    
    IF correct_client_name && correct_client_email THEN
    	INSERT INTO test_db.messages(name, email, message, date) VALUES (client_name, client_email, client_message, client_date);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(4000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
