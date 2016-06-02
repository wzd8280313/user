-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-08 16:23:24
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nn2`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(20) NOT NULL COMMENT '管理员用户名',
  `password` varchar(40) NOT NULL COMMENT '密码',
  `role` int(11) NOT NULL COMMENT '角色id，0:超级管理员',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `last_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_time` datetime NOT NULL COMMENT '最后登录时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态0:正常1:锁定',
  `session_id` varchar(255) NOT NULL COMMENT 'sessionID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理员表';

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `role`, `create_time`, `email`, `last_ip`, `last_time`, `status`, `session_id`) VALUES
(0, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '2016-04-01 00:00:00', '', '::1', '0000-00-00 00:00:00', 0, 'oh24dfgpmtmlh59ns60ipnr8d6'),
(1, 'admin123', '05fe7461c607c33229772d402505601016a7d0ea', 0, '2016-04-13 15:36:42', 'weiping@163.com', '::1', '2016-04-13 15:36:42', 0, ''),
(2, 'admin12223', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 14:55:10', '48888@qq.com34', '::1', '2016-04-07 14:55:10', -1, ''),
(3, 'admin21', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:33:22', '1234567@qq.com', '::1', '2016-04-07 15:33:22', -1, ''),
(4, 'admin2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '2016-04-07 15:35:09', '1234562@qq.com', '::1', '2016-04-07 15:35:09', -1, '6tkenqd045pg6likt33p14h9j2'),
(5, 'admin23', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:35:28', '12345623@qq.com', '::1', '2016-04-07 15:35:28', -1, ''),
(6, 'admin5', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:37:48', '123456222@qq.com', '::1', '2016-04-07 15:37:48', -1, ''),
(7, 'admin88', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:39:12', '12345688@qq.com', '::1', '2016-04-07 15:39:12', -1, ''),
(8, 'admin889', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:39:46', '123456@qq.com1', '::1', '2016-04-07 15:39:46', -1, ''),
(9, 'admin99', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 15:40:56', '12345699@qq.com', '::1', '2016-04-07 15:40:56', -1, ''),
(10, 'admin65', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 16:04:10', '1234562221@qq.com', '::1', '2016-04-07 16:04:10', -1, ''),
(11, 'admin009', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 16:07:06', '1234522116@qq.com', '::1', '2016-04-07 16:07:06', -1, ''),
(12, 'admin777', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 16:07:59', '12345677@qq.com', '::1', '2016-04-07 16:07:59', -1, ''),
(13, 'admin88752', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 8, '2016-04-07 16:09:30', '123456882@qq.com1212', '::1', '2016-04-07 16:09:30', 0, ''),
(14, 'admin2223', '05fe7461c607c33229772d402505601016a7d0ea', 1, '2016-04-07 16:18:04', '123456009@qq.com', '::1', '2016-04-07 16:18:04', 1, ''),
(15, 'admin2556', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 16:20:49', '123456117@qq.com', '::1', '2016-04-07 16:20:49', 0, ''),
(16, 'admin998', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-04-07 16:28:49', '123459986@qq.com', '::1', '2016-04-07 16:28:49', -1, ''),
(17, 'admin0099812', '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, '2016-04-07 18:10:32', '123456zzz@qq.com', '::1', '2016-04-07 18:10:32', 1, ''),
(18, 'admin111', '1edd072aad695cf469832e2d473dca2eec0d5ef9', 1, '2016-04-08 09:57:28', '123456@qq.com', '::1', '2016-04-08 09:57:28', -1, ''),
(19, 'test_admin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 9, '2016-04-12 11:00:52', 'test_admin@qq.com', '::1', '2016-04-12 11:00:52', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_access`
--

INSERT INTO `admin_access` (`role_id`, `node_id`, `level`, `module`) VALUES
(8, 6, NULL, NULL),
(8, 7, NULL, NULL),
(8, 10, NULL, NULL),
(8, 13, NULL, NULL),
(8, 14, NULL, NULL),
(8, 15, NULL, NULL),
(8, 16, NULL, NULL),
(8, 17, NULL, NULL),
(8, 18, NULL, NULL),
(8, 34, NULL, NULL),
(8, 35, NULL, NULL),
(8, 36, NULL, NULL),
(8, 38, NULL, NULL),
(8, 27, NULL, NULL),
(8, 28, NULL, NULL),
(8, 29, NULL, NULL),
(8, 30, NULL, NULL),
(8, 31, NULL, NULL),
(8, 37, NULL, NULL),
(8, 39, NULL, NULL),
(8, 40, NULL, NULL),
(8, 41, NULL, NULL),
(8, 42, NULL, NULL),
(8, 19, NULL, NULL),
(8, 32, NULL, NULL),
(8, 33, NULL, NULL),
(4, 6, NULL, NULL),
(4, 7, NULL, NULL),
(4, 38, NULL, NULL),
(4, 27, NULL, NULL),
(4, 28, NULL, NULL),
(4, 29, NULL, NULL),
(4, 30, NULL, NULL),
(4, 31, NULL, NULL),
(8, 6, NULL, NULL),
(8, 7, NULL, NULL),
(8, 10, NULL, NULL),
(8, 13, NULL, NULL),
(8, 14, NULL, NULL),
(8, 15, NULL, NULL),
(8, 16, NULL, NULL),
(8, 17, NULL, NULL),
(8, 18, NULL, NULL),
(8, 34, NULL, NULL),
(8, 35, NULL, NULL),
(8, 36, NULL, NULL),
(8, 38, NULL, NULL),
(8, 43, NULL, NULL),
(8, 27, NULL, NULL),
(8, 28, NULL, NULL),
(8, 29, NULL, NULL),
(8, 30, NULL, NULL),
(8, 31, NULL, NULL),
(8, 37, NULL, NULL),
(8, 39, NULL, NULL),
(8, 40, NULL, NULL),
(8, 41, NULL, NULL),
(8, 42, NULL, NULL),
(8, 19, NULL, NULL),
(8, 32, NULL, NULL),
(8, 33, NULL, NULL),
(5, 6, NULL, NULL),
(5, 27, NULL, NULL),
(5, 28, NULL, NULL),
(5, 29, NULL, NULL),
(5, 31, NULL, NULL),
(5, 39, NULL, NULL),
(5, 41, NULL, NULL),
(5, 19, NULL, NULL),
(5, 32, NULL, NULL),
(5, 33, NULL, NULL),
(5, 46, NULL, NULL),
(5, 47, NULL, NULL),
(9, 6, NULL, NULL),
(9, 7, NULL, NULL),
(9, 10, NULL, NULL),
(9, 13, NULL, NULL),
(9, 14, NULL, NULL),
(9, 15, NULL, NULL),
(9, 16, NULL, NULL),
(9, 17, NULL, NULL),
(9, 18, NULL, NULL),
(9, 34, NULL, NULL),
(9, 35, NULL, NULL),
(9, 36, NULL, NULL),
(9, 38, NULL, NULL),
(9, 43, NULL, NULL),
(9, 27, NULL, NULL),
(9, 28, NULL, NULL),
(9, 29, NULL, NULL),
(9, 30, NULL, NULL),
(9, 31, NULL, NULL),
(9, 37, NULL, NULL),
(9, 39, NULL, NULL),
(9, 40, NULL, NULL),
(9, 41, NULL, NULL),
(9, 42, NULL, NULL),
(9, 19, NULL, NULL),
(9, 32, NULL, NULL),
(9, 33, NULL, NULL),
(9, 46, NULL, NULL),
(9, 47, NULL, NULL),
(2, 68, NULL, NULL),
(2, 69, NULL, NULL),
(2, 70, NULL, NULL),
(2, 71, NULL, NULL),
(2, 72, NULL, NULL),
(2, 73, NULL, NULL),
(2, 74, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_node`
--

CREATE TABLE IF NOT EXISTS `admin_node` (
  `id` smallint(6) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_node`
--

INSERT INTO `admin_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(49, 'system', '系统管理', 0, NULL, NULL, 0, 1),
(50, 'Rbac', '权限管理', 0, NULL, NULL, 49, 2),
(51, 'roleDel', '管理员分组,删除角色', 0, NULL, NULL, 50, 3),
(52, 'roleUpdate', '管理员分组,更新角色', 0, NULL, NULL, 50, 3),
(53, 'roleAdd', '管理员分组,添加角色页面', 0, NULL, NULL, 50, 3),
(54, 'roleList', '管理员分组,角色列表', 0, NULL, NULL, 50, 3),
(55, 'setStatus', '管理员分组,设置角色状态', 0, NULL, NULL, 50, 3),
(56, 'nodeAdd', '权限分配,添加节点', 0, NULL, NULL, 50, 3),
(57, 'controllerList', '权限分配,控制器列表', 0, NULL, NULL, 50, 3),
(58, 'actionList', '权限分配,方法列表', 0, NULL, NULL, 50, 3),
(59, 'actionTitle', '权限分配,方法标题', 0, NULL, NULL, 50, 3),
(60, 'accessList', '权限分配,已授权列表', 0, NULL, NULL, 50, 3),
(61, 'AccessAdd', '权限分配,授权', 0, NULL, NULL, 50, 3),
(62, 'Admin', '管理员信息', 0, NULL, NULL, 49, 2),
(63, 'adminList', '管理员列表,管理员列表', 0, NULL, NULL, 62, 3),
(64, 'adminAdd', '管理员列表,新增页面', 0, NULL, NULL, 62, 3),
(65, 'adminUpdate', '管理员列表,更新', 0, NULL, NULL, 62, 3),
(66, 'adminPwd', '管理员列表,修改密码', 0, NULL, NULL, 62, 3),
(67, 'setStatus', '管理员列表,设置状态', 0, NULL, NULL, 62, 3),
(68, 'member', '会员管理', 0, NULL, NULL, 0, 1),
(69, 'Usergroup', '用户角色分组', 0, NULL, NULL, 68, 2),
(70, 'groupList', '角色分组,分组列表', 0, NULL, NULL, 69, 3),
(71, 'groupAdd', '角色分组,新增分组', 0, NULL, NULL, 69, 3),
(72, 'groupEdit', '角色分组,编辑分组', 0, NULL, NULL, 69, 3),
(73, 'groupDel', '角色分组,删除分组', 0, NULL, NULL, 69, 3),
(74, 'setStatus', '角色分组,设置状态', 0, NULL, NULL, 69, 3);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` smallint(6) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(2, '商品管理员', NULL, 0, '商品管理'),
(4, '会计', NULL, 1, '资金管理'),
(5, '测试管理员', NULL, 0, '测试'),
(8, '管理员', NULL, 1, '管理员1理员12312312312321312312312'),
(9, '运维', NULL, 0, '运维'),
(0, 'ceshi', NULL, 0, 'sdfsdf'),
(0, 'qwe', NULL, 0, 'qweqwe');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_user`
--

CREATE TABLE IF NOT EXISTS `admin_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `admin_session`
--

CREATE TABLE IF NOT EXISTS `admin_session` (
  `session_id` varchar(255) NOT NULL COMMENT '登录时session_id',
  `session_expire` int(11) NOT NULL COMMENT '过期时间戳',
  `session_data` text NOT NULL COMMENT 'session数据',
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台登录session表';

--
-- 转存表中的数据 `admin_session`
--

INSERT INTO `admin_session` (`session_id`, `session_expire`, `session_data`) VALUES
('lnm90as9dlgqd2lqqn81g5gi56', 1462719174, 'nn_1e5709b18ee08fff5c17aa2a6ca2de9d|b:0;nn_57dbbbb4fcfb26bc7e0fa215d29b0864|b:0;'),
('oh24dfgpmtmlh59ns60ipnr8d6', 1462718984, 'nn_admin|a:3:{s:2:"id";s:1:"0";s:4:"name";s:5:"admin";s:4:"role";s:5:"ceshi";}');

-- --------------------------------------------------------

--
-- 表的结构 `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `status` int(11) DEFAULT NULL COMMENT '是否被采纳',
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_list`
--

CREATE TABLE IF NOT EXISTS `bid_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '投标人id',
  `bid_id` int(11) DEFAULT NULL COMMENT '招标id',
  `cert_verify` int(11) DEFAULT NULL COMMENT '资质审核状态',
  `document_buy` int(11) DEFAULT NULL COMMENT '是否已买标书',
  `has_bid` int(11) DEFAULT NULL COMMENT '是否投标',
  `status` int(11) DEFAULT NULL COMMENT '是否审核通过',
  `sign_time` varchar(45) DEFAULT NULL COMMENT '报名时间',
  `call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_package`
--

CREATE TABLE IF NOT EXISTS `bid_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_no` int(11) DEFAULT NULL COMMENT '包件号码',
  `name` varchar(100) DEFAULT NULL COMMENT '货品名称',
  `brand` varchar(45) DEFAULT NULL COMMENT '品牌',
  `spec` varchar(100) DEFAULT NULL COMMENT '型号规格',
  `tech_need` varchar(100) DEFAULT NULL COMMENT '技术要求',
  `unit` varchar(10) DEFAULT NULL COMMENT '计量单位',
  `num` decimal(10,6) DEFAULT NULL COMMENT '数量',
  `deliver_date` int(11) DEFAULT NULL COMMENT '交付日期',
  `call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bid_package_price`
--

CREATE TABLE IF NOT EXISTS `bid_package_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_package_id` int(11) DEFAULT NULL COMMENT '包件id',
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL COMMENT '单价',
  `other_fee` decimal(15,2) DEFAULT NULL,
  `deliver_days` int(11) DEFAULT NULL COMMENT '交货天数',
  `bid_id` int(11) DEFAULT NULL COMMENT '投标id',
  `bid_package_id1` int(11) NOT NULL,
  `bid_package_call_bid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`bid_package_id1`,`bid_package_call_bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `call_bid`
--

CREATE TABLE IF NOT EXISTS `call_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_name` varchar(200) DEFAULT NULL COMMENT '项目名称',
  `province` varchar(6) DEFAULT NULL COMMENT '省份',
  `city` varchar(6) DEFAULT NULL,
  `area` varchar(6) DEFAULT NULL,
  `bid_time` date DEFAULT NULL COMMENT '投标时间',
  `open_time` date DEFAULT NULL COMMENT '开标时间',
  `cond` text COMMENT '投标条件',
  `project_intro` text COMMENT '项目概况',
  `bid_content` text COMMENT '招标内容',
  `status` int(11) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `user_id` int(10) DEFAULT NULL,
  `area` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL COMMENT '详细地址',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司名称',
  `legal_person` varchar(20) NOT NULL COMMENT '法人',
  `reg_fund` decimal(9,2) NOT NULL COMMENT '注册资金',
  `category` int(4) NOT NULL COMMENT '企业分类',
  `nature` int(2) NOT NULL COMMENT '企业性质',
  `contact` varchar(20) DEFAULT NULL COMMENT '联系人',
  `contact_phone` varchar(15) NOT NULL COMMENT '联系人电话',
  `contact_duty` int(3) NOT NULL COMMENT '联系人职务',
  `check_taker` varchar(20) DEFAULT NULL COMMENT '收票人',
  `check_taker_phone` varchar(15) DEFAULT NULL COMMENT '收票人电话',
  `check_taker_add` varchar(100) DEFAULT NULL COMMENT '收票地址',
  `deposit_bank` varchar(50) DEFAULT NULL COMMENT '开户银行',
  `bank_acc` varchar(20) DEFAULT NULL COMMENT '银行账号',
  `tax_no` varchar(20) DEFAULT NULL COMMENT '税号',
  `cert_oc` varchar(100) DEFAULT NULL COMMENT '组织机构代码证',
  `cert_bl` varchar(100) DEFAULT NULL COMMENT '营业执照',
  `cert_tax` varchar(100) DEFAULT NULL COMMENT '税务登记证',
  `qq` varchar(15) DEFAULT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company_info`
--

INSERT INTO `company_info` (`user_id`, `area`, `address`, `company_name`, `legal_person`, `reg_fund`, `category`, `nature`, `contact`, `contact_phone`, `contact_duty`, `check_taker`, `check_taker_phone`, `check_taker_add`, `deposit_bank`, `bank_acc`, `tax_no`, `cert_oc`, `cert_bl`, `cert_tax`, `qq`) VALUES
(8, '1202', NULL, '123324', 'SDFSDF', '44.00', 0, 0, '234234', '145343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '210303', NULL, '23423', '的方法', '123.00', 0, 0, '多大的', '1423343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '140311', NULL, '白泉耐火', '赵总', '100.00', 1, 2, '张', '14323232323', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '140303', 'sdfsdf', 'weqwe', '张小j', '100.00', 1, 1, '王', '123123123', 1, '张张', '13534343434', '水电费水电费水电费', '了看见了看见', '112342342234234234', '1234234234234', 'filefromuser/2016/03/11/20160311071634276.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071631414.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071637894.jpg@user@user@user@user@user@user@user@user@user@user@user', ''),
(36, '230204', 'sdfsdf', '下百强d9', '水电费水电费水电费', '200.00', 1, 1, '赵', '14232323', 1, 'asdasd', '13123123123', '13123', '123123123', '123123123123', '123123123', 'filefromuser/2016/03/12/20160312165149275.png@user', 'filefromuser/2016/03/12/20160312165147148.png@user', 'filefromuser/2016/03/12/20160312165152543.png@user', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `configs_credit`
--

CREATE TABLE IF NOT EXISTS `configs_credit` (
  `name` varchar(40) NOT NULL COMMENT '参数名',
  `name_zh` varchar(30) NOT NULL COMMENT '中文名称',
  `type` int(2) NOT NULL COMMENT '参数类型,0:数值，1：百分比',
  `sign` int(2) NOT NULL DEFAULT '0' COMMENT '0,增加，1：减少',
  `value` decimal(8,5) NOT NULL COMMENT '参数值',
  `time` datetime NOT NULL COMMENT '创建时间',
  `sort` int(4) NOT NULL,
  `note` varchar(255) NOT NULL COMMENT '解释',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `configs_credit`
--

INSERT INTO `configs_credit` (`name`, `name_zh`, `type`, `sign`, `value`, `time`, `sort`, `note`) VALUES
('cancel_contract', '取消合同', 1, 1, '0.00000', '2016-04-19 00:00:00', 5, '取消合同扣减合同金额的百分比'),
('cancel_offer', '取消报盘', 1, 1, '0.00000', '2016-04-19 00:00:00', 4, ''),
('cert_dealer', '认证交易商', 0, 0, '0.00000', '2016-04-19 00:00:00', 0, ''),
('cert_ship', '认证物流', 0, 0, '0.00000', '2016-04-19 00:00:00', 5, ''),
('cert_store', '认证仓库管理员', 0, 0, '0.00000', '2016-04-19 00:00:00', 3, '认证成功加信誉'),
('contract', '完成合同', 1, 0, '0.00000', '2016-04-19 00:00:00', 0, ''),
('credit_money', '信誉保证金', 1, 0, '0.00000', '2016-04-19 00:00:00', 0, '信誉保证金数额的百分比'),
('pay', '支付', 1, 0, '0.00000', '2016-04-19 00:00:00', 0, '支付金额的百分比'),
('product', '', 0, 0, '0.00000', '2016-04-19 00:00:00', 0, ''),
('register', '', 0, 0, '0.00000', '2016-04-19 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `dealer`
--

CREATE TABLE IF NOT EXISTS `dealer` (
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text NOT NULL COMMENT '驳回原因',
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dealer`
--

INSERT INTO `dealer` (`user_id`, `status`, `apply_time`, `verify_time`, `admin_id`, `message`) VALUES
(36, 0, '2016-03-25 10:35:00', '2016-03-26 15:51:31', NULL, ''),
(42, 1, '2016-04-13 15:20:48', '2016-03-27 17:08:34', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `editor`
--

CREATE TABLE IF NOT EXISTS `editor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `expert`
--

CREATE TABLE IF NOT EXISTS `expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '开通状态',
  `domain` varchar(100) DEFAULT NULL COMMENT '删除的领域，问题分类以，相隔',
  `answer_times` int(11) DEFAULT NULL COMMENT '回答次数',
  `accept_times` int(11) DEFAULT NULL COMMENT '被采纳次数',
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `log_operation`
--

CREATE TABLE IF NOT EXISTS `log_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(80) NOT NULL COMMENT '管理员',
  `action` varchar(200) NOT NULL COMMENT '动作',
  `content` text NOT NULL COMMENT '详情',
  `datetime` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `log_operation`
--

INSERT INTO `log_operation` (`id`, `author`, `action`, `content`, `datetime`) VALUES
(1, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:00:58'),
(2, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:01:19'),
(3, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:05:55'),
(4, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:06:10');

-- --------------------------------------------------------

--
-- 表的结构 `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '模型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `model_attr`
--

CREATE TABLE IF NOT EXISTS `model_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '属性名',
  `value` text COMMENT '属性值，多个以,分割',
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) DEFAULT NULL,
  `num` decimal(15,2) DEFAULT NULL COMMENT '产品数量',
  `price` decimal(15,2) DEFAULT NULL,
  `order_amount` decimal(15,2) DEFAULT NULL COMMENT '订单总金额',
  `create_time` datetime DEFAULT NULL,
  `complate_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `products_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `person_info`
--

CREATE TABLE IF NOT EXISTS `person_info` (
  `user_id` int(11) NOT NULL,
  `true_name` varchar(45) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `identify_no` varchar(20) DEFAULT NULL COMMENT '身份证号码',
  `identify_front` varchar(100) DEFAULT NULL COMMENT '身份证正面照',
  `identify_back` varchar(100) DEFAULT NULL COMMENT '身份证背面',
  `birth` date DEFAULT NULL,
  `education` int(11) DEFAULT NULL COMMENT '学历，不同数字代表不同学历',
  `qq` varchar(20) DEFAULT NULL,
  `zhichen` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_info`
--

INSERT INTO `person_info` (`user_id`, `true_name`, `sex`, `identify_no`, `identify_front`, `identify_back`, `birth`, `education`, `qq`, `zhichen`) VALUES
(33, '张', 0, '12323425445345345345', 'filefromuser/2016/03/11/20160311021721228.jpg@user', 'filefromuser/2016/03/11/20160311021724227.jpg@user', '2012-03-06', 0, '123123123', ''),
(37, 'sdfdf', 0, '123123123123123123', 'filefromuser/2016/03/12/20160312184419736.png@user', 'filefromuser/2016/03/12/20160312184422991.png@user', '2015-09-29', 0, '', ''),
(38, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(39, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(40, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(41, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(42, 'qwe', 0, '1232354345345', 'filefromuser/2016/03/25/20160325085343348.jpg@user', 'filefromuser/2016/03/25/20160325085352495.jpg@user', '0000-00-00', 0, '123234234', '地方');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `cate_id` int(11) NOT NULL COMMENT '商品分类',
  `attribute` text NOT NULL COMMENT '商品属性',
  `unit` varchar(20) NOT NULL DEFAULT '吨' COMMENT '单位',
  `price` decimal(15,2) NOT NULL COMMENT '单价',
  `produce_area` varchar(6) NOT NULL COMMENT '产地',
  `currency` int(2) NOT NULL DEFAULT '1' COMMENT '币种1：人民币',
  `quantity` decimal(15,5) NOT NULL COMMENT '总数量',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `expire_time` datetime DEFAULT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `note` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `cate_id`, `attribute`, `unit`, `price`, `produce_area`, `currency`, `quantity`, `create_time`, `expire_time`, `sort`, `note`) VALUES
(1, 0, '水电费', 0, 's:0:"";', '吨', '123.00', '371423', 1, '22.00000', '2016-04-19 17:22:39', NULL, 0, '时代发生地方'),
(2, 0, 'tietie', 9, 'a:2:{i:3;s:2:"23";i:2;s:2:"90";}', '吨', '12.00', '350103', 1, '123.00000', '2016-04-19 17:29:29', NULL, 0, '3werwer'),
(3, 0, '1qw', 9, 'a:3:{i:4;s:1:"2";i:3;s:1:"3";i:2;s:1:"4";}', '吨', '23.00', '371311', 1, '123.00000', '2016-04-21 12:05:54', NULL, 0, '232323'),
(4, 0, '铝材', 9, 'a:3:{i:4;s:2:"23";i:3;s:2:"90";i:2;s:2:"24";}', '吨', '89.90', '422802', 1, '1222.00000', '2016-04-21 12:08:29', NULL, 0, '32是对方答复的方式'),
(7, 0, '高铝砖', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '2016-04-21 12:19:26', NULL, 0, '2稍等'),
(8, 0, '多大的', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '2016-04-21 12:24:36', NULL, 0, '2稍等'),
(9, 0, '高铝砖', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '2016-04-21 12:24:56', NULL, 0, '2稍等'),
(10, 36, '温柔V', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"34";}', '吨', '12.00', '152223', 1, '2.00000', '2016-05-07 23:07:50', NULL, 0, ''),
(11, 36, '温柔V', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"34";}', '吨', '12.00', '152223', 1, '2.00000', '2016-05-07 23:08:10', NULL, 0, ''),
(12, 36, '温柔V', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"34";}', '吨', '12.00', '152223', 1, '2.00000', '2016-05-07 23:10:29', NULL, 0, ''),
(13, 36, 'ddsfdf', 8, 'a:2:{i:2;s:3:"234";i:3;s:3:"234";}', '吨', '23.00', '361028', 1, '232.00000', '2016-05-07 23:32:47', NULL, 0, '234234'),
(14, 36, '阿啊啊啊啊', 8, 'a:2:{i:2;s:2:"56";i:3;s:2:"45";}', '吨', '123.00', '433122', 1, '232.00000', '2016-05-07 23:35:32', NULL, 0, '2323'),
(15, 36, '阿啊啊啊啊', 8, 'a:2:{i:2;s:2:"56";i:3;s:2:"45";}', '吨', '123.00', '433122', 1, '232.00000', '2016-05-07 23:37:00', NULL, 0, '2323'),
(16, 36, '温柔温柔V', 8, 'a:2:{i:2;s:3:"324";i:3;s:2:"34";}', '吨', '23.00', 'getAre', 1, '23.00000', '2016-05-07 23:37:59', NULL, 0, '34'),
(17, 36, '温柔温柔V', 8, 'a:2:{i:2;s:3:"324";i:3;s:2:"34";}', '吨', '23.00', 'getAre', 1, '23.00000', '2016-05-07 23:38:17', NULL, 0, '34'),
(18, 36, '温柔温柔V', 8, 'a:2:{i:2;s:3:"324";i:3;s:2:"34";}', '吨', '23.00', 'getAre', 1, '23.00000', '2016-05-07 23:39:10', NULL, 0, '34'),
(19, 36, '古古怪怪', 8, 'a:2:{i:2;s:2:"34";i:3;s:2:"34";}', '吨', '23.00', '321084', 1, '12.00000', '2016-05-08 00:27:40', NULL, 0, '234234'),
(20, 36, '抱抱抱抱吧', 8, 'a:2:{i:2;s:2:"34";i:3;s:2:"34";}', '吨', '12.00', '341702', 1, '213.00000', '2016-05-08 00:30:53', NULL, 0, '213'),
(21, 36, '就斤斤计较', 8, 'a:2:{i:3;s:2:"23";i:2;s:3:"12%";}', '吨', '12.00', '371521', 1, '23.00000', '2016-05-08 20:38:06', NULL, 0, ''),
(22, 36, 'eefff多大的', 8, 'a:2:{i:2;s:3:"123";i:3;s:3:"123";}', '吨', '23.00', '341421', 1, '200.00000', '2016-05-08 21:10:26', NULL, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '属性名称',
  `value` text NOT NULL COMMENT '可选的值，可以为空，多个以，相隔',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '类型：1：输入框，2：单选，3：多选',
  `sort` int(11) NOT NULL COMMENT '排序',
  `note` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `name`, `value`, `type`, `sort`, `note`) VALUES
(1, 'Al含量', '', 2, 2, ''),
(2, 'Fe含量', '', 1, 2, ''),
(3, '长度', '', 1, 4, ''),
(4, '宽度', '', 1, 4, ''),
(5, 's含量', '', 1, 6, '');

-- --------------------------------------------------------

--
-- 表的结构 `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `childname` varchar(20) NOT NULL COMMENT '下级分类统称',
  `unit` varchar(20) NOT NULL COMMENT '商品计量单位，向下继承',
  `percent` int(4) NOT NULL COMMENT '预付款比率，0到100之间',
  `pid` int(11) DEFAULT '0' COMMENT '父类id',
  `attrs` text NOT NULL COMMENT '关联的属性，多个已，相隔',
  `sort` int(11) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0：关闭，1：开启',
  `note` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `childname`, `unit`, `percent`, `pid`, `attrs`, `sort`, `status`, `note`) VALUES
(1, '钢材', '种类', '顿', 20, 0, '2,3', 1, 1, ''),
(2, '耐材', '种类', '吨', 30, 0, '3,4', 1, 1, ''),
(3, '建材', '种类', '吨', 20, 0, '', 1, 1, ''),
(4, '热卷', '种类', 'kg', 20, 3, '', 1, 1, ''),
(5, '普卷', '种类', '', 0, 4, '', 1, 1, ''),
(6, '薄卷', '种类', '', 0, 4, '', 1, 1, ''),
(7, 'dsfd', '', '', 0, 1, '', 2, 1, ''),
(8, '234', '', '', 0, 7, '', 4, 1, ''),
(9, '普卷', '种类', '', 0, 7, '2,4', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `product_offer`
--

CREATE TABLE IF NOT EXISTS `product_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '报盘类型：1：卖盘，2：买盘',
  `mode` int(2) NOT NULL COMMENT '报盘模式：1：自由，2：保证金，3:仓单',
  `product_id` int(11) NOT NULL COMMENT '商品iD',
  `price` decimal(8,2) NOT NULL COMMENT '商品单价',
  `divide` int(2) NOT NULL COMMENT '是否拆分，0：可以，1：不可',
  `minimum` decimal(15,2) NOT NULL COMMENT '最小起订量',
  `accept_area` varchar(100) NOT NULL COMMENT '交收地点',
  `accept_day` int(6) NOT NULL COMMENT '交收时间',
  `acc_type` varchar(20) NOT NULL COMMENT '支付方式',
  `offer_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '报盘费率',
  `sign` varchar(100) NOT NULL COMMENT '签字照片，委托报盘为委托书照片',
  `status` int(2) NOT NULL COMMENT '审核状态',
  `is_del` int(2) NOT NULL COMMENT '0:未删除，1：删除',
  `apply_time` datetime DEFAULT NULL COMMENT '申请时间',
  `finish_time` datetime DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `product_offer`
--

INSERT INTO `product_offer` (`id`, `user_id`, `type`, `mode`, `product_id`, `price`, `divide`, `minimum`, `accept_area`, `accept_day`, `acc_type`, `offer_fee`, `sign`, `status`, `is_del`, `apply_time`, `finish_time`) VALUES
(1, 0, 1, 1, 1, '123.00', 1, '0.00', '当时发生的', 3, '', '0.00', '', 0, 0, '2016-04-19 17:22:39', NULL),
(2, 0, 1, 1, 2, '12.00', 1, '0.00', '123', 2, '', '0.00', '', 0, 0, '2016-04-19 17:29:29', NULL),
(3, 0, 1, 1, 0, '23.00', 1, '0.00', '213', 2, '', '0.00', '', 0, 0, '2016-04-21 12:05:54', NULL),
(4, 0, 1, 2, 0, '89.90', 0, '2.00', '23', 6, '', '0.00', '', 0, 0, '2016-04-21 12:08:29', NULL),
(5, 0, 1, 0, 10, '12.00', 1, '0.00', '234', 3, '1', '100.00', '', 0, 1, '2016-05-07 23:07:50', NULL),
(6, 0, 1, 1, 11, '12.00', 1, '0.00', '234', 3, '1', '100.00', '', 0, 0, '2016-05-07 23:08:10', NULL),
(7, 0, 1, 1, 12, '12.00', 1, '0.00', '234', 3, '1', '100.00', '', 1, 0, '2016-05-07 23:10:29', NULL),
(8, 36, 1, 1, 13, '23.00', 1, '0.00', 'sdf', 324, '1', '100.00', '', 2, 0, '2016-05-07 23:32:47', NULL),
(9, 36, 1, 1, 14, '123.00', 1, '0.00', '213', 23, '1', '100.00', '', 1, 0, '2016-05-07 23:35:32', NULL),
(10, 36, 1, 1, 15, '123.00', 1, '0.00', '213', 23, '1', '100.00', '', 2, 0, '2016-05-07 23:37:00', NULL),
(11, 36, 1, 2, 16, '23.00', 1, '0.00', '234', 34, '', '0.00', '', 1, 1, '2016-05-07 23:37:59', NULL),
(12, 36, 1, 2, 17, '23.00', 1, '0.00', '234', 34, '', '0.00', '', 1, 0, '2016-05-07 23:38:17', NULL),
(13, 36, 1, 2, 18, '23.00', 1, '0.00', '234', 34, '', '0.00', '', 1, 1, '2016-05-07 23:39:10', NULL),
(14, 36, 1, 2, 19, '23.00', 1, '0.00', '234', 3, '', '0.00', '', 1, 0, '2016-05-08 00:27:40', NULL),
(15, 36, 1, 3, 20, '12.00', 1, '0.00', '123', 123, '', '0.00', 'upload/2016/05/08/20160508003050333.png@user', 1, 0, '2016-05-08 00:30:53', NULL),
(16, 0, 1, 4, 9, '23.00', 0, '123.00', '123', 123, '', '0.00', '', 0, 0, '2016-05-08 22:21:22', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `product_photos`
--

CREATE TABLE IF NOT EXISTS `product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `product_photos`
--

INSERT INTO `product_photos` (`id`, `img`, `products_id`) VALUES
(1, ' upload/2016/04/19/20160419172228702.png@user', 1),
(2, ' upload/2016/04/19/20160419172919996.png@user', 2),
(3, ' upload/2016/04/19/20160419172920944.png@user', 2),
(4, 'upload/2016/04/21/20160421120549509.png@user', 3),
(5, 'upload/2016/04/21/20160421120549275.png@user', 3),
(6, 'upload/2016/04/21/20160421120818130.png@user', 4),
(7, 'upload/2016/04/21/20160421120818524.png@user', 4),
(8, 'upload/2016/05/07/20160507230458630.png@user', 10),
(9, 'upload/2016/05/07/20160507230459175.png@user', 10),
(10, 'upload/2016/05/07/20160507230458630.png@user', 11),
(11, 'upload/2016/05/07/20160507230459175.png@user', 11),
(12, 'upload/2016/05/07/20160507230458630.png@user', 12),
(13, 'upload/2016/05/07/20160507230459175.png@user', 12),
(14, 'upload/2016/05/07/20160507233241974.png@user', 13),
(15, 'upload/2016/05/07/20160507233242779.png@user', 13),
(16, 'upload/2016/05/07/20160507233526942.png@user', 14),
(17, 'upload/2016/05/08/20160508002731903.png@user', 19),
(18, 'upload/2016/05/08/20160508003045848.png@user', 20),
(19, 'upload/2016/05/08/20160508203545792.png@user', 21),
(20, 'upload/2016/05/08/20160508211020281.png@user', 22);

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `status` varchar(45) DEFAULT NULL COMMENT '状态',
  `user_id` int(11) NOT NULL,
  `question_cate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question_cate`
--

CREATE TABLE IF NOT EXISTS `question_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '父类id',
  `sort` int(11) DEFAULT NULL,
  `question_num` int(11) DEFAULT NULL COMMENT '问题数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `start_add` varchar(45) DEFAULT NULL COMMENT '出发地',
  `end_add` varchar(45) DEFAULT NULL COMMENT '目的地',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shipper`
--

CREATE TABLE IF NOT EXISTS `shipper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sattus` int(11) DEFAULT NULL COMMENT '开通状态',
  `user_id` int(11) NOT NULL,
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '审核的管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ship_order`
--

CREATE TABLE IF NOT EXISTS `ship_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_id` int(11) DEFAULT NULL COMMENT '运输需求id',
  `create_time` datetime DEFAULT NULL,
  `order_no` varchar(20) DEFAULT NULL COMMENT '订单号',
  `shipper_id` int(11) DEFAULT NULL COMMENT '车主id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ship_order_trucks`
--

CREATE TABLE IF NOT EXISTS `ship_order_trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_order_id` varchar(45) DEFAULT NULL COMMENT '运输订单id',
  `truck_id` int(11) DEFAULT NULL,
  `ship_weight` decimal(10,5) DEFAULT NULL COMMENT '运输重量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `store_in_out`
--

CREATE TABLE IF NOT EXISTS `store_in_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `num` decimal(15,2) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '类型：出或入',
  `time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `store_list_id` int(11) NOT NULL,
  `manager` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `store_list`
--

CREATE TABLE IF NOT EXISTS `store_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `short_name` varchar(20) NOT NULL COMMENT '仓库简称',
  `area` varchar(6) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `service_phone` varchar(20) NOT NULL COMMENT '仓库服务的电话',
  `service_address` varchar(255) NOT NULL COMMENT '仓库服务点地址',
  `contact` varchar(30) NOT NULL COMMENT '联系人',
  `contact_phone` varchar(20) NOT NULL COMMENT '联系人电话',
  `type` int(2) NOT NULL COMMENT '仓库类型',
  `note` text NOT NULL COMMENT '备注',
  `status` int(2) NOT NULL COMMENT '0:关闭，1：启用',
  `img` varchar(255) NOT NULL COMMENT '仓库图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `store_list`
--

INSERT INTO `store_list` (`id`, `name`, `short_name`, `area`, `address`, `service_phone`, `service_address`, `contact`, `contact_phone`, `type`, `note`, `status`, `img`) VALUES
(1, '一号店', 'yi', '230303', '点开看看', '123234545', 'dfgdfgdfg', '赵', '13434343434', 1, '水电费水电费水电费法国恢复供货', 1, 'upload/2016/04/05/20160405172056268.jpg@admin');

-- --------------------------------------------------------

--
-- 表的结构 `store_manager`
--

CREATE TABLE IF NOT EXISTS `store_manager` (
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '认证状态',
  `apply_time` datetime DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL COMMENT '审核时间',
  `admin_id` int(11) DEFAULT NULL COMMENT '审核管理员id',
  `store_id` int(11) DEFAULT NULL COMMENT '管理的仓库id',
  `info` text NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `store_manager`
--

INSERT INTO `store_manager` (`user_id`, `status`, `apply_time`, `verify_time`, `admin_id`, `store_id`, `info`) VALUES
(36, 0, '2016-03-13 12:06:27', NULL, NULL, 1, ''),
(42, 0, '2016-03-12 23:05:44', NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `store_products`
--

CREATE TABLE IF NOT EXISTS `store_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '所属用户id',
  `store_id` int(11) NOT NULL COMMENT '仓库id',
  `product_id` int(11) DEFAULT NULL,
  `store_pos` varchar(200) NOT NULL COMMENT '库位',
  `package` int(2) NOT NULL COMMENT '是否包装',
  `package_unit` varchar(20) NOT NULL COMMENT '包装单位',
  `package_num` int(11) NOT NULL COMMENT '包装数量',
  `package_weight` decimal(8,5) NOT NULL COMMENT '包装重量',
  `status` int(2) NOT NULL COMMENT '审核状态',
  `apply_time` datetime NOT NULL COMMENT '申请时间',
  `in_time` datetime NOT NULL,
  `rent_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL COMMENT '完成时间',
  `expire_time` datetime NOT NULL COMMENT '失效日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `store_products`
--

INSERT INTO `store_products` (`id`, `user_id`, `store_id`, `product_id`, `store_pos`, `package`, `package_unit`, `package_num`, `package_weight`, `status`, `apply_time`, `in_time`, `rent_time`, `finish_time`, `expire_time`) VALUES
(1, 0, 0, 7, '', 0, '', 0, '0.00000', 0, '2016-04-21 12:19:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 36, 1, 8, '', 0, '', 0, '0.00000', 31, '2016-04-21 12:24:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 36, 1, 9, '', 0, '', 12, '23.00000', 31, '2016-04-21 12:24:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 36, 1, 21, '12', 1, '', 0, '0.00000', 23, '2016-05-08 20:38:06', '2016-05-08 00:00:00', '2016-05-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 36, 1, 22, '12', 1, '', 0, '0.00000', 11, '2016-05-08 21:10:26', '2016-05-07 00:00:00', '2016-05-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `subuser_right`
--

CREATE TABLE IF NOT EXISTS `subuser_right` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `level` int(2) NOT NULL COMMENT '权限级别：0：应用，1：模块，2：控制器，3：方法',
  `name` varchar(20) NOT NULL COMMENT '权限名',
  `pid` int(6) NOT NULL COMMENT '父类权限id',
  `note` varchar(30) NOT NULL COMMENT '中文名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `subuser_right`
--

INSERT INTO `subuser_right` (`id`, `level`, `name`, `pid`, `note`) VALUES
(1, 0, 'user', 0, '用户系统'),
(2, 2, 'ucenter', 1, '个人中心'),
(3, 3, 'index', 2, '首页'),
(4, 3, 'chgpass', 2, '修改密码'),
(5, 0, 'deal', 0, '交易系统'),
(6, 2, 'index', 5, '首页');

-- --------------------------------------------------------

--
-- 表的结构 `subuser_role`
--

CREATE TABLE IF NOT EXISTS `subuser_role` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '角色名',
  `status` int(2) NOT NULL COMMENT '0:关闭 1：开启',
  `note` varchar(100) NOT NULL COMMENT '角色说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subuser_role_right`
--

CREATE TABLE IF NOT EXISTS `subuser_role_right` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `role_id` int(8) NOT NULL,
  `right_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subuser_user_role`
--

CREATE TABLE IF NOT EXISTS `subuser_user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(6) NOT NULL,
  `note` text NOT NULL COMMENT '角色说明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`id`, `name`, `value`) VALUES
(1, 'wplee', 7);

-- --------------------------------------------------------

--
-- 表的结构 `truck`
--

CREATE TABLE IF NOT EXISTS `truck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `vehicle_no` varchar(12) DEFAULT NULL COMMENT '车牌号',
  `area` varchar(8) DEFAULT NULL COMMENT '车辆所属地区',
  `max_load` decimal(6,2) DEFAULT NULL COMMENT '最大载重',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `head_photo` varchar(100) DEFAULT NULL COMMENT '头像',
  `pid` int(11) DEFAULT '0' COMMENT '父账户id',
  `roles` int(5) DEFAULT NULL COMMENT '用户角色',
  `status` smallint(6) DEFAULT NULL,
  `agent` int(5) NOT NULL COMMENT '代理商id',
  `agent_pass` varchar(50) NOT NULL COMMENT '代理商密码',
  `create_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL COMMENT '最近登录时间',
  `session_id` varchar(255) NOT NULL COMMENT '用户登录后的sessionID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `type`, `username`, `password`, `mobile`, `email`, `head_photo`, `pid`, `roles`, `status`, `agent`, `agent_pass`, `create_time`, `login_time`, `session_id`) VALUES
(28, 1, 'fgertertert', '601f1889667efaebb33b8c12572835da3f027f78', '456345345345', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, ''),
(29, 1, 'bnfghfghfh', '05fe7461c607c33229772d402505601016a7d0ea', '567456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, ''),
(31, 1, 'weipinglee33', '601f1889667efaebb33b8c12572835da3f027f78', '456456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, '285dnb0demflhc3n7sca0n95m2'),
(32, 0, 'adminkkk', '05fe7461c607c33229772d402505601016a7d0ea', '12323232323', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, '4odd8sfrcfacopn2j72c88qf64'),
(33, 0, 'wplee', '05fe7461c607c33229772d402505601016a7d0ea', '12323232328', '', '@user', NULL, NULL, NULL, 0, '0', NULL, NULL, '5buhd54rqajbajsfumkgr9ijb4'),
(34, 1, 'wplee127', '05fe7461c607c33229772d402505601016a7d0ea', '14523232323', '', NULL, NULL, NULL, NULL, 3, '123123', NULL, NULL, '8qgb5uv4h90s5vlsu1ddr8pr22'),
(35, 1, '123qwe', 'c53255317bb11707d0f614696b3ce6f221d0e2f2', '13434343434', '', 'filefromuser/2016/03/11/20160311074729915.jpg@user@user', NULL, NULL, NULL, 4, 'sdfsdfsdf', NULL, NULL, 'd6dr0opqrvgejc72khn3qoli91'),
(36, 1, 'weipinglee', '05fe7461c607c33229772d402505601016a7d0ea', '16767676767', '', 'filefromuser/2016/03/19/20160319100358393.jpg@user', 0, NULL, NULL, 4, '1233124', NULL, NULL, 'lnm90as9dlgqd2lqqn81g5gi56'),
(37, 0, 'geren', '05fe7461c607c33229772d402505601016a7d0ea', '14334343434', '', '', NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(39, 0, 'kljklj', '05fe7461c607c33229772d402505601016a7d0ea', '15454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, 'ekp720eh5rqapk3ftfp87o3is5'),
(40, 0, 'kljlkjlkji', '05fe7461c607c33229772d402505601016a7d0ea', '14454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(41, 0, 'weimama', '05fe7461c607c33229772d402505601016a7d0ea', '12323232329', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, ''),
(42, 0, 'gerenyonghu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '16767676760', '', 'filefromuser/2016/03/12/20160312193238190.png@user', 0, NULL, NULL, 0, '0', NULL, NULL, 'fhhhacsj5rihilp4d8tu3anca2'),
(43, 0, 'weipine12', '05fe7461c607c33229772d402505601016a7d0ea', '15323232323', 'weeer@133.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(44, 0, 'weiping12', '05fe7461c607c33229772d402505601016a7d0ea', '12345678945', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(45, 0, 'weiping17', '05fe7461c607c33229772d402505601016a7d0ea', '17878654325', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(46, 0, 'weipinglee1234', '601f1889667efaebb33b8c12572835da3f027f78', '13423564589', 'werewr@153.cid', NULL, 36, NULL, NULL, 0, '', NULL, NULL, ''),
(47, 0, 'weiping987', '7c4a8d09ca3762af61e59520943dc26494f8941b', '12398765439', 'werewr@153.cid', 'filefromuser/2016/03/19/20160319112602131.jpg@user', 36, NULL, 1, 0, '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `fund` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '代理账户资金总额',
  `freeze` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '代理账户冻结资金',
  `ticket` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '票据账户',
  `ticket_freeze` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '票据账户冻结',
  `credit` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '信誉保证金账户',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_account`
--

INSERT INTO `user_account` (`user_id`, `fund`, `freeze`, `ticket`, `ticket_freeze`, `credit`) VALUES
(28, '90.00', '0.00', '0.00', '0.00', '0.00'),
(32, '82.00', '5.00', '0.00', '0.00', '0.00'),
(36, '4500.00', '400.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `user_fund_flow`
--

CREATE TABLE IF NOT EXISTS `user_fund_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '交易的用户id',
  `acc_type` int(2) NOT NULL COMMENT '账户类型，1：代理账户，2：签约，3:票据',
  `flow_no` varchar(50) NOT NULL COMMENT '交易流水号',
  `fund_in` decimal(12,2) NOT NULL COMMENT '收入',
  `fund_out` decimal(12,2) NOT NULL COMMENT '支出',
  `freeze` decimal(12,2) NOT NULL COMMENT '冻结,负数代表解冻',
  `total` decimal(12,2) NOT NULL COMMENT '总金额',
  `active` decimal(12,2) NOT NULL COMMENT '可用余额',
  `note` varchar(255) NOT NULL COMMENT '摘要',
  `time` datetime NOT NULL COMMENT '交易时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- 转存表中的数据 `user_fund_flow`
--

INSERT INTO `user_fund_flow` (`id`, `user_id`, `acc_type`, `flow_no`, `fund_in`, `fund_out`, `freeze`, `total`, `active`, `note`, `time`) VALUES
(47, 28, 1, '20160422094247199069', '10.00', '0.00', '0.00', '40.00', '40.00', '', '2016-04-22 09:42:47'),
(48, 32, 1, '20160422094247451672', '0.00', '10.00', '-10.00', '87.00', '72.00', '', '2016-04-22 09:42:47'),
(49, 28, 1, '20160422094459114996', '10.00', '0.00', '0.00', '40.00', '40.00', '', '2016-04-22 09:44:59'),
(50, 32, 1, '20160422094459920541', '0.00', '10.00', '-10.00', '77.00', '72.00', '', '2016-04-22 09:44:59'),
(51, 32, 1, '20160422094538848388', '10.00', '0.00', '0.00', '87.00', '82.00', '', '2016-04-22 09:45:38'),
(52, 28, 1, '20160422094558338430', '10.00', '0.00', '0.00', '50.00', '50.00', '', '2016-04-22 09:45:58'),
(53, 28, 1, '20160507214116284680', '10.00', '0.00', '0.00', '60.00', '60.00', '', '2016-05-07 21:41:16'),
(54, 28, 1, '20160507214122485345', '10.00', '0.00', '0.00', '70.00', '70.00', '', '2016-05-07 21:41:22'),
(55, 36, 1, '20160507230750842868', '0.00', '0.00', '100.00', '5000.00', '4900.00', '', '2016-05-07 23:07:50'),
(56, 36, 1, '20160507230810788980', '0.00', '0.00', '100.00', '5000.00', '4800.00', '', '2016-05-07 23:08:10'),
(57, 36, 1, '20160507231029952621', '0.00', '0.00', '100.00', '5000.00', '4700.00', '', '2016-05-07 23:10:29'),
(58, 36, 1, '20160507233247302642', '0.00', '0.00', '100.00', '5000.00', '4600.00', '', '2016-05-07 23:32:47'),
(59, 36, 1, '20160507233533282675', '0.00', '0.00', '100.00', '5000.00', '4500.00', '', '2016-05-07 23:35:33'),
(60, 36, 1, '20160507233700738717', '0.00', '0.00', '100.00', '5000.00', '4400.00', '', '2016-05-07 23:37:00'),
(61, 28, 1, '20160508132225160699', '10.00', '0.00', '0.00', '80.00', '80.00', '', '2016-05-08 13:22:25'),
(62, 36, 1, '20160508153843840176', '0.00', '0.00', '-100.00', '5000.00', '4500.00', '', '2016-05-08 15:38:43'),
(63, 36, 1, '20160508164705219091', '0.00', '100.00', '-100.00', '4900.00', '4500.00', '', '2016-05-08 16:47:05'),
(64, 28, 1, '20160508195847732730', '10.00', '0.00', '0.00', '90.00', '90.00', '', '2016-05-08 19:58:47');

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) DEFAULT NULL COMMENT '会员组名称',
  `credit` int(11) NOT NULL COMMENT '信誉值分界线',
  `icon` varchar(255) NOT NULL COMMENT '分组图标',
  `caution_fee` int(3) NOT NULL COMMENT '保证金比率，0-100数',
  `free_fee` int(3) NOT NULL COMMENT '自由报盘费用比率',
  `depute_fee` int(3) NOT NULL COMMENT '委托报盘手续费比率',
  `create_time` datetime NOT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`id`, `group_name`, `credit`, `icon`, `caution_fee`, `free_fee`, `depute_fee`, `create_time`) VALUES
(1, '金牌用户', 500, 'upload/2016/04/18/20160418164725558.png@admin', 90, 80, 70, '2016-04-18 16:47:40');

-- --------------------------------------------------------

--
-- 表的结构 `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` text,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_session`
--

INSERT INTO `user_session` (`session_id`, `session_expire`, `session_data`) VALUES
('lnm90as9dlgqd2lqqn81g5gi56', 1462719035, 'a:4:{s:7:"user_id";s:2:"36";s:8:"username";s:10:"weipinglee";s:6:"mobile";s:11:"16767676767";s:4:"type";s:1:"1";}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
