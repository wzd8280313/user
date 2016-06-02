<?php
/**
 * 用户认证处理类
 * User: weipinglee
 * Date: 2016/3/11
 * Time: 22:55
 */
namespace nainai\cert;
use \Library\M;
use \Library\Time;
use \Library\Query;
use \Library\Thumb;
use \Library\log;
use \Library\tool;
class certificate{

    const CERT_BEFORE  =  -1; //表示从未发起认证,不存在认证数据
    const CERT_INIT    =   0; //未发起认证,修改资料后为此状态
    const CERT_APPLY   =   1; //发起申请认证
    const CERT_SUCCESS =   2; //后台确认认证通过
    const CERT_FAIL    =   3; //后台拒绝认证

    protected static $certType = '';
    protected static $certTable = array(
        'deal'=>'dealer',
        'store'=>'store_manager'

    );



    protected static $certClass = array(
        'deal'=>'certDealer',
        'store'=>'certStore'
    );

    protected static $status_text = array(
        self::CERT_BEFORE => '未申请认证',
        self::CERT_INIT => '认证失效,需重新认证',
        self::CERT_APPLY => '等待后台审核',
        self::CERT_SUCCESS => '认证成功',
        self::CERT_FAIL => '后台审核驳回'

    );

    protected static $certFields = array();


    protected $user_type = '';
    protected $user_id  ;

    public function __construct($user_id=0,$user_type=''){
        $this->user_type = $user_type==1 ? 1 : 0;
        $this->user_id   = $user_id  ;
    }

    /**
     * 获取状态信息
     * @param $status
     * @return string
     */
    public static function getStatusText($status){
        return isset(self::$status_text[$status]) ? self::$status_text[$status] : '未知';
    }
    /**
     * 验证其他的认证是否会失效
     * @param array $oldData 旧的数据
     * @param array $accData 账户数据（公司、个人表数据）
     * @return array 需要重新认证的类型数组
     */
    public function checkOtherCert($accData){
        $user_id = $this->user_id;
        $certType = self::$certType;
        $certClass = self::$certClass;
        unset($certClass[$certType]);
        $reCertType = array();//需要重新认证的类型
        $oldData = $this->getCertDetail($user_id);//包括user、个人/企业表的数据

        if(!empty($certClass)){
            foreach($certClass as $type=>$class){
                $classObj = '\nainai\cert\\'.$class;
                $fields = $classObj::$certFields[$this->user_type];

                foreach($fields as $f){
                    if(isset($oldData[$f]) && isset($accData[$f]) && $oldData[$f]!=$accData[$f]){
                        $reCertType[] = $type;
                        break;
                    }

                }

            }
        }
        return $reCertType;


    }
    /**
     * 获取用户认证状态
     */
    public function getCertStatus($user_id,$cert_type){
        $certM = new M(self::$certTable[$cert_type]);
        $status_data = $certM->where(array('user_id'=>$user_id))->getObj();
        $status_data['status'] = empty($status_data) ? self::CERT_BEFORE : $status_data['status'];
        return $status_data;
    }


    /**
     * 插入认证数据
     * @param string $certType 认证类型
     * @param array $accData 账户数据（个人、公司表数据)
     * @param array $certData 认证数据
     */
    public function createCertApply($certType,$accData,$certData){
        $user_id = $this->user_id;
        $certModel = new M(self::$certTable[$certType]);
        $update = $certData;
        $status = self::CERT_APPLY;
        $certData['status'] = $status;
        $certData['user_id'] = $this->user_id;
        $certData['apply_time'] = Time::getDateTime();


        $certModel->insertUpdate($certData,$certData);//更新或插入认证数据

        if($this->user_type==1)
            $accTable = 'company_info';
        else $accTable = 'person_info';

        $certModel->table($accTable)->data($accData)->where(array('user_id'=>$user_id))->update();

    }

    /**
     * 后台审核认证
     * @param int $user_id 用户id
     * @param int $result 审核结果 0：驳回 1：通过
     * @param string $info 驳回原因或成功提示信息
     * @param string $type 认证类型
     */
    protected function certVerify($user_id,$result=1,$info='',$type='deal',$log=''){
        $table = self::getCertTable($type);
        $certModel = new M($table);
        $certModel->beginTrans();
        $status = $result==1 ? self::CERT_SUCCESS : self::CERT_FAIL;
        $certModel->data(array('status'=>$status,'message'=>$info,'verify_time'=>Time::getDateTime()))->where(array('user_id'=>$user_id))->update();

        $this->chgCertStatus($user_id,$certModel);
        $log = new log();
        $logs = array('admin','处理了一个申请认证','用户id:'.$user_id);
        $log->write('operation',$logs);

        $res = $certModel->commit();
        if($res===true){
            return tool::getSuccInfo();
        }
        return tool::getSuccInfo(0,'操作失败');
    }

    /**
     *认证复原，status改为0，需重新认证
     * @param array $reCert 重新认证的类型数组
     *
     */
    public function certInit($reCert){
        $tables = self::$certTable;
        $user_id = $this->user_id;

        $m = new M('');
        foreach($tables as $k=> $val){
            if(!in_array($k,$reCert))
                continue;
            $m->table($val);
            $m->data(array('status'=>self::CERT_INIT))->where(array('user_id'=>$user_id))->update();
        }

    }

    /**
     *
     * @param $user_id
     * @param $obj
     */
    protected function chgCertStatus($user_id,&$obj=null){
        $obj = new M('user');
        $obj->data(array('cert_status'=>1))->where(array('id'=>$user_id))->update();
    }

    /**
     * 获取申请认证用户列表
     * @param string $type 认证类型
     * @param int $page 页码
     */
    public function certApplyList($type,$page){
        if(!isset($type))return array();
        $table = self::getCertTable($type);
        $Q = new Query('user as u');
        $Q->join = 'left join '.$table.' as c on u.id = c.user_id';
        $Q->fields = 'u.id,u.type,u.username,u.mobile,u.email,u.status as user_status,u.create_time,c.*';
        $Q->page = $page;
        $Q->where = 'c.status='.self::CERT_APPLY;
        $data = $Q->find();
        $pageBar =  $Q->getPageBar();
        return array('data'=>$data,'bar'=>$pageBar);
    }

    /**
     * 获取认证类型相对应的表
     * @param string $type
     */
    protected function getCertTable($type){
        $table = '';
        if(isset(self::$certTable[$type]))
            return self::$certTable[$type];
        return $table;
    }

    /**
     * 获取申请认证的详细信息
     * @param int $id 用户id
     * @param string $certType 认证类型 如果为空，不获取认证表数据
     */
    protected function getCertDetail($id=0,$certType=''){
        $userModel = new M('user');
        if($id==0)$id=$this->user_id;
        $userData = $userModel->fields('username,type,mobile,email')->where(array('id'=>$id,'pid'=>0))->getObj();

        if(!empty($userData)){
            $userDetail = $userData['type']==1 ? $this->getCompanyInfo($id) : $this->getPersonInfo($id);
            if($certType!=''){
                $userCert   = $userModel->table($this->getCertTable($certType))->fields('status as cert_status,apply_time,verify_time,admin_id,message')->where(array('user_id'=>$id))->getObj();
                return array_merge($userData,$userDetail,$userCert);
            }
            return $userDetail;

        }
        return array();

    }

    /**
     * 获取用户信息(企业或个人）
     * @param $user_id
     */
    protected function getPersonInfo($user_id){
        $um = new M('person_info');
        $result = $um->where(array('user_id'=>$user_id))->getObj();
        $result['identify_front_thumb'] = Thumb::get($result['identify_front'],300,200);
        $result['identify_back_thumb'] = Thumb::get($result['identify_back'],300,200);
        return $result;
    }

    /**
     * 获取用户信息(企业或个人）
     * @param $user_id
     */
    protected function getCompanyInfo($user_id){
        $um = new M('company_info');
        $result = $um->where(array('user_id'=>$user_id))->getObj();
        $result['cert_oc_thumb'] = Thumb::get($result['cert_oc'],300,200);
        $result['cert_bl_thumb'] = Thumb::get($result['cert_bl'],300,200);
        $result['cert_tax_thumb'] = Thumb::get($result['cert_tax'],300,200);
        return $result;
    }


    /**
     * 验证角色认证是否通过
     * @param $user_id
     */
    public function checkCert($user_id){
        $obj = new M('');
        $result = array();
        foreach(self::$certTable as $type=>$table){
            $status = $obj->table($table)->where(array('user_id'=>$user_id))->getField('status');
            $result[$type] = $status==self::CERT_SUCCESS ? 1 : 0;
        }
        return $result;
    }
}