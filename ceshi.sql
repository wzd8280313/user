create table iwebshop_test(
	id int not null auto_increment,
	name varchar(32) default '',
	password varchar(32) default '',
	image_ori varchar(255) not null default '',
	image  varchar(255) not null default '',
	primary key(`id`)

)engine=Innodb charset=utf8;
insert into iwebshop_test values(1,'asda','asdaa','asdaa','addad');