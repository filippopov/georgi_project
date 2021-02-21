-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия на сървъра:            10.4.13-MariaDB - mariadb.org binary distribution
-- ОС на сървъра:                Win64
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дъмп на структурата на БД georgi_project
DROP DATABASE IF EXISTS `georgi_project`;
CREATE DATABASE IF NOT EXISTS `georgi_project` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `georgi_project`;

-- Дъмп структура за таблица georgi_project.business_token
DROP TABLE IF EXISTS `business_token`;
CREATE TABLE IF NOT EXISTS `business_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_user_id` int(11) NOT NULL,
  `client_user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица georgi_project.business_token: ~2 rows (приблизително)
DELETE FROM `business_token`;
/*!40000 ALTER TABLE `business_token` DISABLE KEYS */;
INSERT INTO `business_token` (`id`, `business_user_id`, `client_user_id`, `time`, `token`, `active`) VALUES
	(1, 10, 11, '2021-02-20 20:43:24', '$2y$10$Bs3O2EdNU24qITfKQMQF6e6Eoz.xfq1qft.SoNERLOsLkroIUUsIS', 'No'),
	(9, 10, 12, '2021-02-20 21:01:16', '$2y$10$jREiuqNUKc09MEXCtBJiVOt3nqMaxe2pDH7KNQT0zoQch7De3XYoS', 'No'),
	(10, 10, 12, '2021-02-21 10:10:15', '$2y$10$a7GFgYlO8dAKsq9CQAKTiOItLwF/8dcA8sgdxC.kBDl7NjEQkQs6O', 'No');
/*!40000 ALTER TABLE `business_token` ENABLE KEYS */;

-- Дъмп структура за таблица georgi_project.coments
DROP TABLE IF EXISTS `coments`;
CREATE TABLE IF NOT EXISTS `coments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` tinyint(4) NOT NULL DEFAULT 1,
  `client_user_id` int(11) NOT NULL,
  `business_user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица georgi_project.coments: ~0 rows (приблизително)
DELETE FROM `coments`;
/*!40000 ALTER TABLE `coments` DISABLE KEYS */;
INSERT INTO `coments` (`id`, `rating`, `client_user_id`, `business_user_id`, `token`) VALUES
	(1, 5, 11, 10, '$2y$10$Bs3O2EdNU24qITfKQMQF6e6Eoz.xfq1qft.SoNERLOsLkroIUUsIS'),
	(2, 1, 11, 10, '$2y$10$Bs3O2EdNU24qITfKQMQF6e6Eoz.xfq1qft.SoNERLOsLkroIUUsIS'),
	(3, 3, 12, 10, '$2y$10$jREiuqNUKc09MEXCtBJiVOt3nqMaxe2pDH7KNQT0zoQch7De3XYoS'),
	(4, 4, 12, 10, '$2y$10$a7GFgYlO8dAKsq9CQAKTiOItLwF/8dcA8sgdxC.kBDl7NjEQkQs6O');
/*!40000 ALTER TABLE `coments` ENABLE KEYS */;

-- Дъмп структура за таблица georgi_project.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица georgi_project.roles: ~2 rows (приблизително)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'business'),
	(2, 'client');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дъмп структура за таблица georgi_project.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица georgi_project.users: ~2 rows (приблизително)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
	(10, 'business', '$2y$10$EvC8/8rpzkRVsqx89oglnuI4bVhhVKpyfdL1wQuwp3kyZo70Rtfou', 1),
	(11, 'client', '$2y$10$EvC8/8rpzkRVsqx89oglnuI4bVhhVKpyfdL1wQuwp3kyZo70Rtfou', 2),
	(12, 'client2', '$2y$10$jHC5s6GVzOrFy3ys5lhf5uKrp5mBeXESWbXbmVc/CMFrYj2GWcuzu', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
