<?php
/**
 * User: weipinglee
 * Date: 2016/3/8 0008
 * Time: 上午 9:26
 */
namespace Library;
class safe
{


    protected static $defalut = 'string';

    //php filter类型常量
    private static $filterVars = array(
        'int'     => FILTER_VALIDATE_INT,
        'float'   => FILTER_VALIDATE_FLOAT,
        'email'   => FILTER_VALIDATE_EMAIL,
        'ip'      => FILTER_VALIDATE_IP,
        'url'     => FILTER_VALIDATE_URL,


    );

    private static $filterRegex = array(
        'zip'     => '/^\d{6}$/',
        'english'   =>  '/^[A-Za-z]+$/',
        'date'    => '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/i',
        'datetime'  =>  '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29) (?:(?:[0-1][0-9])|(?:2[0-3])):(?:[0-5][0-9]):(?:[0-5][0-9])$/i',

    );
    /**
     * 获取post数据切进行过滤
     * @param string $name 变量的名称 支持指定类型
     * @param string $filter 参数过滤方法
     * @param mixed $default 不存在的时候默认值
     * @param mixed $datas 要获取的额外数据源
     */
    public static function filterPost($name='',$filter='string',$default=''){
       return self::filterRequest($_POST,$name,$filter,$default);
    }
    /**
     * 获取get数据切进行过滤
     * @param string $name 变量的名称 支持指定类型
     * @param string $filter 参数过滤方法
     * @param mixed $default 不存在的时候默认值
     * @param mixed $datas 要获取的额外数据源
     */
    public static function filterGet($name='',$filter='string',$default=''){
        return self::filterRequest($_GET,$name,$filter,$default);
    }
    /**
     * 对数据进行过滤
     * param array 元数据
     * @param string $name 变量的名称 支持指定类型
     * @param string $filter 参数过滤方法
     * @param mixed $default 不存在的时候默认值
     * @param mixed $datas 要获取的额外数据源
     */
    public static function filterRequest(&$souceData,$name='',$filter='string',$default=''){
        $input = $souceData;
        $result = array();
        $filter    =   isset($filter) && is_string($filter) ? $filter:self::$defalut;
        if(''==$name) { // 获取全部变量
            foreach ($input as $key => $val) {
                $result[$key] = self::filter(trim($val),$filter,$default);
            }
            return $result;
        }elseif(isset($input[$name]) && is_array($input[$name])) { // 取值操作
            foreach($input[$name] as $key =>$v){
                $result[$key] = self::filter(trim($v),$filter,$default);
            }
            return $result;
        }
        elseif(isset($input[$name])) { // 取值操作
            return self::filter(trim($input[$name]),$filter,$default);
        }
        else{ // 变量默认值
            return $default;
        }

    }


    /**
     * 单条规则过滤单条过滤数据
     * @param string $filter
     * @param mixed $data
     */
    public static function filter($data,$filter='string',$default=''){
        $filter = trim($filter);
        if(method_exists(__CLASS__,$filter)){//调用本类的方法
            return  call_user_func(array(__CLASS__,$filter),$data);
        }
        else if(isset(self::$filterVars[$filter])){//调用filter_var函数
            $res = filter_var($data,self::$filterVars[$filter]);
            return $res===false ? $default : $res;
        }
        else if(isset(self::$filterRegex[$filter])){
            $res = preg_match(self::$filterRegex,(string)$data);
            return $res ==0 ? $default : $res;
        }
        else if(function_exists($filter)){//调用php函数
            return call_user_func($filter,$data);
        }
        else if(0 === strpos($filter,'/')){
            if(preg_match($filter,(string)$data)==0)
                return $default;
        }
        return $data;

    }




    /**
     * @brief 增加转义斜线
     * @param string $str 要转义的字符串
     * @return string 转义后的字符串
     */
    public static function addSlash($str)
    {
        if(is_array($str))
        {
            $resultStr = array();
            foreach($str as $key => $val)
            {
                $resultStr[$key] = self::addSlash($val);
            }
            return $resultStr;
        }
        else
        {
            return addslashes($str);
        }
    }

    /**
     * @brief 去掉转义斜线
     * @param string $str 要转义的字符串
     * @return string 去掉转义的字符串
     */
    public static function stripSlash($str)
    {
        if(is_array($str))
        {
            $resultStr = array();
            foreach($str as $key => $val)
            {
                $resultStr[$key] = self::stripSlash($val);
            }
            return $resultStr;
        }
        else
        {
            return stripslashes($str);
        }
    }

    /**
     * @brief 检测文件是否有可执行的代码
     * @param string  $file 要检查的文件路径
     * @return boolean 检测结果
     */
    public static function checkHex($file)
    {
        $resource = fopen($file, 'rb');
        $fileSize = filesize($file);
        fseek($resource, 0);
        // 读取文件的头部和尾部
        if ($fileSize > 512)
        {
            $hexCode = bin2hex(fread($resource, 512));
            fseek($resource, $fileSize - 512);
            $hexCode .= bin2hex(fread($resource, 512));
        }
        // 读取文件的全部内容
        else
        {
            $hexCode = bin2hex(fread($resource, $fileSize));
        }
        fclose($resource);
        /* 匹配16进制中的 <% (  ) %> */
        /* 匹配16进制中的 <? (  ) ?> */
        /* 匹配16进制中的 <script  /script>  */
        if (preg_match("/(3c25.*?28.*?29.*?253e)|(3c3f.*?28.*?29.*?3f3e)|(3C534352495054.*?2F5343524950543E)|(3C736372697074.*?2F7363726970743E)/is", $hexCode))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * 清理URL地址栏中的危险字符，防止XSS注入攻击
     * @param string $url
     * @return string
     */
    public static function clearUrl($url)
    {
        return str_replace(array('\'','"','&#',"\\","<",">"),'',$url);
    }

    /**
     * @brief 过滤文件名称
     * @param string $string 参数字符串
     * @return string
     */
    public static function fileName($string)
    {
        return str_replace(array('./','../','..'),'',$string);
    }

    /**
     * @brief 过滤字符串的长度
     * @param string $str 被限制的字符串
     * @param int $length 限制的字节数
     * @return string 空:超出限制值; $str:原字符串;
     */
    public static function limitLen($str,$length)
    {
        if($length !== false)
        {
            $count = String::getStrLen($str);
            if($count > $length)
            {
                return '';
            }
            else
            {
                return $str;
            }
        }
        return $str;
    }

    /**
     * @brief  对字符串进行严格的过滤处理
     * @param  string  $str      被过滤的字符串
     * @param  int     $limitLen 被输入的最大长度
     * @return string 被过滤后的字符串
     * @note 过滤所有html标签和php标签以及部分特殊符号
     */
    public static function string($str,$limitLen = false)
    {
        $str = trim($str);
        $str = self::limitLen($str,$limitLen);
        $str = htmlspecialchars($str,ENT_NOQUOTES);
        $str = str_replace(array("/*","*/"),"",$str);
        return self::addSlash($str);
    }

    /**
     * @brief 对字符串进行普通的过滤处理
     * @param string $str      被过滤的字符串
     * @param int    $limitLen 限定字符串的字节数
     * @return string 被过滤后的字符串
     * @note 仅对于部分如:<script,<iframe等标签进行过滤
     */
    public static function text($str,$limitLen = false)
    {
        $str = self::limitLen($str,$limitLen);
        $str = trim($str);

        require_once(dirname(__FILE__)."/htmlpurifier/HTMLPurifier.standalone.php");
        $cache_dir=APPLICATION_PATH."/htmlpurifier/";

        if(!file_exists($cache_dir))
        {
          //  File::mkdir($cache_dir);
        }
        $config = \HTMLPurifier_Config::createDefault();

        //配置 允许flash
        $config->set('HTML.SafeEmbed',true);
        $config->set('HTML.SafeObject',true);
        $config->set('Output.FlashCompat',true);

        //配置 缓存目录
        //$config->set('Cache.SerializerPath',$cache_dir); //设置cache目录

        //允许<a>的target属性
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('a', 'target', 'Enum#_blank,_self,_target,_top');

        //过略掉所有<script>，<i?frame>标签的on事件,css的js-expression、import等js行为，a的js-href
        $purifier = new \HTMLPurifier($config);
        return self::addSlash($purifier->purify($str));
    }


    /**
     * 获取
     */
    public static function createToken(){
        $token = sha1(mt_rand(1,999999).Client::getIp().time());
        session::set('token',$token);
        return $token;
    }

    /**
     * 检验token正确与否
     */
    public static function checkToken($token){
        $sessToken = \Library\session::get('token');
        \Library\session::clear('token');
        if($sessToken!=$token || $sessToken==null)
            return false;
        return true;
    }


}

