-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2019 at 11:58 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical-screener`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

DROP TABLE IF EXISTS `survey_answers`;
CREATE TABLE IF NOT EXISTS `survey_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `answers` text NOT NULL,
  `inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Index Columns` (`user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_answers`
--

INSERT INTO `survey_answers` (`id`, `user`, `answers`, `inserted`) VALUES
(1, 'guest', '{\"answer-1\":\"1\",\"question-1\":\"Do you suffer from back problems?\",\"answer-2\":\"1\",\"question-2\":\"Are you on any medication?\",\"answer-3\":\"1\",\"question-3\":\"Are you on any medication?\",\"answer-4\":\"1\",\"question-4\":\"Have you been checked for high blood pressure?\",\"answer-5\":\"2\",\"question-5\":\"How many times do you exercise a week?\"}', '2019-03-11 21:47:14'),
(3, '2', '{\"answer-1\":\"1\",\"question-1\":\"Do you suffer from back problems?\",\"answer-2\":\"1\",\"question-2\":\"Are you on any medication?\",\"answer-3\":\"1\",\"question-3\":\"Are you on any medication?\",\"answer-4\":\"1\",\"question-4\":\"Have you been checked for high blood pressure?\",\"answer-5\":\"2\",\"question-5\":\"How many times do you exercise a week?\"}', '2019-03-11 22:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` text NOT NULL,
  `salt` text NOT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Index Columns` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `forename`, `surname`, `email`, `hash`, `salt`, `height`, `weight`, `age`, `address`, `city`, `postcode`, `active`, `created`) VALUES
(2, 'Christopher', 'Beckett', 'chrisbeckett13@yahoo.co.uk', '$2y$12$t6actDtxj623l0f2mYx.IOaJlaY.7ZwlD6EjNDecLbToj4p5cAY.a', '94284613717422', '6ft 1', '45 pounds', 24, '12 Guernsey Close', 'Warrington', 'WA4 3AZ', 1, '2019-03-10 22:32:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
