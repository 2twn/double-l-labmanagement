-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生日期: 2013 年 11 月 22 日 14:02
-- 伺服器版本: 5.5.32
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `lab`
--
CREATE DATABASE IF NOT EXISTS `lab` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lab`;

-- --------------------------------------------------------

--
-- 表的結構 `department`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(45) NOT NULL,
  `valid` char(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `department`
--

INSERT INTO `departments` (`id`, `dep_name`, `valid`, `create_time`, `modi_time`) VALUES
(1, 'HQ', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- 表的結構 `meeting_room`
--

CREATE TABLE IF NOT EXISTS `meeting_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mr_name` varchar(45) NOT NULL,
  `mr_capacity` int(11) NOT NULL,
  `mr_desc` varchar(255) DEFAULT NULL,
  `valid` char(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `project`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` varchar(20) NOT NULL,
  `prj_name` varchar(50) NOT NULL,
  `prj_desc` varchar(255) NOT NULL,
  `valid` char(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `user`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `valid` char(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ1` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `user`
--

INSERT INTO `users` (`id`, `department_id`, `email`, `name`, `username`,`valid`,`create_time`, `modi_time`) VALUES
(1, 1, 'admin@mail.com', 'Administrator', 'admin', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


DROP TABLE IF EXISTS `equip_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `equip_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_id` varchar(8) NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_start_time` datetime NOT NULL,
  `book_end_time` datetime NOT NULL,
  `booking_desc` varchar(255) DEFAULT NULL,
  `valid` char(1) NOT NULL DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `modi_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equip_maintains`
--

DROP TABLE IF EXISTS `equip_maintains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equip_maintains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_id` varchar(8) NOT NULL,
  `maintain_time` datetime NOT NULL,
  `maintain_result` varchar(255) DEFAULT NULL,
  `maintain_status` char(1) NOT NULL DEFAULT 'N',
  `create_time` datetime NOT NULL,
  `modi_time` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equips`
--

DROP TABLE IF EXISTS `equips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equips` (
  `id` varchar(8) NOT NULL,
  `equip_name` varchar(30) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  `equip_desc` varchar(45) DEFAULT NULL,
  `maintain_time` date NOT NULL,
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
