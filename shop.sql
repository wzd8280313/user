create database shop_43 charset=utf8;
use shop_43;
create table sp_goods(
	goods_id mediumint unsigned not null auto_increment comment '主键id',
	goods_name varchar(64) not null comment '商品名称',
	goods_shop_price decimal(10,2) not null default 0 comment '商品价格',
	goods_number smallint not null default 0 comment '商品数量',
	goods_weight decimal(10,2) not null default 0 comment '重量，单位克',
	goods_big_logo char(32) not null default '' comment '商品大图',
	goods_small_logo char(32) not null default '' comment '商品小图',
	cat_id mediumint unsigned not null default 0 comment '商品分类',
	brand_id mediumint unsigned not null default 0 comment '商品品牌',
	goods_is_sale enum('出售','停售') not null default '出售' comment '是否在售',
	goods_introduce text comment '商品详情',
	goods_is_qiang enum('抢','不抢') not null default '不抢' comment '是否再抢',
	goods_is_hot enum('热','不热') not null default '不热' comment '是否热卖',
	goods_is_rec enum('推荐','不推荐') not null default '不推荐' comment '是否推荐',
	goods_is_new enum('新品','不新品') not null default '不新品' comment '是否新品',
	mg_id mediumint unsigned not null default 0 comment '操作者',
	is_del enum('正常','删除') not null default '正常' comment '是否删除',
	add_time int unsigned not null comment '添加时间',
	upd_time int unsigned not null comment '修改时间',
	primary key(`goods_id`),
	key(goods_name),
	key(goods_shop_price),
	key(cat_id),
	key(brand_id),
	key(mg_id),
	key(is_del)
	)engine=Innodb charset=utf8 comment '商品数据表'; 