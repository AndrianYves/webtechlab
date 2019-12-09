-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2019 at 01:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super','admin') NOT NULL,
  `status` enum('Enabled','Disabled') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role`, `status`) VALUES
(1, 'super', 'super', 'super', 'super@gmail.com', '$2y$10$CFqhsh2HbQYMzFvIHwY2/e7vn1P7l9ghbbc4Wy/kYnobLV3VnXfx6', 'super', 'Enabled'),
(2, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$CFqhsh2HbQYMzFvIHwY2/e7vn1P7l9ghbbc4Wy/kYnobLV3VnXfx6', 'admin', 'Enabled'),
(3, 'super1super1', 'super1', 'super1', 'super1@gmail.com', '$2y$10$zg1nFxCdNZ1.MK2hiisyiOcVgs8GjvmRfG/NzxsbKkWa2S0KbMGVG', 'super', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `date`, `image`, `status`) VALUES
(1, 'Water', '2019-01-10', 'about_img.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `maincontent`
--

DROP TABLE IF EXISTS `maincontent`;
CREATE TABLE IF NOT EXISTS `maincontent` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `maincontent`
--

INSERT INTO `maincontent` (`id`, `title`, `content`) VALUES
(1, '123', '312');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswers`
--

DROP TABLE IF EXISTS `pollanswers`;
CREATE TABLE IF NOT EXISTS `pollanswers` (
  `questionID` int(255) NOT NULL,
  `choiceID` int(25) NOT NULL,
  `userID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `pollchoices`
--

DROP TABLE IF EXISTS `pollchoices`;
CREATE TABLE IF NOT EXISTS `pollchoices` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `choice` varchar(255) NOT NULL,
  `questionID` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `pollquestion`
--

DROP TABLE IF EXISTS `pollquestion`;
CREATE TABLE IF NOT EXISTS `pollquestion` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`, `status`) VALUES
(1, 'fire', 'fire', '2019-1-20', 'Active'),
(2, 'Water', 'Water', '2019-12-20', 'Inactive'),
(3, 'Hello', 'World', '2019-12-11', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `idnumber` int(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Rejected','Accepted') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idnumber` (`idnumber`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `idnumber`, `course`, `year`, `email`, `password`, `status`) VALUES
(1, 'firstname', 'lastname', 123, 'BSIT', 4, '123@gmail.com', '$2y$10$CFqhsh2HbQYMzFvIHwY2/e7vn1P7l9ghbbc4Wy/kYnobLV3VnXfx6', 'Accepted'),
(5, '321', '321', 321, '312', 321, '321@gmail.com', '$2y$10$cacZR04HWIQufxbqM7PYjO78o1VR2nJhAnwzJjm4QbsyIia5bXq1y', 'Accepted');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
