| shop_mobile_code | CREATE TABLE `shop_mobile_code` (
  `phone` varchar(13) NOT NULL COMMENT '手机号',
  `code` int(4) DEFAULT NULL COMMENT '验证码',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发送时间',
  `send_times` tinyint(2) NOT NULL DEFAULT '0' COMMENT '发送次数',
  PRIMARY KEY (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |
create table `shop_token`(
  `user_id` int(11) not null comment 'user_id',
  `token` varchar(50) not null comment '生成的令牌',
  `time` datetime not null default NOW() comment '时间',
  PRIMARY KEY(`user_id`)
)engine=innodb default charset=utf8;