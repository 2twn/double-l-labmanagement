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
  `dep_code` varchar(50) NOT NULL,
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
  `group_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- 資料表格式： `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `control` varchar(30) NOT NULL,
  `action` varchar(50) NOT NULL,
  `view_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 列出以下資料庫的數據： `menus`
--

INSERT INTO `menus` (`id`, `catalog`, `name`, `control`, `action`, `view_order`) VALUES
(1, '儀器管理', '儀器列表', 'equipments', 'equip_list', 1000),
(2, '儀器管理', '儀器預約', 'equipments', 'equip_booking_action', 1001),
(3, '儀器管理', '儀器預約列表', 'equipments', 'equip_book_list', 1002),
(4, '儀器管理', '儀器預約紀錄查詢', 'equipments', 'equip_booking_table', 1003),
(5, '安定性樣品', '樣品列表', 'safetytrials', 'index', 2000),
(6, '安定性樣品', '檢核時間點查詢', 'safetytrials', 'checkdate_report', 2001),
(7, '教育訓練管理', '文件列表', 'training', 'document_list', 3000),
(8, '教育訓練管理', '文件列表', 'training', 'training_list', 3001),
(9, '試藥管理', '製造商資訊管理', 'reagents', 'company_list', 4000),
(10, '試藥管理', '化學名稱管理', 'reagents', 'chemical_list', 4001),
(11, '試藥管理', '等級管理', 'reagents', 'level_list', 4002),
(12, '試藥管理', '試藥資訊管理', 'reagents', 'reagent_list', 4003),
(13, '試藥管理', '試藥儲存位置管理', 'reagents', 'location_list', 4004),
(14, '試藥管理', '試藥登錄', 'reagents', 'record_list', 4005),
(15, '試藥管理', '試藥查詢', 'reagents', 'record_query', 4006),
(16, '組織管理', '部門資訊', 'users', 'dep_list', 5000),
(17, '組織管理', '員工資訊', 'users', 'user_list', 5001),
(18, '組織管理', '專案資訊', 'projects', 'prj_list', 5002),
(19, '組織管理', '會議室資訊', 'meetingrooms', 'mr_list', 5003),
(20, '組織管理', '角色管理', 'roles', 'index', 5004);

-- --------------------------------------------------------

--
-- 資料表格式： `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `valid` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 列出以下資料庫的數據： `roles`
--

INSERT INTO `roles` (`id`, `name`, `valid`, `create_time`, `modi_time`) VALUES
(1, '管理者', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '使用者', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '儀器管理', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '安定性樣品管理', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '教育訓練管理', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '試藥管理', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表格式： `role_menus`
--

DROP TABLE IF EXISTS `role_menus`;
CREATE TABLE IF NOT EXISTS `role_menus` (
  `id` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------


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
  `valid` char(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 資料表格式： `safety_trials`
--
DROP TABLE IF EXISTS `safety_trials`;
CREATE TABLE IF NOT EXISTS `safety_trials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trial_lot` varchar(20) NOT NULL,
  `trial_name` varchar(20) NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `status` char(1) NOT NULL,
  `check_type` varchar(5) NOT NULL,
  `humiture` varchar(20) NOT NULL COMMENT '溫濕度',
  `remark` varchar(30) NOT NULL COMMENT '說明不超過30',
  `create_time` datetime NOT NULL,
  `mod_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='安定性藥品檢核' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 資料表格式： `safety_trial_checkdates`
--
DROP TABLE IF EXISTS `safety_trial_checkdates`;
CREATE TABLE IF NOT EXISTS `safety_trial_checkdates` (
  `id` varchar(20) NOT NULL,
  `safety_trial_id` int(11) NOT NULL,
  `check_mode` varchar(5) NOT NULL,
  `remind_date` date NOT NULL,
  `check_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- 資料表結構 `training`
--

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `meeting_room_id` int(11) NOT NULL,
  `instructor` varchar(20) NOT NULL,
  `training_desc` varchar(60) DEFAULT NULL,
  `valid` int(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `training_documents`
--

DROP TABLE IF EXISTS `training_documents`;
CREATE TABLE IF NOT EXISTS `training_documents` (
  `id` varchar(8) NOT NULL,
  `document_name` varchar(30) NOT NULL,
  `document_version` int(11) NOT NULL,
  `document_desc` varchar(60) NOT NULL,
  `valid` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `training_users`
--

DROP TABLE IF EXISTS `training_users`;
CREATE TABLE IF NOT EXISTS `training_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin` int(1) NOT NULL DEFAULT '0',
  `valid` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `training_w_documents`
--

DROP TABLE IF EXISTS `training_w_documents`;
CREATE TABLE IF NOT EXISTS `training_w_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `training_document_id` varchar(8) NOT NULL,
  `valid` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表格式： `chemicals`
--
-- 建立: Dec 23, 2013, 10:56 下午
-- 最後更新: Dec 26, 2013, 10:07 下午
--

DROP TABLE IF EXISTS `chemicals`;
CREATE TABLE IF NOT EXISTS `chemicals` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cas` varchar(20) NOT NULL,
  `alias_name1` varchar(50) DEFAULT NULL,
  `alias_name2` varchar(50) DEFAULT NULL,
  `alias_name3` varchar(50) DEFAULT NULL,
  `alias_name4` varchar(50) DEFAULT NULL,
  `memo` varchar(60) NOT NULL,
  `status` int(11) NOT NULL COMMENT '狀態',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表格式： `companies`
--
-- 建立: Dec 25, 2013, 10:48 下午
-- 最後更新: Dec 26, 2013, 10:30 下午
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `memo` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表格式： `reagents`
--
-- 建立: Dec 23, 2013, 11:05 下午
-- 最後更新: Dec 26, 2013, 10:04 下午
--

DROP TABLE IF EXISTS `reagents`;
CREATE TABLE IF NOT EXISTS `reagents` (
  `id` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `reagent_level_id` varchar(20) NOT NULL,
  `memo` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表格式： `reagent_levels`
--
-- 建立: Dec 25, 2013, 10:49 下午
-- 最後更新: Dec 26, 2013, 10:04 下午
--

DROP TABLE IF EXISTS `reagent_levels`;
CREATE TABLE IF NOT EXISTS `reagent_levels` (
  `id` varchar(20) NOT NULL,
  `memo` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表格式： `reagent_locations`
--
-- 建立: Dec 23, 2013, 11:08 下午
-- 最後更新: Dec 26, 2013, 10:29 下午
--

DROP TABLE IF EXISTS `reagent_locations`;
CREATE TABLE IF NOT EXISTS `reagent_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `memo` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 資料表格式： `reagent_records`
--
-- 建立: Dec 23, 2013, 11:18 下午
-- 最後更新: Dec 26, 2013, 11:09 下午
--

DROP TABLE IF EXISTS `reagent_records`;
CREATE TABLE IF NOT EXISTS `reagent_records` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `reagent_location_id` int(11) DEFAULT NULL COMMENT '儲放位置',
  `company_id` int(11) DEFAULT NULL COMMENT '製造商',
  `package` varchar(20) DEFAULT NULL COMMENT '包裝',
  `lot` varchar(20) DEFAULT NULL COMMENT '原廠批號',
  `record_date` date DEFAULT NULL COMMENT '登錄日期',
  `valid_date` date DEFAULT NULL COMMENT '有效日期',
  `open_date` date DEFAULT NULL COMMENT '開封日期',
  `usage` date DEFAULT NULL COMMENT '有效日期',
  `memo` varchar(60) DEFAULT NULL COMMENT '說明',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_logs`
--

CREATE TABLE IF NOT EXISTS `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `log` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------	

ALTER TABLE `projects` CHANGE `id` `prj_code` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `projects` DROP PRIMARY KEY ;
ALTER TABLE `projects` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
ALTER TABLE `projects` ADD UNIQUE (`prj_code`);

ALTER TABLE `equips` CHANGE `id` `equip_code` VARCHAR( 8 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `equips` DROP PRIMARY KEY ;
ALTER TABLE `equips` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
ALTER TABLE `equips` ADD UNIQUE (`equip_code`);

ALTER TABLE `training_documents` CHANGE `id` `doc_code` VARCHAR( 8 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `training_documents` DROP PRIMARY KEY ;
ALTER TABLE `training_documents` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
ALTER TABLE `training_documents` ADD UNIQUE (`doc_code`);

ALTER TABLE `equip_bookings` CHANGE `equip_id` `equip_id` INT NOT NULL;
ALTER TABLE `equip_bookings` CHANGE `project_id` `project_id` INT NOT NULL;
ALTER TABLE `equip_maintains` CHANGE `equip_id` `equip_id` INT NOT NULL;
ALTER TABLE `training_w_documents` CHANGE `training_document_id` `training_document_id` INT NOT NULL;

ALTER TABLE  `training_documents` CHANGE  `doc_code`  `doc_code` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
ALTER TABLE `reagents` CHANGE `chemical_id` `chemical_id` VARCHAR( 20 ) NOT NULL ;

ALTER TABLE  `training_documents` CHANGE  `document_name`  `document_name` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
