<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 17:01
 */

namespace app\modules\admin\controllers;
use yii\web\Controller;

class IndexController extends Controller
{
    public  $layout=false;
    public function actionIndex(){

        return $this->renderPartial('index');
    }
    public function actionHead(){
       return  $this->renderPartial('head');
    }
    public function actionLeft(){
       return  $this->renderPartial('left');
    }
    public function actionMain(){
       return  $this->renderPartial('main');
    }
    public function actionTest(){
        $prize_arr = array(
            '0' => array('id'=>1,'prize'=>'平板电脑','v'=>1),
            '1' => array('id'=>2,'prize'=>'数码相机','v'=>5),
            '2' => array('id'=>3,'prize'=>'音箱设备','v'=>10),
            '3' => array('id'=>4,'prize'=>'4G优盘','v'=>12),
            '4' => array('id'=>5,'prize'=>'10Q币','v'=>22),
            '5' => array('id'=>6,'prize'=>'下次没准就能中哦','v'=>50),
        );
        foreach($prize_arr as $k=>$v){
            $arr[$v['id']]=$v['v'];
        }
        function get_rand($proArr) {
            $result = '';
            //概率数组的总概率精度
            $proSum = array_sum($proArr);
            //概率数组循环
            foreach ($proArr as $key => $proCur) {
                $randNum = mt_rand(1, $proSum);             //抽取随机数
                if ($randNum <= $proCur) {
                    $result = $key;                         //得出结果
                    break;
                } else {
                    $proSum -= $proCur;
                }
            }
            unset ($proArr);
            return $result;
        }
        $rid=get_rand($arr);
        $res['yes'] = $prize_arr[$rid-1]['prize']; //中奖项
        unset($prize_arr[$rid-1]); //将中奖项从数组中剔除，剩下未中奖项
        shuffle($prize_arr); //打乱数组顺序
        for($i=0;$i<count($prize_arr);$i++){
            $pr[] = $prize_arr[$i]['prize'];
        }
        $res['no'] = $pr;
        var_dump($res);
    }
}