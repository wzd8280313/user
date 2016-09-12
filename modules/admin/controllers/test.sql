create table if not exists `admin`(
  `id` int(11) unsigned not null auto_increment,
  `adminname` varchar(30) not null default '',
  `password` varchar(50) not null default '',
  `lever` varchar(30) not null default '',
  PRIMARY key(`id`)
)engine=innodb charset=utf8;
create table if not exists `user`(
  `id` int(11) unsigned not null auto_increment,
  `username` varchar(30) not null default '',
  `password` varchar(50) not null default '',
  `lever` varchar(30) not null default '',
  PRIMARY key(`id`)
)engine=innodb charset=utf8;