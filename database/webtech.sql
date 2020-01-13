-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2020 at 06:21 PM
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
-- Table structure for table `aboutus`
--

DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE IF NOT EXISTS `aboutus` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `title`, `content`, `timestamp`) VALUES
(3, 'title', 'content', '2020-01-06 03:08:20.000000'),
(5, 'new', 'new', '2020-01-06 03:08:29.000000');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role`, `status`) VALUES
(1, 'super', 'super', 'super', 'super@gmail.com', '$2y$10$CFqhsh2HbQYMzFvIHwY2/e7vn1P7l9ghbbc4Wy/kYnobLV3VnXfx6', 'super', 'Enabled'),
(2, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$CFqhsh2HbQYMzFvIHwY2/e7vn1P7l9ghbbc4Wy/kYnobLV3VnXfx6', 'admin', 'Enabled'),
(3, 'super1super1', 'super1', 'super1', 'super1@gmail.com', '$2y$10$zg1nFxCdNZ1.MK2hiisyiOcVgs8GjvmRfG/NzxsbKkWa2S0KbMGVG', 'super', 'Enabled'),
(4, 'asd', 'asd', 'asd', 'andrianyvesmacalino@gmail.com', '$2y$10$zS0myBK6wmwFzSP/dZ7Lv.i.YgKBdnJ4W8UIy6d8jp27gqzMobIaS', 'super', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `deadline`, `status`) VALUES
(1, 'Basketball', 'Basketball', '2020-01-01', 'Inactive'),
(2, 'chess', 'chess', '2020-01-31', 'Active'),
(3, 'quizbee', 'quizbee', '2020-01-31', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `activityinvitation`
--

DROP TABLE IF EXISTS `activityinvitation`;
CREATE TABLE IF NOT EXISTS `activityinvitation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `activityID` int(255) NOT NULL,
  `choice` enum('Joining','Not Joining','Cancelled') DEFAULT NULL,
  `userID` int(255) NOT NULL,
  `status` enum('Accepted','Rejected') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `activityinvitation`
--

INSERT INTO `activityinvitation` (`id`, `activityID`, `choice`, `userID`, `status`) VALUES
(1, 1, 'Joining', 1, 'Accepted'),
(2, 1, NULL, 2, NULL),
(3, 2, 'Joining', 1, 'Accepted'),
(4, 2, 'Joining', 2, NULL),
(5, 3, 'Joining', 1, 'Rejected'),
(6, 3, 'Not Joining', 2, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

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
(1, 'dsds', 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswers`
--

DROP TABLE IF EXISTS `pollanswers`;
CREATE TABLE IF NOT EXISTS `pollanswers` (
  `questionID` int(255) DEFAULT NULL,
  `choiceID` int(25) DEFAULT NULL,
  `userID` int(255) DEFAULT NULL,
  UNIQUE KEY `questionID` (`questionID`,`userID`) USING BTREE
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `choice` (`choice`,`questionID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `pollchoices`
--

INSERT INTO `pollchoices` (`id`, `choice`, `questionID`) VALUES
(1, '34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pollquestion`
--

DROP TABLE IF EXISTS `pollquestion`;
CREATE TABLE IF NOT EXISTS `pollquestion` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `endofdate` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `pollquestion`
--

INSERT INTO `pollquestion` (`id`, `question`, `endofdate`, `status`) VALUES
(1, 'age?', '2020-01-14', 'Active'),
(2, '23', '2020-01-16', 'Active');

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
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`, `status`, `image`) VALUES
(1, 'Welcome', 'Hi', '2020-01-01', 'Active', ''),
(2, 'low', 'low', '2020-01-01', 'Active', ''),
(3, 'hello', 'hello', '2020-01-08', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `semesterdate`
--

DROP TABLE IF EXISTS `semesterdate`;
CREATE TABLE IF NOT EXISTS `semesterdate` (
  `id` int(255) NOT NULL,
  `semesterstart` varchar(255) NOT NULL,
  `semesterend` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `semesterdate`
--

INSERT INTO `semesterdate` (`id`, `semesterstart`, `semesterend`) VALUES
(1, '2019-09-01', '2020-01-31');

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
  `status` enum('Rejected','Accepted','Renewing') DEFAULT NULL,
  `image` text,
  `endofsem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idnumber` (`idnumber`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `idnumber`, `course`, `year`, `email`, `password`, `status`, `image`, `endofsem`) VALUES
(1, '123', '123', 2222222, '123', 3, '2222222@gmail.com', '$2y$10$i2uOb6Db6op5z8OTc9xQDu14rCER/IUHB3Qh91VkEpwsSN7Ax3kWq', 'Accepted', NULL, '2020-01-31'),
(2, '21', '312', 1111111, '321', 3, '111@gmail.com', '$2y$10$LQP.wuy1ZPbGslGRawOFMOZ0hmxTL8LcspvEWZ1vjDVTCvu0/thJS', 'Accepted', NULL, '2020-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `visionmission`
--

DROP TABLE IF EXISTS `visionmission`;
CREATE TABLE IF NOT EXISTS `visionmission` (
  `vision` text NOT NULL,
  `mission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `visionmission`
--

INSERT INTO `visionmission` (`vision`, `mission`) VALUES
('vision content', 'mission content');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
