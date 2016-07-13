<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/13
 * Time: 11:09
 */
namespace Model;

class GoodsModel extends \Think\Model{
   //自动完成
    protected $_auto=[
        ['add_time','time',1,'function'],
        ['upd_time','time',3,'function']
    ];

}