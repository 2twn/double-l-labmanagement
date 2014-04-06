-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Apr 06, 2014, 10:18 下午
-- 伺服器版本: 5.1.44
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `lab`
--

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
(8, '教育訓練管理', '教育訓練列表', 'training', 'training_list', 3001),
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

--
-- 列出以下資料庫的數據： `role_menus`
--

INSERT INTO `role_menus` (`id`, `role_id`, `menu_id`) VALUES
('19', 1, 4),
('18', 1, 3),
('17', 1, 2),
('16', 1, 1),
('20', 1, 5),
('21', 1, 6),
('22', 1, 7),
('23', 1, 8),
('24', 1, 9),
('25', 1, 10),
('26', 1, 11),
('27', 1, 12),
('28', 1, 13),
('29', 1, 14),
('30', 1, 15),
('31', 1, 16),
('32', 1, 17),
('33', 1, 18),
('34', 1, 19),
('35', 1, 20),
('2.1', 2, 1),
('2.2', 2, 2),
('2.3', 2, 3),
('2.4', 2, 4),
('2.5', 2, 5),
('2.6', 2, 6),
('2.7', 2, 7),
('2.8', 2, 8),
('2.9', 2, 9),
('2.10', 2, 10),
('2.11', 2, 11),
('2.12', 2, 12),
('2.13', 2, 13),
('2.14', 2, 14),
('2.15', 2, 15),
('3.1', 3, 1),
('3.2', 3, 2),
('3.3', 3, 3),
('3.4', 3, 4);

-- --------------------------------------------------------

--
-- 資料表格式： `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `group_id` int(11) NOT NULL,
  `valid` char(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `modi_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ1` (`username`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 列出以下資料庫的數據： `users`
--

INSERT INTO `users` (`id`, `employee_id`, `department_id`, `email`, `name`, `username`, `group_id`, `valid`, `create_time`, `modi_time`) VALUES
(1, '', 1, 'admin@mail.com', 'Administrator', 'admin', 0, '1', '2014-01-16 14:59:33', '2014-03-31 22:11:32'),
(2, '12323', 3, 'test@test.com', 'Test', 'testuser', 1, '1', '2014-02-05 22:49:30', '2014-03-30 23:44:09'),
(3, NULL, 1, 'yunlong@tlcbio.com', 'æ›¾é›²é¾', 'yunlong', 1, '1', '2014-02-25 21:24:51', '2014-02-25 21:24:51'),
(4, NULL, 1, 'karen@tlcbio.com', 'æ­éœå¦‚', 'karen', 1, '1', '2014-02-25 21:25:28', '2014-02-25 21:25:28'),
(5, NULL, 1, 'lchang@tlcbio.com', 'å¼µçž', 'lchang', 1, '0', '2014-02-25 21:27:08', '2014-02-25 21:27:08'),
(6, NULL, 1, 'Niki@tlcbio.com', 'æŽç’§ç©Ž', 'Niki', 1, '0', '2014-02-25 21:27:50', '2014-02-25 21:28:03'),
(7, NULL, 1, 'hewitt@tlcbio.com', 'æž—å®œè«­', 'hewitt', 1, '0', '2014-02-25 21:28:23', '2014-02-25 21:28:23'),
(8, NULL, 1, 'clare@tlcbio.com', 'éƒ­å¦‚çŽ‰', 'clare', 1, '0', '2014-02-25 21:28:51', '2014-02-25 21:28:51'),
(9, NULL, 1, 'angelina@tlcbio.com', 'å³ä½³ç©Ž', 'angelina', 1, '0', '2014-02-25 21:29:10', '2014-02-25 21:29:10'),
(10, NULL, 1, 'aaron@tlcbio.com', 'é»ƒè±ªé †', 'aaron', 1, '0', '2014-02-25 21:29:29', '2014-02-25 21:29:29'),
(11, NULL, 1, 'chenghan@tlcbio.com', 'è”¡æ”¿ç¿°', 'chenghan', 1, '0', '2014-02-25 21:29:57', '2014-02-25 21:29:57'),
(12, NULL, 2, 'mwkuo@tlcbio.com', 'éƒ­æ•æ–‡', 'mwkuo', 1, '0', '2014-02-25 21:30:18', '2014-02-25 21:30:18'),
(13, NULL, 2, 'hueiru@tlcbio.com', 'è”¡è•™å¦‚', 'hueiru', 1, '0', '2014-02-25 21:30:39', '2014-02-25 21:30:39'),
(14, NULL, 2, 'yiting@tlcbio.com', 'å³ä¼Šå©·', 'yiting', 1, '0', '2014-02-25 21:30:56', '2014-02-25 21:30:56'),
(15, NULL, 2, 'wenyi@tlcbio.com', 'è˜‡æ–‡æ€¡', 'wenyi', 1, '0', '2014-02-25 21:31:27', '2014-02-25 21:31:27'),
(16, NULL, 2, 'shihyuwang@tlcbio.com', 'çŽ‹ä¸–è‚²', 'shihyuwang', 1, '0', '2014-02-25 21:31:43', '2014-02-25 21:31:43'),
(17, NULL, 2, 'hexane@tlcbio.com', 'é™³ç›ˆè“', 'hexane', 1, '0', '2014-02-25 21:32:13', '2014-02-25 21:32:13'),
(18, NULL, 2, 'emma@tlcbio.com', 'å¼µå„·ç“Š', 'emma', 1, '0', '2014-02-25 21:32:33', '2014-02-25 21:32:46'),
(19, NULL, 2, 'yingfang@tlcbio.com', 'æŽè‹±èŠ³', 'yingfang', 1, '0', '2014-02-25 21:33:13', '2014-02-25 21:33:13'),
(20, NULL, 2, 'chihkang@tlcbio.com', 'å¸¸è‡´ç¶±', 'chihkang', 1, '0', '2014-02-25 21:33:39', '2014-02-25 21:33:39'),
(21, NULL, 2, 'sandra@tlcbio.com', 'è”¡ä½³ç’‡', 'sandra', 1, '0', '2014-02-25 21:33:55', '2014-02-25 21:33:55'),
(22, NULL, 2, 'ylku@tlcbio.com', 'å¤æºç¿Ž', 'ylku', 1, '0', '2014-02-25 21:34:16', '2014-02-25 21:34:27'),
(23, NULL, 2, 'aria@tlcbio.com', 'æ¥Šæ­£å®‡', 'aria', 1, '0', '2014-02-25 21:34:59', '2014-02-25 21:35:13'),
(24, NULL, 2, 'jeffrey@tlcbio.com', 'æž—å¿—éš†', 'jeffrey', 1, '0', '2014-02-25 21:35:31', '2014-02-25 21:35:31'),
(25, NULL, 2, 'xuanwei@tlcbio.com', 'æ¥Šè»’ç·¯', 'xuanwei', 1, '0', '2014-02-25 21:35:52', '2014-02-25 21:35:52'),
(26, NULL, 2, 'kyan@tlcbio.com', 'ç¿å‰é›„', 'kyan', 1, '0', '2014-02-25 21:36:15', '2014-02-25 21:36:31'),
(27, NULL, 2, 'chrissy@tlcbio.com', 'çŽ‹æ…§å©·', 'chrissy', 1, '0', '2014-02-25 21:36:59', '2014-02-25 21:36:59'),
(28, NULL, 3, 'cloud@tlcbio.com', 'èŽŠé›²ç¿”', 'cloud', 1, '0', '2014-02-25 21:37:29', '2014-02-25 21:37:29'),
(29, NULL, 3, 'eva@tlcbio.com', 'ç¾…æ€¡èŠ³', 'eva', 1, '0', '2014-02-25 21:37:51', '2014-02-25 21:38:04'),
(30, NULL, 3, 'yclin@tlcbio.com', 'æž—é›…å¨Ÿ', 'yclin', 1, '0', '2014-02-25 21:38:22', '2014-02-25 21:38:22'),
(31, NULL, 3, 'shinni@tlcbio.com', 'å®‹æ¬£éœ“', 'shinni', 1, '0', '2014-02-25 21:38:39', '2014-02-25 21:38:39'),
(32, NULL, 3, 'jenny@tlcbio.com', 'è”¡å®œçœŸ', 'jenny', 1, '0', '2014-02-25 21:38:57', '2014-02-25 21:38:57'),
(33, NULL, 3, 'herber@tlcbio.com', 'å½­ç¶­æ¦®', 'herber', 1, '0', '2014-02-25 21:39:15', '2014-02-25 21:39:15'),
(34, NULL, 3, 'diana@tlcbio.com', 'é«˜å˜‰éœ™', 'diana', 1, '0', '2014-02-25 21:39:40', '2014-02-25 21:39:40'),
(35, NULL, 3, 'sean@tlcbio.com', 'é™³éœ‡å®‡', 'sean1', 1, '0', '2014-02-25 21:40:00', '2014-02-25 21:40:00'),
(36, NULL, 3, 'leo@tlcbio.com', 'å³æ—»ç¿°', 'leo12', 1, '0', '2014-02-25 21:40:19', '2014-02-25 21:40:19'),
(37, NULL, 3, 'yufong@tlcbio.com', 'æž—è£•å³°', 'yufong', 1, '0', '2014-02-25 21:40:37', '2014-02-25 21:40:37'),
(38, NULL, 3, 'chihsian@tlcbio.com', 'é™³èªŒè³¢', 'chihsian', 1, '0', '2014-02-25 21:40:57', '2014-02-25 21:40:57'),
(39, NULL, 3, 'jenchih@tlcbio.com', 'è³´æ½¤èŠ', 'jenchih', 1, '0', '2014-02-25 21:41:12', '2014-02-25 21:41:12'),
(40, NULL, 3, 'chiachen@tlcbio.com', 'å³ä½³çœŸ', 'chiachen', 1, '0', '2014-02-25 21:41:32', '2014-02-25 21:41:32');

-- --------------------------------------------------------

--
-- 資料表格式： `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
('2.3', 2, 3),
('1.1', 1, 1),
('1.2', 1, 2);
