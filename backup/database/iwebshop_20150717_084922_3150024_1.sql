DROP TABLE IF EXISTS `shop_account_log`;
 CREATE TABLE `shop_account_log` (
`id` int(11) unsigned NOT NULL  PRIMARY KEY auto_increment,
`admin_id` int(11) unsigned NOT NULL  COMMENT '管理员ID',
`user_id` int(11) unsigned NOT NULL  COMMENT '用户id',
`type` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '0增加,1减少',
`event` tinyint(3) NOT NULL  COMMENT '操作类型，意义请看accountLog类',
`time` datetime NOT NULL  COMMENT '发生时间',
`amount` decimal(15,2) NOT NULL  COMMENT '金额',
`amount_log` decimal(15,2) NOT NULL  COMMENT '每次增减后面的金额记录',
`note` text NULL  DEFAULT NULL  COMMENT '备注'
 ) ENGINE=InnoDB CHARSET=utf8 COMMENT='账户余额日志表' AUTO_INCREMENT=2;

INSERT INTO `shop_account_log` VALUES
('1','1','1','0','1','2015-07-16 09:51:00','100.00','0.00','管理员[1]给用户[1]weiping充值，金额：100.00元');

