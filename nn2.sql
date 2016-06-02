-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-20 12:29:34
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nn`
--

DELIMITER $$
--
-- 函数
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getChildLists`(`rootId` INT) RETURNS varchar(1000) CHARSET utf8
BEGIN 
                   DECLARE sTemp VARCHAR(1000); 
                   DECLARE sTempChd VARCHAR(1000); 
                 
                   SET sTemp = '$'; 
                   SET sTempChd =cast(rootId as CHAR); 
                 
                   WHILE sTempChd is not null DO 
                     SET sTemp = concat(sTemp,',',sTempChd); 
                     SELECT group_concat(id) INTO sTempChd FROM nn.product_category where FIND_IN_SET(pid,sTempChd)>0; 
                   END WHILE; 
                   RETURN sTemp; 
                 END$$

DELIMITER ;

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
(0, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '2016-04-01 00:00:00', '', '127.0.0.1', '0000-00-00 00:00:00', 0, 'f0nupohrhn8ub4icds7s5ojjf3'),
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
(19, 'test_admin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 9, '2016-04-12 11:00:52', 'test_admin@qq.com', '::1', '2016-04-12 11:00:52', -1, '');

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
('f0nupohrhn8ub4icds7s5ojjf3', 1463741862, 'nn_99e11812b11fc882a54418bda023ba5f|b:0;nn_admin|a:3:{s:2:"id";s:1:"0";s:4:"name";s:5:"admin";s:4:"role";s:5:"ceshi";}');

-- --------------------------------------------------------

--
-- 表的结构 `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL COMMENT '代理商用户名',
  `mobile` varchar(13) NOT NULL COMMENT '代理商手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `company_name` varchar(40) NOT NULL COMMENT '公司名称',
  `area` varchar(6) NOT NULL COMMENT '地区',
  `contact` varchar(30) NOT NULL COMMENT '联系人',
  `contact_phone` varchar(13) NOT NULL COMMENT '联系电话',
  `address` varchar(100) NOT NULL COMMENT '详细地址',
  `serial_no` varchar(50) NOT NULL COMMENT '代理商序列号，用于用户注册',
  `status` tinyint(1) NOT NULL COMMENT '状态，0：关闭，1：启用',
  `create_time` datetime NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='代理商表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `agent`
--

INSERT INTO `agent` (`id`, `username`, `mobile`, `email`, `company_name`, `area`, `contact`, `contact_phone`, `address`, `serial_no`, `status`, `create_time`) VALUES
(2, 'test1', '18810194461', 'zengmaoyong@126.com', 'ceshi', '150303', '71112', '14444444', 'ttttttttt', '', 1, '2016-05-10 00:00:00'),
(3, 'wer', '14232323232', 'weiping.lee@163.com', 'sdfsdfsdf', '110102', '213', '14343434347', 'sdfsdfsdf', '', 0, '2016-05-20 16:47:26');

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
  `business` varchar(100) NOT NULL COMMENT '主营品种',
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

INSERT INTO `company_info` (`user_id`, `area`, `address`, `company_name`, `legal_person`, `reg_fund`, `category`, `nature`, `business`, `contact`, `contact_phone`, `contact_duty`, `check_taker`, `check_taker_phone`, `check_taker_add`, `deposit_bank`, `bank_acc`, `tax_no`, `cert_oc`, `cert_bl`, `cert_tax`, `qq`) VALUES
(8, '1202', NULL, '123324', 'SDFSDF', '44.00', 0, 0, '', '234234', '145343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '210303', NULL, '23423', '的方法', '123.00', 0, 0, '', '多大的', '1423343434', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '130102', NULL, '耐耐', '玩儿', '23.00', 0, 0, '', '快快快', '234234', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '140311', NULL, '白泉耐火', '赵总', '100.00', 1, 2, '', '张', '14323232323', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '140303', 'sdfsdf', 'weqwe', '张小j', '100.00', 1, 1, '', '王', '123123123', 1, '张张', '13534343434', '水电费水电费水电费', '了看见了看见', '112342342234234234', '1234234234234', 'filefromuser/2016/03/11/20160311071634276.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071631414.jpg@user@user@user@user@user@user@user@user@user@user@user', 'filefromuser/2016/03/11/20160311071637894.jpg@user@user@user@user@user@user@user@user@user@user@user', ''),
(36, '130102', 'sdfsdf', '一二十', '赵看', '200.00', 1, 1, '水电费', '果果', '15288888888', 1, 'asdasd', '13123123123', '13123', '123123123', '123123123123', '123123123', 'upload/2016/05/03/20160503153032859.jpg@user', 'upload/2016/05/03/20160503153028151.jpg@user', 'upload/2016/05/03/20160503153030911.jpg@user', '123123');

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
-- 表的结构 `credit_log`
--

CREATE TABLE IF NOT EXISTS `credit_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `datetime` datetime NOT NULL COMMENT '发生时间',
  `value` varchar(15) NOT NULL COMMENT '积分变化，增加正数，减少负数',
  `intro` text NOT NULL COMMENT '积分变化说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `credit_log`
--

INSERT INTO `credit_log` (`id`, `user_id`, `datetime`, `value`, `intro`) VALUES
(1, 48, '2016-05-17 16:01:04', '-1.50000', '0'),
(2, 48, '2016-05-17 16:01:32', '-1.50000', '他看见对方考虑'),
(3, 48, '2016-05-17 16:11:12', '-1.50000', '他看见对方考虑'),
(4, 48, '2016-05-17 16:11:22', '-1.50000', '他看见对方考虑'),
(5, 48, '2016-05-17 16:22:29', '-1.50000', '他看见对方考虑'),
(6, 48, '2016-05-17 17:07:15', '-1.50000', '他看见对方考虑');

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
(36, 2, '2016-05-20 17:24:15', '2016-05-20 17:24:22', NULL, ''),
(42, 2, '2016-04-13 15:20:48', '2016-05-12 12:32:15', NULL, ''),
(48, 2, '2016-05-17 12:44:54', '2016-05-18 09:36:18', NULL, '');

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
-- 表的结构 `entrust_order`
--

CREATE TABLE IF NOT EXISTS `entrust_order` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) unsigned NOT NULL COMMENT '报盘id',
  `order_no` varchar(50) NOT NULL,
  `num` decimal(15,2) NOT NULL COMMENT '购买数量',
  `amount` decimal(10,2) unsigned NOT NULL COMMENT '订单总额',
  `user_id` int(11) unsigned NOT NULL,
  `pay_deposit` decimal(10,2) unsigned DEFAULT NULL COMMENT '买方定金',
  `pay_retainage` decimal(10,2) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL COMMENT '1:余额支付',
  `contract_status` int(11) NOT NULL DEFAULT '0' COMMENT '合同状态 0:未形成3:等待支付尾款4:生效5:完成',
  `proof` varchar(100) DEFAULT NULL COMMENT '支付凭证',
  `create_time` datetime NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='委托摘牌';

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
-- 表的结构 `free_order`
--

CREATE TABLE IF NOT EXISTS `free_order` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) unsigned NOT NULL COMMENT '报盘id',
  `order_no` varchar(50) NOT NULL,
  `num` decimal(15,2) NOT NULL COMMENT '购买数量',
  `amount` decimal(10,2) unsigned NOT NULL COMMENT '订单总额',
  `user_id` int(11) unsigned NOT NULL,
  `pay_deposit` decimal(10,2) unsigned DEFAULT NULL COMMENT '买方定金',
  `pay_retainage` decimal(10,2) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL COMMENT '1:余额支付',
  `contract_status` int(11) NOT NULL DEFAULT '0' COMMENT '合同状态 0:未形成3:等待支付尾款4:生效5:完成',
  `proof` varchar(100) DEFAULT NULL COMMENT '支付凭证',
  `create_time` datetime NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仓单摘牌';

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `log_operation`
--

INSERT INTO `log_operation` (`id`, `author`, `action`, `content`, `datetime`) VALUES
(1, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:00:58'),
(2, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:01:19'),
(3, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:05:55'),
(4, 'admin', '处理了一个申请认证', '用户id:42', '2016-03-27 17:06:10'),
(5, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-04 10:31:00'),
(6, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-04 10:34:45'),
(7, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-04 14:26:45'),
(8, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-10 11:27:32'),
(9, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-10 11:32:20'),
(10, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-10 12:38:34'),
(11, 'admin', '处理了一个申请认证', '用户id:42', '2016-05-12 12:32:15'),
(12, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:28:10'),
(13, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:31:31'),
(14, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:38:58'),
(15, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:39:35'),
(16, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:39:36'),
(17, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:43:45'),
(18, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:44:55'),
(19, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:47:09'),
(20, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-13 16:47:40'),
(21, 'admin', '处理了一个申请认证', '用户id:48', '2016-05-17 12:35:27'),
(22, 'admin', '处理了一个申请认证', '用户id:48', '2016-05-18 09:36:18'),
(23, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:35:30'),
(24, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:35:49'),
(25, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:37:03'),
(26, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:50:14'),
(27, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:57:46'),
(28, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-19 15:58:23'),
(29, 'admin', '处理了一个申请认证', '用户id:36', '2016-05-20 17:24:22');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '消息标题',
  `content` text NOT NULL COMMENT '消息内容',
  `send_time` datetime DEFAULT NULL COMMENT '发送时间',
  `write_time` datetime DEFAULT NULL COMMENT '阅读时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- 表的结构 `order_sell`
--

CREATE TABLE IF NOT EXISTS `order_sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) unsigned NOT NULL COMMENT '报盘id',
  `mode` int(2) NOT NULL COMMENT '报盘模式',
  `order_no` varchar(50) NOT NULL,
  `num` decimal(15,2) NOT NULL COMMENT '购买数量',
  `amount` decimal(10,2) unsigned NOT NULL COMMENT '订单总额',
  `user_id` int(11) unsigned NOT NULL,
  `pay_deposit` decimal(10,2) unsigned DEFAULT NULL COMMENT '买方定金',
  `pay_retainage` decimal(10,2) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL COMMENT '1:余额支付',
  `contract_status` int(11) NOT NULL DEFAULT '0' COMMENT '合同状态 0:未形成1:等待卖家保证金2：合同作废3:等待支付尾款4:生效5:完成',
  `seller_deposit` decimal(10,2) DEFAULT NULL COMMENT '卖方支付保证金金额',
  `proof` varchar(100) DEFAULT NULL COMMENT '支付凭证',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='保证金摘牌' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `order_sell`
--

INSERT INTO `order_sell` (`id`, `offer_id`, `mode`, `order_no`, `num`, `amount`, `user_id`, `pay_deposit`, `pay_retainage`, `payment`, `contract_status`, `seller_deposit`, `proof`, `create_time`) VALUES
(1, 5, 0, '{0A4F6E0C-E443-408C-8089-5183734ABC07}', '10.00', '1230.00', 32, '12.30', '1217.70', NULL, 4, '1.00', NULL, '2016-04-29 09:52:20'),
(2, 8, 0, '{9BD946AD-398E-4CBF-A2A9-0DED189652A9}', '100.00', '1200.00', 36, '360.00', NULL, NULL, 3, NULL, NULL, '2016-05-11 13:28:15'),
(3, 8, 4, '{3855878B-567B-4E16-BD47-811F6095087C}', '100.00', '1200.00', 36, '360.00', NULL, NULL, 3, NULL, NULL, '2016-05-11 13:36:10'),
(4, 9, 2, '{E0427250-F1FA-4E18-AEE1-571A3AE36C55}', '23.00', '529.00', 36, NULL, NULL, NULL, 0, NULL, NULL, '2016-05-16 09:22:49'),
(5, 9, 2, '{0AADF874-3CDD-4343-95EE-6B82E39AB769}', '23.00', '529.00', 36, '105.80', NULL, NULL, 1, NULL, NULL, '2016-05-16 09:25:09');

-- --------------------------------------------------------

--
-- 表的结构 `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '支付名称',
  `class_name` varchar(50) NOT NULL COMMENT '支付类名称',
  `description` text COMMENT '描述',
  `logo` varchar(255) NOT NULL COMMENT '支付方式logo图片路径',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '安装状态 0启用 1禁用',
  `order` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `note` text COMMENT '支付说明',
  `poundage` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `poundage_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手续费方式 1百分比 2固定值',
  `config_param` text COMMENT '配置参数,json数据对象',
  `client_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PC端 2:移动端 3:通用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='支付方式表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `payment`
--

INSERT INTO `payment` (`id`, `name`, `class_name`, `description`, `logo`, `status`, `order`, `note`, `poundage`, `poundage_type`, `config_param`, `client_type`) VALUES
(2, '支付宝即时到帐', 'directAlipay', '即时到帐支付方式，买家的交易资金直接打入卖家支付宝账户，快速回笼交易资金。 <a href="http://www.alipay.com/" target="_blank">立即申请</a>', '/payments/logos/pay_alipay.gif', 1, 99, '', '0.00', 1, '{"M_PartnerId":"","M_PartnerKey":"","M_Email":""}', 1),
(3, '银联支付', 'unionpay', '银联unionpay平台接口。<a href="https://open.unionpay.com/ajweb/index" target="_blank">立即申请</a>', '/payments/logos/pay_unionpay.png', 0, 99, '', '0.00', 1, '{"M_merId":"777290058119131","M_certPwd":"000000"}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pay_log`
--

CREATE TABLE IF NOT EXISTS `pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_type` varchar(30) NOT NULL,
  `order_id` int(11) unsigned NOT NULL COMMENT '对应订单表id',
  `user_type` tinyint(4) NOT NULL COMMENT '0:买家1：卖家',
  `user_id` int(11) unsigned NOT NULL,
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `create_time` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='支付纪录' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `pay_log`
--

INSERT INTO `pay_log` (`id`, `pay_type`, `order_id`, `user_type`, `user_id`, `remark`, `create_time`) VALUES
(1, 'store_order', 5, 0, 36, '买方下单', '2016-05-11 11:27:47'),
(2, 'store_order', 5, 0, 36, '定金', '2016-05-11 11:27:48'),
(3, 'order_sell', 0, 0, 36, '买方下单', '2016-05-11 13:26:07'),
(4, 'order_sell', 2, 0, 36, '买方下单', '2016-05-11 13:28:15'),
(5, 'order_sell', 2, 0, 36, '定金', '2016-05-11 13:28:15'),
(6, 'order_sell', 3, 0, 36, '买方下单', '2016-05-11 13:36:10'),
(7, 'order_sell', 3, 0, 36, '定金', '2016-05-11 13:36:10'),
(8, 'order_sell', 4, 0, 36, '买方下单', '2016-05-16 09:22:49'),
(9, 'order_sell', 5, 0, 36, '买方下单', '2016-05-16 09:25:09'),
(10, 'order_sell', 5, 0, 36, '定金', '2016-05-16 09:25:09');

-- --------------------------------------------------------

--
-- 表的结构 `person_info`
--

CREATE TABLE IF NOT EXISTS `person_info` (
  `user_id` int(11) NOT NULL,
  `true_name` varchar(45) DEFAULT NULL,
  `area` varchar(6) NOT NULL COMMENT '地区',
  `address` varchar(200) NOT NULL COMMENT '地址',
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

INSERT INTO `person_info` (`user_id`, `true_name`, `area`, `address`, `sex`, `identify_no`, `identify_front`, `identify_back`, `birth`, `education`, `qq`, `zhichen`) VALUES
(33, '张', '', '', 0, '12323425445345345345', 'filefromuser/2016/03/11/20160311021721228.jpg@user', 'filefromuser/2016/03/11/20160311021724227.jpg@user', '2012-03-06', 0, '123123123', ''),
(37, 'sdfdf', '', '', 0, '123123123123123123', 'filefromuser/2016/03/12/20160312184419736.png@user', 'filefromuser/2016/03/12/20160312184422991.png@user', '2015-09-29', 0, '', ''),
(38, NULL, '', '', NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(39, NULL, '', '', NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(40, NULL, '', '', NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(41, NULL, '', '', NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, ''),
(42, 'qwe', '', '', 0, '1232354345345', 'filefromuser/2016/03/25/20160325085343348.jpg@user', 'filefromuser/2016/03/25/20160325085352495.jpg@user', '0000-00-00', 0, '123234234', '地方'),
(48, '李卫平', '130103', 'dsfsdf', NULL, '12334234234', 'upload/2016/05/17/20160517123434685.jpg@user', 'upload/2016/05/17/20160517123436391.jpg@user', NULL, NULL, NULL, ''),
(49, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(50, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '所属用户id',
  `name` varchar(45) DEFAULT NULL,
  `cate_id` int(11) NOT NULL COMMENT '商品分类',
  `attribute` text NOT NULL COMMENT '商品属性',
  `unit` varchar(20) NOT NULL DEFAULT '吨' COMMENT '单位',
  `price` decimal(15,2) NOT NULL COMMENT '单价',
  `produce_area` varchar(6) NOT NULL COMMENT '产地',
  `currency` int(2) NOT NULL DEFAULT '1' COMMENT '币种1：人民币',
  `quantity` decimal(15,5) NOT NULL COMMENT '总数量',
  `freeze` decimal(15,5) NOT NULL COMMENT '已冻结',
  `sell` decimal(15,5) NOT NULL COMMENT '已销售',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `expire_time` datetime DEFAULT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `note` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `cate_id`, `attribute`, `unit`, `price`, `produce_area`, `currency`, `quantity`, `freeze`, `sell`, `create_time`, `expire_time`, `sort`, `note`) VALUES
(1, 0, '水电费', 0, 's:0:"";', '吨', '123.00', '371423', 1, '22.00000', '0.00000', '0.00000', '2016-04-19 17:22:39', NULL, 0, '时代发生地方'),
(2, 0, 'tietie', 9, 'a:2:{i:3;s:2:"23";i:2;s:2:"90";}', '吨', '12.00', '350103', 1, '123.00000', '0.00000', '0.00000', '2016-04-19 17:29:29', NULL, 0, '3werwer'),
(3, 0, '1qw', 9, 'a:3:{i:4;s:1:"2";i:3;s:1:"3";i:2;s:1:"4";}', '吨', '23.00', '371311', 1, '123.00000', '0.00000', '0.00000', '2016-04-21 12:05:54', NULL, 0, '232323'),
(4, 0, '铝材', 9, 'a:3:{i:4;s:2:"23";i:3;s:2:"90";i:2;s:2:"24";}', '吨', '89.90', '422802', 1, '1222.00000', '0.00000', '0.00000', '2016-04-21 12:08:29', NULL, 0, '32是对方答复的方式'),
(7, 0, '高铝砖', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '0.00000', '0.00000', '2016-04-21 12:19:26', NULL, 0, '2稍等'),
(8, 0, '高铝砖', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '0.00000', '0.00000', '2016-04-21 12:24:36', NULL, 0, '2稍等'),
(9, 0, '高铝砖', 8, 'a:2:{i:2;s:2:"90";i:3;s:2:"12";}', '吨', '39.00', '350626', 1, '128.00000', '0.00000', '0.00000', '2016-04-21 12:24:56', NULL, 0, '2稍等'),
(10, 36, 'dsf', 8, 'a:2:{i:2;s:4:"2314";i:3;s:3:"234";}', '吨', '123.00', '130102', 1, '12.00000', '0.00000', '0.00000', '2016-04-26 15:12:40', NULL, 0, '213'),
(11, 48, '不锈钢', 8, 'a:2:{i:3;s:2:"12";i:2;s:3:"90%";}', '吨', '80.00', '130202', 1, '100.00000', '0.00000', '0.00000', '2016-04-28 09:13:53', NULL, 0, ''),
(12, 48, 'sdfs', 8, 'a:2:{i:2;s:3:"123";i:3;s:3:"123";}', '吨', '123.00', '130403', 1, '1234.00000', '0.00000', '0.00000', '2016-04-28 09:40:24', NULL, 0, 'werwer'),
(13, 48, 'wer', 6, 's:0:"";', '吨', '23.00', '130103', 1, '122.00000', '0.00000', '0.00000', '2016-04-28 16:51:29', NULL, 0, 'erewr'),
(14, 48, 'qwer', 8, 'a:2:{i:3;s:2:"13";i:2;s:2:"23";}', '吨', '123.00', '1202', 1, '12.00000', '0.00000', '0.00000', '2016-04-28 18:18:53', NULL, 0, '123'),
(15, 36, '好钢', 9, 'a:3:{i:4;s:2:"21";i:3;s:2:"23";i:2;s:3:"98%";}', '吨', '1909.00', '330203', 1, '1200.00000', '0.00000', '0.00000', '2016-04-29 09:27:25', NULL, 0, '123'),
(16, 36, '一级钢', 9, 'a:3:{i:4;s:1:"2";i:3;s:2:"12";i:2;s:6:"99.92%";}', '吨', '1206.00', '370103', 1, '1223.00000', '0.00000', '0.00000', '2016-04-29 09:32:07', NULL, 0, '第三方士大夫'),
(17, 36, '一级耐火材料', 2, 'a:2:{i:4;s:2:"12";i:3;s:2:"88";}', '吨', '900.00', '130102', 1, '1200.00000', '300.00000', '0.00000', '2016-04-29 09:33:59', NULL, 0, '发斯蒂芬'),
(18, 36, '金箍棒', 8, 'a:2:{i:2;s:2:"20";i:3;s:4:"99cm";}', '吨', '10000.00', '130102', 1, '1999.00000', '0.00000', '0.00000', '2016-05-09 15:03:06', NULL, 0, 'kjkkj'),
(19, 36, '12312', 8, 'a:2:{i:2;s:2:"23";i:3;s:2:"23";}', '吨', '23.00', '110228', 1, '23.00000', '23.00000', '0.00000', '2016-05-13 17:24:58', NULL, 0, ''),
(20, 36, '等等等等', 9, 'a:3:{i:4;s:2:"23";i:3;s:3:"121";i:2;s:2:"23";}', '吨', '12.00', '210202', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:26:45', NULL, 0, ''),
(21, 36, '等等等等', 9, 'a:3:{i:4;s:2:"23";i:3;s:3:"121";i:2;s:2:"23";}', '吨', '12.00', '210202', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:26:51', NULL, 0, ''),
(22, 36, '等等等等', 9, 'a:3:{i:4;s:2:"23";i:3;s:3:"121";i:2;s:2:"23";}', '吨', '12.00', '210202', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:26:52', NULL, 0, ''),
(23, 36, '等等等等', 9, 'a:3:{i:4;s:2:"23";i:3;s:3:"121";i:2;s:2:"23";}', '吨', '12.00', '210202', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:26:53', NULL, 0, ''),
(24, 36, '等等等等', 9, 'a:3:{i:4;s:2:"23";i:3;s:3:"121";i:2;s:2:"23";}', '吨', '12.00', '210202', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:31:45', NULL, 0, ''),
(25, 36, '哥哥哥哥', 8, 'a:2:{i:2;s:3:"345";i:3;s:3:"345";}', '吨', '12.00', '110102', 1, '12.00000', '0.00000', '0.00000', '2016-05-20 17:49:17', NULL, 0, ''),
(26, 36, '玩儿', 8, 'a:2:{i:3;s:2:"89";i:2;s:2:"89";}', '吨', '10.00', '130203', 1, '10.00000', '0.00000', '0.00000', '2016-05-20 17:50:46', NULL, 0, ''),
(27, 36, 'df', 8, 'a:2:{i:2;s:2:"23";i:3;s:2:"23";}', '吨', '12.00', '140303', 1, '10.00000', '0.00000', '0.00000', '2016-05-20 17:54:41', NULL, 0, ''),
(28, 36, '地方大幅度发', 8, 'a:2:{i:2;s:2:"34";i:3;s:1:"3";}', '吨', '2.00', '140203', 1, '100.00000', '0.00000', '0.00000', '2016-05-20 18:09:47', NULL, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '属性名称',
  `value` text NOT NULL COMMENT '可选的值，可以为空，多个以，相隔',
  `status` int(2) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '类型：1：输入框，2：单选，3：多选',
  `sort` int(11) NOT NULL COMMENT '排序',
  `note` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `name`, `value`, `status`, `type`, `sort`, `note`) VALUES
(1, 'Al含量', '', 1, 2, 2, ''),
(2, 'Fe含量', '', 1, 1, 2, ''),
(3, '长度', '', 1, 1, 4, ''),
(4, '宽度', '', 1, 1, 4, ''),
(5, 's含量', '', 1, 1, 6, ''),
(6, '第三方', '', 1, 1, 2, ''),
(7, '第三方', '', 1, 1, 2, ''),
(8, '第三方', '', 1, 1, 2, ''),
(9, 'lll', '3,5,4', 1, 2, 4, '');

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
  `is_del` int(2) NOT NULL COMMENT '0:正常，1：删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `childname`, `unit`, `percent`, `pid`, `attrs`, `sort`, `status`, `note`, `is_del`) VALUES
(1, '钢材', '种类', '顿', 20, 0, '2,3', 1, 1, '', 1),
(2, '耐材', '种类', '吨', 30, 0, '3,4', 1, 1, '', 0),
(3, '建材', '种类', '吨', 20, 0, '', 1, 1, '', 0),
(4, '热卷', '种类', 'kg', 20, 3, '', 1, 1, '', 0),
(5, '普卷', '种类', '', 0, 4, '', 1, 1, '', 0),
(6, '薄卷', '种类', '', 0, 4, '', 1, 1, '', 0),
(7, 'dsfd', '', '', 0, 1, '', 2, 1, '', 0),
(8, 'ddd', 'ddff', 'g', 2, 7, '', 4, 1, '', 0),
(9, '普卷', '种类', 'gd', 1, 7, '2,4', 1, 1, '', 0),
(10, '干干dd', '商品分类', 'g', 12, 0, '3', 3, 1, '', 0),
(11, '嘎嘎嘎', '商品分类', 'kg', 25, 2, '1,4,5', 4, 1, '', 0),
(12, 'sdf', '商品分类', 'dsf', 12, 0, '', 0, 1, '', 0),
(13, 'dfg', '商品分类', '23', 23, 0, '', 3, 1, '', 0),
(14, 'dfg', '商品分类', '23', 23, 0, '', 3, 1, '', 0),
(15, 'dfg', '商品分类', '23', 23, 0, '', 3, 1, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `product_offer`
--

CREATE TABLE IF NOT EXISTS `product_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '报盘类型：1：卖盘，2：买盘',
  `mode` int(2) NOT NULL COMMENT '报盘模式：1：自由，2：保证金，3，委托，4:仓单',
  `product_id` int(11) NOT NULL COMMENT '商品iD',
  `price` decimal(8,2) NOT NULL COMMENT '商品单价',
  `divide` int(2) NOT NULL COMMENT '是否拆分，0：可以，1：不可',
  `minimum` decimal(15,2) NOT NULL COMMENT '最小起订量',
  `accept_area` varchar(100) NOT NULL COMMENT '交收地点',
  `accept_day` int(6) NOT NULL COMMENT '交收时间',
  `acc_type` varchar(20) NOT NULL COMMENT '支付方式',
  `offer_fee` decimal(10,2) NOT NULL COMMENT '报盘费率',
  `sign` varchar(100) NOT NULL COMMENT '签字照片，委托报盘为委托书照片',
  `status` int(2) NOT NULL COMMENT '审核状态',
  `is_del` int(2) NOT NULL COMMENT '0:正常，1：删除',
  `apply_time` datetime DEFAULT NULL COMMENT '申请时间',
  `finish_time` datetime DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `product_offer`
--

INSERT INTO `product_offer` (`id`, `user_id`, `type`, `mode`, `product_id`, `price`, `divide`, `minimum`, `accept_area`, `accept_day`, `acc_type`, `offer_fee`, `sign`, `status`, `is_del`, `apply_time`, `finish_time`) VALUES
(1, 0, 1, 1, 1, '123.00', 1, '0.00', '当时发生的', 3, '', '0.00', '', 0, 0, '2016-04-19 17:22:39', NULL),
(2, 0, 1, 1, 2, '12.00', 1, '0.00', '123', 2, '', '0.00', '', 0, 0, '2016-04-19 17:29:29', NULL),
(3, 0, 1, 1, 0, '23.00', 1, '0.00', '213', 2, '', '0.00', '', 0, 0, '2016-04-21 12:05:54', NULL),
(4, 0, 1, 2, 0, '89.90', 0, '2.00', '23', 6, '', '0.00', '', 1, 0, '2016-04-21 12:08:29', NULL),
(5, 36, 1, 3, 15, '12.00', 1, '0.00', 'sdfsdf', 2, '', '0.00', '', 2, 0, '2016-04-26 15:54:02', NULL),
(6, 0, 1, 4, 15, '12.00', 1, '0.00', '123', 2, '', '0.00', '', 2, 0, '2016-04-29 09:24:38', NULL),
(7, 0, 1, 4, 17, '800.00', 0, '123.00', '山西阳泉', 4, '', '0.00', '', 1, 0, '2016-04-29 09:37:05', NULL),
(8, 36, 1, 4, 17, '12.00', 0, '100.00', '河北', 4, '', '0.00', '', 1, 0, '2016-05-09 16:11:51', NULL),
(9, 36, 1, 2, 19, '23.00', 1, '0.00', '123', 23, '', '0.00', '', 1, 0, '2016-05-13 17:24:58', NULL),
(10, 36, 1, 1, 20, '12.00', 1, '0.00', '324', 234, '1', '100.00', '', 0, 0, '2016-05-20 17:26:45', NULL),
(11, 36, 1, 1, 21, '12.00', 1, '0.00', '324', 234, '1', '100.00', '', 0, 0, '2016-05-20 17:26:51', NULL),
(12, 36, 1, 1, 22, '12.00', 1, '0.00', '324', 234, '1', '100.00', '', 0, 0, '2016-05-20 17:26:52', NULL),
(13, 36, 1, 1, 23, '12.00', 1, '0.00', '324', 234, '1', '100.00', '', 0, 0, '2016-05-20 17:26:53', NULL),
(14, 36, 1, 1, 24, '12.00', 1, '0.00', '324', 234, '1', '100.00', '', 0, 0, '2016-05-20 17:31:45', NULL),
(15, 36, 1, 1, 25, '12.00', 1, '0.00', '324', 3, '1', '0.00', '', 0, 0, '2016-05-20 17:49:17', NULL),
(16, 36, 1, 1, 26, '10.00', 1, '0.00', '123', 12, '1', '0.00', '', 0, 0, '2016-05-20 17:50:46', NULL),
(17, 36, 1, 1, 27, '12.00', 1, '0.00', '12', 1, '1', '24.00', '', 1, 0, '2016-05-20 17:54:41', NULL),
(18, 36, 1, 3, 28, '2.00', 1, '0.00', '123', 1, '', '0.00', 'upload/2016/05/20/20160520180916632.jpg@user', 0, 0, '2016-05-20 18:09:47', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `product_photos`
--

CREATE TABLE IF NOT EXISTS `product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

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
(8, 'upload/2016/04/26/20160426151236614.jpg@user', 10),
(9, 'upload/2016/04/26/20160426151237580.jpg@user', 10),
(10, 'upload/2016/04/28/20160428091345128.jpg@user', 11),
(11, 'upload/2016/04/28/20160428094019834.jpg@user', 12),
(12, 'upload/2016/04/28/20160428094019406.jpg@user', 12),
(13, 'upload/2016/04/28/20160428165119212.jpg@user', 13),
(14, 'upload/2016/04/28/20160428165119817.jpg@user', 13),
(15, 'upload/2016/04/28/20160428181848719.jpg@user', 14),
(16, 'upload/2016/04/29/20160429092719122.jpg@user', 15),
(17, 'upload/2016/04/29/20160429092719822.jpg@user', 15),
(18, 'upload/2016/04/29/20160429093134261.jpg@user', 16),
(19, 'upload/2016/04/29/20160429093145307.jpg@user', 16),
(20, 'upload/2016/04/29/20160429093145256.jpg@user', 16),
(21, 'upload/2016/04/29/20160429093352139.jpg@user', 17),
(22, 'upload/2016/04/29/20160429093352350.jpg@user', 17),
(23, 'upload/2016/04/29/20160429093352507.jpg@user', 17),
(24, 'upload/2016/05/09/20160509150149589.jpg@user', 18),
(25, 'upload/2016/05/20/20160520172639199.jpg@user', 20),
(26, 'upload/2016/05/20/20160520172639199.jpg@user', 21),
(27, 'upload/2016/05/20/20160520172639199.jpg@user', 22),
(28, 'upload/2016/05/20/20160520172639199.jpg@user', 23),
(29, 'upload/2016/05/20/20160520172639199.jpg@user', 24),
(30, 'upload/2016/05/20/20160520174911288.jpg@user', 25),
(31, 'upload/2016/05/20/20160520175436103.jpg@user', 27),
(32, 'upload/2016/05/20/20160520180940302.jpg@user', 28);

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
-- 表的结构 `recharge_order`
--

CREATE TABLE IF NOT EXISTS `recharge_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `order_no` varchar(50) NOT NULL COMMENT '订单序号，',
  `amount` decimal(10,2) NOT NULL COMMENT '充值金额',
  `pay_type` int(2) NOT NULL COMMENT '支付方式，1：线下，2：支付宝，3：银联',
  `proot` varchar(100) NOT NULL DEFAULT '' COMMENT '线下支付支付凭证，线上支付为\r\n第三方支付平台返回的流水号',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '支付状态，0：申请，1：成功',
  `create_time` datetime DEFAULT NULL COMMENT '申请时间',
  `first_time` datetime DEFAULT NULL COMMENT '初审时间',
  `first_message` text NOT NULL COMMENT '初审意见',
  `final_time` datetime DEFAULT NULL COMMENT '终审时间',
  `final_message` text NOT NULL COMMENT '终审意见',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除，0：否，1：是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `recharge_order`
--

INSERT INTO `recharge_order` (`id`, `user_id`, `order_no`, `amount`, `pay_type`, `proot`, `status`, `create_time`, `first_time`, `first_message`, `final_time`, `final_message`, `is_del`) VALUES
(1, 1, 'recharge20160505094216971737', '0.00', 3, ' ', 0, '2016-05-05 09:42:16', NULL, '', NULL, '', 0),
(2, 1, 'recharge20160505094436506164', '0.00', 2, ' ', 0, '2016-05-05 09:44:36', NULL, '', NULL, '', 0),
(4, 1, 'recharge20160505095107690789', '5.00', 2, ' ', 0, '2016-05-05 09:51:07', NULL, '', NULL, '', 0),
(5, 1, 'recharge20160505113323175558', '56.00', 1, 'upload/2016/05/05/20160505113323737.jpg', 2, '2016-05-05 11:33:23', '2016-05-12 12:34:18', '', NULL, '', 0),
(6, 1, 'recharge20160505134704342907', '4.00', 1, 'upload/2016/05/05/20160505134704156.jpg@user', 2, '2016-05-05 13:47:04', '2016-05-05 17:32:11', '', NULL, '', 0),
(7, 36, 'recharge20160505173529698672', '3434.00', 1, 'upload/2016/05/05/20160505173529953.jpg@user', 4, '2016-05-05 17:35:29', '2016-05-05 17:35:56', '', '2016-05-05 17:39:20', '不清晰', 0),
(8, 36, 'recharge20160505173808155041', '1000.00', 1, 'upload/2016/05/05/20160505173808535.jpg@user', 1, '2016-05-05 17:38:08', '2016-05-05 17:38:58', 'dfgdfg', '2016-05-05 17:39:44', '', 0),
(9, 36, 'recharge20160505174042417752', '200.00', 1, 'upload/2016/05/05/20160505174041708.jpg@user', 1, '2016-05-05 17:40:42', '2016-05-05 17:41:03', 'ok', '2016-05-05 17:41:13', '通过', 0),
(10, 36, 'recharge20160505174247466394', '700.00', 1, 'upload/2016/05/05/20160505174247679.jpg@user', 1, '2016-05-05 17:42:47', '2016-05-05 17:42:59', '二恶', '2016-05-05 17:43:05', '', 1),
(11, 36, 'recharge20160506082846882968', '100.00', 1, 'upload/2016/05/06/20160506082846540.jpg@user', 1, '2016-05-06 08:28:46', '2016-05-06 08:29:07', '初审通过', '2016-05-06 08:35:45', '', 1),
(12, 36, 'recharge20160506101656827624', '90.00', 1, 'upload/2016/05/06/20160506101655995.jpg@user', 1, '2016-05-06 10:16:56', '2016-05-06 10:17:24', '', '2016-05-06 10:17:28', '', 0),
(13, 36, 'recharge20160516171907684115', '2.00', 1, 'upload/2016/05/16/20160516171905655.jpg@user', 1, '2016-05-16 17:19:07', '2016-05-16 17:20:01', '', '2016-05-16 17:20:26', '', 0);

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
  `is_del` int(2) NOT NULL COMMENT '0:正常，1：删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `store_list`
--

INSERT INTO `store_list` (`id`, `name`, `short_name`, `area`, `address`, `service_phone`, `service_address`, `contact`, `contact_phone`, `type`, `note`, `status`, `img`, `is_del`) VALUES
(1, '一号店', 'yi', '230303', '点开看看7', '123234545', 'dfgdfgdfg', '赵看看', '13434343439', 1, '水电费水电费水电费法国恢复供货', 1, '', 1),
(2, '地方', '二 分', '130202', '第三方士大夫的', '2323232', '2的孙菲菲', '3多少', '1434343434', 0, '', 1, '', 0);

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
  `message` text NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `store_manager`
--

INSERT INTO `store_manager` (`user_id`, `status`, `apply_time`, `verify_time`, `admin_id`, `store_id`, `message`) VALUES
(36, 1, '2016-05-20 12:50:03', '2016-05-19 15:50:14', NULL, 1, ''),
(42, 0, '2016-03-12 23:05:44', NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `store_order`
--

CREATE TABLE IF NOT EXISTS `store_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) unsigned NOT NULL COMMENT '报盘id',
  `order_no` varchar(50) NOT NULL,
  `num` decimal(15,2) NOT NULL COMMENT '购买数量',
  `amount` decimal(10,2) unsigned NOT NULL COMMENT '订单总额',
  `user_id` int(11) unsigned NOT NULL,
  `pay_deposit` decimal(10,2) unsigned DEFAULT NULL COMMENT '买方定金',
  `pay_retainage` decimal(10,2) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL COMMENT '1:余额支付',
  `contract_status` int(11) NOT NULL DEFAULT '0' COMMENT '合同状态 0:未形成3:等待支付尾款4:生效5:完成',
  `proof` varchar(100) DEFAULT NULL COMMENT '支付凭证',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='仓单摘牌' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `store_order`
--

INSERT INTO `store_order` (`id`, `offer_id`, `order_no`, `num`, `amount`, `user_id`, `pay_deposit`, `pay_retainage`, `payment`, `contract_status`, `proof`, `create_time`) VALUES
(1, 8, '{4B82A515-5DA6-489E-B070-383F409DD4E2}', '100.00', '1200.00', 36, NULL, NULL, NULL, 0, NULL, '2016-05-11 11:01:04'),
(2, 8, '{84614893-D669-4C04-AB55-D6496161169C}', '100.00', '1200.00', 36, NULL, NULL, NULL, 0, NULL, '2016-05-11 11:02:14'),
(3, 8, '{1AE6B300-5EC9-4809-A7FF-2A553D8A182F}', '100.00', '1200.00', 36, NULL, NULL, NULL, 0, NULL, '2016-05-11 11:03:14'),
(4, 8, '{F9FDB591-9078-4115-AFDE-26DA0236EB72}', '100.00', '1200.00', 36, NULL, NULL, NULL, 0, NULL, '2016-05-11 11:19:51'),
(5, 8, '{1C824556-99A1-4882-915A-6EDA34BC8897}', '100.00', '1200.00', 36, '360.00', NULL, NULL, 3, NULL, '2016-05-11 11:27:47');

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
  `cang_pos` varchar(100) NOT NULL COMMENT '仓位',
  `package` int(2) NOT NULL COMMENT '是否包装',
  `package_unit` varchar(20) NOT NULL COMMENT '包装单位',
  `package_num` int(11) NOT NULL COMMENT '包装数量',
  `package_weight` decimal(8,5) NOT NULL COMMENT '包装重量',
  `status` int(2) NOT NULL COMMENT '审核状态',
  `is_offer` int(2) NOT NULL COMMENT '0：未报盘，1：已报盘',
  `apply_time` datetime NOT NULL COMMENT '申请时间',
  `manager_time` datetime DEFAULT NULL COMMENT '仓库管理员审核时间',
  `sign_time` datetime DEFAULT NULL COMMENT '仓单签发时间',
  `user_time` datetime DEFAULT NULL COMMENT '用户确认时间',
  `market_time` datetime DEFAULT NULL COMMENT '市场审核时间',
  `in_time` datetime NOT NULL COMMENT '入库时间',
  `rent_time` datetime NOT NULL COMMENT '租库时间',
  `finish_time` datetime NOT NULL COMMENT '完成时间',
  `expire_time` datetime NOT NULL COMMENT '失效日期',
  `check_org` varchar(50) NOT NULL COMMENT '检测机构',
  `check_no` varchar(100) NOT NULL COMMENT '证书编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `store_products`
--

INSERT INTO `store_products` (`id`, `user_id`, `store_id`, `product_id`, `store_pos`, `cang_pos`, `package`, `package_unit`, `package_num`, `package_weight`, `status`, `is_offer`, `apply_time`, `manager_time`, `sign_time`, `user_time`, `market_time`, `in_time`, `rent_time`, `finish_time`, `expire_time`, `check_org`, `check_no`) VALUES
(1, 0, 0, 7, '123', '', 0, '', 0, '0.00000', 1, 0, '2016-04-21 12:19:26', NULL, NULL, NULL, NULL, '2016-04-28 00:00:00', '2016-04-29 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(2, 0, 1, 8, '', '', 0, '', 0, '0.00000', 1, 0, '2016-04-21 12:24:36', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(3, 36, 1, 9, '', '', 0, '', 12, '23.00000', 4, 0, '2016-04-21 12:24:56', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(4, 36, 1, 10, '', '', 0, '', 0, '0.00000', 4, 0, '2016-04-26 15:12:40', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(5, 48, 1, 11, '', '', 0, '', 0, '0.00000', 21, 0, '2016-04-28 09:13:53', '2016-05-16 17:25:38', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(6, 36, 1, 12, '', '', 0, '', 0, '0.00000', 31, 0, '2016-04-28 09:40:24', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(7, 36, 1, 13, '', '', 0, '', 0, '0.00000', 31, 0, '2016-04-28 16:51:29', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(8, 48, 1, 14, '123', '', 0, '', 0, '0.00000', 31, 0, '2016-04-28 18:18:53', NULL, NULL, NULL, NULL, '2016-04-28 00:00:00', '2016-04-28 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(9, 36, 1, 15, '', '', 0, '', 0, '0.00000', 0, 0, '2016-04-29 09:27:25', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(10, 36, 1, 16, '', '', 1, '', 0, '0.00000', 22, 0, '2016-04-29 09:32:07', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(11, 36, 1, 17, '1号位', '', 0, '', 0, '0.00000', 31, 1, '2016-04-29 09:33:59', NULL, NULL, NULL, NULL, '2016-04-29 00:00:00', '2016-04-27 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(12, 36, 1, 18, 'x5', '', 1, '', 0, '0.00000', 31, 0, '2016-05-09 15:03:06', '2016-05-09 15:04:07', '2016-05-09 15:05:02', '2016-05-09 15:07:53', '2016-05-09 15:37:46', '2016-05-09 00:00:00', '2016-05-08 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

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
  `credit` decimal(15,2) NOT NULL COMMENT '会员信誉值',
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
  `cert_status` int(2) NOT NULL DEFAULT '0' COMMENT '0:认证未改变，1：认证发生改变',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `type`, `username`, `password`, `credit`, `mobile`, `email`, `head_photo`, `pid`, `roles`, `status`, `agent`, `agent_pass`, `create_time`, `login_time`, `session_id`, `cert_status`) VALUES
(28, 1, 'fgertertert', '601f1889667efaebb33b8c12572835da3f027f78', '0.00', '456345345345', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, '', 0),
(29, 1, 'bnfghfghfh', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '567456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, '', 0),
(31, 1, 'weipinglee33', '601f1889667efaebb33b8c12572835da3f027f78', '0.00', '456456456', '', NULL, NULL, NULL, NULL, 3, '12334234234', NULL, NULL, '285dnb0demflhc3n7sca0n95m2', 0),
(32, 0, 'adminkkk', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '12323232323', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, '4odd8sfrcfacopn2j72c88qf64', 0),
(33, 0, 'wplee', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '12323232328', '', '@user', NULL, NULL, NULL, 0, '0', NULL, NULL, '5buhd54rqajbajsfumkgr9ijb4', 0),
(34, 1, 'wplee127', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '14523232323', '', NULL, NULL, NULL, NULL, 3, '123123', NULL, NULL, '8qgb5uv4h90s5vlsu1ddr8pr22', 0),
(35, 1, '123qwe', 'c53255317bb11707d0f614696b3ce6f221d0e2f2', '0.00', '13434343434', '', 'filefromuser/2016/03/11/20160311074729915.jpg@user@user', NULL, NULL, NULL, 4, 'sdfsdfsdf', NULL, NULL, 'd6dr0opqrvgejc72khn3qoli91', 0),
(36, 1, 'weipinglee', '05fe7461c607c33229772d402505601016a7d0ea', '350.00', '16767676767', '123123d@13.com', 'filefromuser/2016/03/19/20160319100358393.jpg@user', 0, NULL, NULL, 4, '1233124', NULL, NULL, 'f0nupohrhn8ub4icds7s5ojjf3', 0),
(37, 0, 'geren', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '14334343434', '', '', NULL, NULL, NULL, 0, '0', NULL, NULL, '', 0),
(39, 0, 'kljklj', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '15454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, 'ekp720eh5rqapk3ftfp87o3is5', 0),
(40, 0, 'kljlkjlkji', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '14454545454', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, '', 0),
(41, 0, 'weimama', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '12323232329', '', NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, '', 0),
(42, 0, 'gerenyonghu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0.00', '16767676760', '', 'filefromuser/2016/03/12/20160312193238190.png@user', 0, NULL, NULL, 0, '0', NULL, NULL, 'fhhhacsj5rihilp4d8tu3anca2', 1),
(43, 0, 'weipine12', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '15323232323', 'weeer@133.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, '', 0),
(44, 0, 'weiping12', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '12345678945', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, '', 0),
(45, 0, 'weiping17', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '17878654325', '123@1234.com', NULL, 36, NULL, NULL, 0, '', NULL, NULL, '', 0),
(46, 0, 'weipinglee1234', '601f1889667efaebb33b8c12572835da3f027f78', '0.00', '13423564589', 'werewr@153.cid', NULL, 36, NULL, NULL, 0, '', NULL, NULL, '', 0),
(47, 0, 'weiping987', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0.00', '12398765439', 'werewr@153.cid', 'filefromuser/2016/03/19/20160319112602131.jpg@user', 36, NULL, 1, 0, '', NULL, NULL, '', 0),
(48, 0, 'weipinglee111', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '15296631253', '', NULL, 0, NULL, NULL, 0, '', NULL, NULL, '', 0),
(49, 0, 'weipingleeqe', '05fe7461c607c33229772d402505601016a7d0ea', '0.00', '15296631254', '', NULL, 0, NULL, NULL, 0, '', NULL, NULL, '', 0),
(50, 0, 'wplee123', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0.00', '15234343434', '', NULL, 0, NULL, NULL, 1, '', NULL, NULL, '', 0);

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
(28, '140.00', '0.00', '0.00', '0.00', '0.00'),
(32, '8783.00', '1235.00', '0.00', '0.00', '0.00'),
(36, '540.20', '2526.80', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `user_bank`
--

CREATE TABLE IF NOT EXISTS `user_bank` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `bank_name` varchar(50) NOT NULL COMMENT '银行名称',
  `card_type` int(2) NOT NULL DEFAULT '1' COMMENT '1,借记卡，2：信用卡',
  `card_no` varchar(50) NOT NULL COMMENT '卡号',
  `true_name` varchar(20) NOT NULL COMMENT '姓名',
  `identify_no` varchar(25) NOT NULL COMMENT '身份证号',
  `proof` varchar(100) NOT NULL COMMENT '打款凭证',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_bank`
--

INSERT INTO `user_bank` (`user_id`, `bank_name`, `card_type`, `card_no`, `true_name`, `identify_no`, `proof`) VALUES
(36, '中国银行', 1, '12312312312312313', '赵 看二', '123324234234234', 'upload/2016/05/16/20160516164002531.jpg@user');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

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
(53, 28, 1, '20160428090408212033', '10.00', '0.00', '0.00', '60.00', '60.00', '', '2016-04-28 09:04:08'),
(54, 32, 1, '20160429102703870223', '0.00', '0.00', '12.30', '87.00', '69.70', '', '2016-04-29 10:27:03'),
(55, 36, 1, '20160429103856266607', '0.00', '0.00', '1.00', '1000.00', '999.00', '', '2016-04-29 10:38:56'),
(56, 32, 1, '20160429104811441262', '0.00', '0.00', '1217.70', '10018.00', '8783.00', '', '2016-04-29 10:48:11'),
(59, 36, 1, '20160506083545391137', '100.00', '0.00', '0.00', '1100.00', '1099.00', '', '2016-05-06 08:35:45'),
(60, 36, 1, '20160506101728969046', '90.00', '0.00', '0.00', '1190.00', '1189.00', '', '2016-05-06 10:17:28'),
(61, 28, 1, '20160510103108720343', '10.00', '0.00', '0.00', '70.00', '70.00', '', '2016-05-10 10:31:08'),
(62, 28, 1, '20160510110453518798', '10.00', '0.00', '0.00', '80.00', '80.00', '', '2016-05-10 11:04:53'),
(63, 28, 1, '20160510122808289514', '10.00', '0.00', '0.00', '90.00', '90.00', '', '2016-05-10 12:28:08'),
(64, 36, 1, '20160510140527979180', '0.00', '0.00', '400.00', '1190.00', '789.00', '', '2016-05-10 14:05:27'),
(65, 36, 1, '20160510141229489657', '0.00', '0.00', '40.00', '1190.00', '749.00', '', '2016-05-10 14:12:29'),
(66, 36, 1, '20160510141644388775', '0.00', '0.00', '400.00', '1190.00', '349.00', '', '2016-05-10 14:16:44'),
(67, 36, 1, '20160510144331609161', '0.00', '0.00', '1.00', '1190.00', '348.00', '', '2016-05-10 14:43:31'),
(68, 36, 1, '20160510162424887857', '0.00', '1.00', '-1.00', '1189.00', '348.00', '', '2016-05-10 16:24:24'),
(69, 36, 1, '20160510162630385699', '0.00', '0.00', '200.00', '1189.00', '148.00', '', '2016-05-10 16:26:30'),
(70, 36, 1, '20160510162725857781', '0.00', '200.00', '-200.00', '989.00', '148.00', '', '2016-05-10 16:27:25'),
(75, 36, 1, '20160511112748311706', '0.00', '0.00', '360.00', '1989.00', '788.00', '', '2016-05-11 11:27:48'),
(76, 36, 1, '20160511132815232357', '0.00', '0.00', '360.00', '1989.00', '428.00', '', '2016-05-11 13:28:15'),
(77, 36, 1, '20160511133610245568', '0.00', '0.00', '360.00', '1989.00', '68.00', '', '2016-05-11 13:36:10'),
(78, 28, 1, '20160511140215734240', '10.00', '0.00', '0.00', '100.00', '100.00', '', '2016-05-11 14:02:15'),
(79, 28, 1, '20160511140541400942', '10.00', '0.00', '0.00', '110.00', '110.00', '', '2016-05-11 14:05:41'),
(80, 28, 1, '20160511140953112661', '10.00', '0.00', '0.00', '120.00', '120.00', '', '2016-05-11 14:09:53'),
(81, 28, 1, '20160511141341560162', '10.00', '0.00', '0.00', '130.00', '130.00', '', '2016-05-11 14:13:41'),
(82, 28, 1, '20160511142025124884', '10.00', '0.00', '0.00', '140.00', '140.00', '', '2016-05-11 14:20:25'),
(83, 36, 1, '20160516092509249716', '0.00', '0.00', '105.80', '3089.00', '1062.20', '', '2016-05-16 09:25:09'),
(84, 36, 1, '20160516172026900738', '2.00', '0.00', '0.00', '3091.00', '1064.20', '', '2016-05-16 17:20:26'),
(85, 36, 1, '20160520172645177261', '0.00', '0.00', '100.00', '3091.00', '964.20', '', '2016-05-20 17:26:45'),
(86, 36, 1, '20160520172651499023', '0.00', '0.00', '100.00', '3091.00', '864.20', '', '2016-05-20 17:26:51'),
(87, 36, 1, '20160520172652603585', '0.00', '0.00', '100.00', '3091.00', '764.20', '', '2016-05-20 17:26:52'),
(88, 36, 1, '20160520172653207501', '0.00', '0.00', '100.00', '3091.00', '664.20', '', '2016-05-20 17:26:53'),
(89, 36, 1, '20160520173145656814', '0.00', '0.00', '100.00', '3091.00', '564.20', '', '2016-05-20 17:31:45'),
(90, 36, 1, '20160520174917680902', '0.00', '0.00', '0.00', '3091.00', '564.20', '', '2016-05-20 17:49:17'),
(91, 36, 1, '20160520175046908264', '0.00', '0.00', '0.00', '3091.00', '564.20', '', '2016-05-20 17:50:46'),
(92, 36, 1, '20160520175441901644', '0.00', '0.00', '24.00', '3091.00', '540.20', '', '2016-05-20 17:54:41'),
(93, 36, 1, '20160520175540641873', '0.00', '24.00', '-24.00', '3067.00', '540.20', '', '2016-05-20 17:55:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`id`, `group_name`, `credit`, `icon`, `caution_fee`, `free_fee`, `depute_fee`, `create_time`) VALUES
(1, '金牌用户', 500, 'upload/2016/04/18/20160418164725558.png@admin', 90, 80, 70, '2016-04-18 16:47:40'),
(2, '银牌会员', 400, 'upload/2016/05/18/20160518100649209.jpg@admin', 50, 30, 10, '2016-05-18 10:07:02'),
(3, '铜牌', 300, 'upload/2016/05/18/20160518100724258.jpg@admin', 30, 20, 17, '2016-05-18 10:07:34'),
(4, '铁牌会员', 200, 'upload/2016/05/18/20160518100757961.jpg@admin', 20, 18, 15, '2016-05-18 10:08:03'),
(5, '普通会员', 0, 'upload/2016/05/18/20160518100827881.jpg@admin', 12, 14, 14, '2016-05-18 10:08:31');

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
('f0nupohrhn8ub4icds7s5ojjf3', 1463743433, 'a:4:{s:7:"user_id";s:2:"36";s:8:"username";s:10:"weipinglee";s:6:"mobile";s:11:"16767676767";s:9:"user_type";s:1:"1";}');

-- --------------------------------------------------------

--
-- 表的结构 `withdraw_request`
--

CREATE TABLE IF NOT EXISTS `withdraw_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `request_no` varchar(50) NOT NULL COMMENT '订单号',
  `amount` decimal(10,2) NOT NULL COMMENT '提现金额',
  `acc_name` varchar(20) NOT NULL COMMENT '开户名',
  `bank_name` varchar(50) NOT NULL COMMENT '银行',
  `back_card` varchar(40) NOT NULL COMMENT '银行卡号',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '提现说明',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '申请状态',
  `create_time` datetime DEFAULT NULL COMMENT '申请时间',
  `first_time` datetime DEFAULT NULL COMMENT '初审时间',
  `first_message` text COMMENT '初审意见',
  `final_time` datetime DEFAULT NULL COMMENT '终审时间',
  `final_message` text COMMENT '终审意见',
  `proot` varchar(100) NOT NULL DEFAULT '' COMMENT '后台打款凭证',
  `is_del` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0:未删除，1：删除,默认0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `withdraw_request`
--

INSERT INTO `withdraw_request` (`id`, `user_id`, `request_no`, `amount`, `acc_name`, `bank_name`, `back_card`, `note`, `status`, `create_time`, `first_time`, `first_message`, `final_time`, `final_message`, `proot`, `is_del`) VALUES
(1, 36, 'gold_20160510140527391494', '400.00', '123', '建设银行', '123324234234', '', 1, '2016-05-10 14:05:27', '2016-05-10 15:23:06', '', '2016-05-10 15:23:10', '', 'upload/2016/05/10/20160510152348616.jpg@admin', 0),
(2, 36, 'gold_20160510141229526983', '40.00', '123', '建设银行', '123324234234', '', 1, '2016-05-10 14:12:29', '2016-05-10 15:16:29', '', '2016-05-10 15:16:33', '', 'upload/2016/05/10/20160510151837658.jpg@admin', 0),
(3, 36, 'gold_20160510141644779312', '400.00', '123', '建设银行', '123324234234', '', 5, '2016-05-10 14:16:44', '2016-05-10 14:57:59', '', '2016-05-10 14:58:10', '', '', 1),
(4, 36, 'gold_20160510144331144522', '1.00', 'hhh', '建设银行', '23445354', '', 1, '2016-05-10 14:43:31', '2016-05-10 15:01:31', '', '2016-05-10 15:02:32', '', 'upload/2016/05/10/20160510162015592.jpg', 0),
(5, 36, 'gold_20160510162629806118', '200.00', '李卫平', '建设银行', '123123123123', '', 1, '2016-05-10 16:26:30', '2016-05-10 16:27:11', '', '2016-05-10 16:27:16', '', 'upload/2016/05/10/20160510162724361.jpg@admin', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
