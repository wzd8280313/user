<?php
//require_once dirname(__FILE__)."/lib/WxPay.Exception.php";
require_once dirname(__FILE__)."/lib/WxPay.Config.php";
//require_once dirname(__FILE__)."/lib/WxPay.Data.php";
require_once dirname(__FILE__)."/lib/WxPay.Api.php";        
require_once dirname(__FILE__)."/WxPay.NativePay.php";        
//require_once dirname(__FILE__)."/log.php";
/**
 * @file scan_wechat.php
 * @brief 微信二维码插件类
 * @date 2016-6-29 15:23:04
 * @version 1.0.0
 * @note
 */

/**
 * @class scan_wechat
 * @brief 微信二维码插件类
 */
class scan_wechat extends paymentPlugin
{
    //支付插件名称
    public $name = '微信二维码';

    /*
     * @param 获取配置参数
     */
    public function configParam()
    {
        $result = array(
            'M_merId'  => 'APPID',
            'M_mchid'  => '商户号',
            'M_key'  => '商户支付密钥',
            'M_certPwd' => '签名证书密码',
        );
        return $result;
    }
    
    /**
     * @see paymentplugin::notifyStop()
     */
    public function notifyStop()
    {
        echo "success";
    }
    
    /**
     * @see paymentplugin::getSubmitUrl()
     */
    public function getSubmitUrl()
    {
        
    }
    
    /**
     * @see paymentplugin::getRefundUrl()
     */
    public function getRefundUrl(){
        
    }
    
    public function callback($callbackData,&$paymentId,&$money,&$message,&$orderNo)
    {
        //获取通知的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
            
        //如果返回成功则验证签名
        try {
            $result = WxPayResults::Init($xml);
        } catch (WxPayException $e){
            $message = $e->errorMessage();
            return false;
        }
        //return true;
    }
    /*public function callback($callbackData,&$paymentId,&$money,&$message,&$orderNo)
    {
        
    }*/
    
    public function serverCallback($callbackData,&$paymentId,&$money,&$message,&$orderNo){}
    
    public function getSendData($payment)
    {  
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功
         */
        $notify = new NativePay();
        $payModel = new IModel('payment');
        $payPara = $payModel->getField('id='.$payment['M_Paymentid'], 'config_param');
        $paraData = JSON::decode($payPara);     
        $input = new WxPayUnifiedOrder();
        $input->SetBody($payment['R_Name']);
        $input->SetAttach($payment['R_Name']);
        $M_mchid = $paraData['M_mchid'] ? $paraData['M_mchid'] : WxPayConfig::MCHID;
        $input->SetOut_trade_no($M_mchid.date("YmdHis"));
        $input->SetTotal_fee($payment['M_Amount']*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag('');
        $input->SetNotify_url($this->wecheatCallbackUrl);
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($payment['M_OrderId']);
        $input->SetAppid($paraData['M_merId']);
        $input->SetMch_id($paraData['M_mchid']);           
        $result = $notify->GetPayUrl($input);
        if(isset($payment['pay_level']))
        {
            $pay_level = $payment['pay_level'] ? $payment['pay_level'] : 2;
            return(array('wecheat_code_url' => $result["code_url"],'order_id' => $payment['M_OrderNO'], 'product_id' => $M_mchid.date("YmdHis"),'pay_level' => $pay_level));
        }
        else
        {
            return(array('wecheat_code_url' => $result["code_url"],'order_id' => $payment['M_OrderNO'], 'product_id' => $M_mchid.date("YmdHis"),'pay_level' => 0));
        }
    }
}

