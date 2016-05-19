<?php
/**
 * @file alipay.php
 * @brief alipay的oauth协议登录接口         
 * @date 2016-5-3 15:25:24
 * @version 0.1
 */

/**
 * @class alipay
 * @brief alipay的oauth协议接口
 */
class Alipay extends OauthBase
{
    private $partner  = '';
    private $key = '';
    protected $GetRequestCodeURL = 'https://mapi.alipay.com/gateway.do';  
    public function __construct($config)
    {
        $this->partner  = $config['partner'];
        $this->key = $config['key'];
    }

    public function getFields()
    {
        return array(
            'partner' => array(
                'label' => 'partner',
                'type'  => 'string',
            ),
            'key'=> array(
                'label' => 'key',
                'type'  => 'string',
            ),
        );
    }

    //获取登录url地址
    public function getLoginUrl()
    {                                                     
        require_once(dirname(__FILE__)."/alipay.config.php");
        require_once(dirname(__FILE__)."/lib/alipay_submit.class.php");
        /**************************请求参数**************************/

        //目标服务地址
        $target_service = "user.auth.quick.login";
        //必填
        //必填，页面跳转同步通知页面路径
        $return_url = parent::getReturnUrl();
        //需http://格式的完整路径，不允许加?id=123这类自定义参数
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => "alipay.auth.authorize",
                "partner" => $this->partner,
                "target_service"    => $target_service,
                "return_url"    => $return_url,
                "anti_phishing_key"    => $anti_phishing_key,
                "exter_invoke_ip"    => $exter_invoke_ip,
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "");        
        echo $html_text;
    }

    //获取进入令牌
    public function getAccessToken($parms)
    {                                                          
        require_once(dirname(__FILE__)."/alipay.config.php");
        require_once(dirname(__FILE__)."/lib/alipay_notify.class.php");   
        $alipayNotify = new AlipayNotify($alipay_config);
        
        $verify_result = $alipayNotify->verifyReturn();     
        if($verify_result) {//验证成功           
            //支付宝用户号
            ISession::set('user_id',$_GET['user_id']); 
            //授权令牌  
            ISession::set('token',$_GET['token']);  
        }
        else {
            echo "验证失败";
        }                                            
    }

    //获取用户数据
    public function getUserInfo()
    {                           
        $userInfo['id']   = ISession::get('user_id');
        $userInfo['name'] = ISession::get('user_id');
        //$userInfo['name'] = isset($arr['nickname']) ? $arr['nickname'] : '';
        return $userInfo;
    }

    public function checkStatus($parms)
    {
        return true;
    }
 
} 

      