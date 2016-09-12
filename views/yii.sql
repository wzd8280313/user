create table article(
  `id` int(11) unsigned not null auto_increment,
  `title` varchar(20) not null default '',
  `content` varchar(255) not null default '',
  primary key(`id`)
)engine=innodb charset=utf8;