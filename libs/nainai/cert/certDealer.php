<?php
/**
 * ��������֤������
 * author: weipinglee
 * Date: 2016/4/27 0027
 * Time: ���� 3:35
 */

namespace nainai\cert;
use \Library\M;
use \Library\Time;
use \Library\Query;
use \Library\Thumb;
use \Library\log;
use \Library\JSON;
class certDealer extends certificate{


    protected static $certType = 'deal';
    //��֤��Ҫ���ֶ�,0�����û���1��ҵ�û�
    protected static $certFields = array(

        0=>array(
            'true_name',
            'identify_no',
            'identify_front',
            'identify_back',
            'area',
            'address'
        ),
        1=>array(
            'company_name',
            'area',
            'address',
            'legal_person',
            'contact',
            'contact_phone',
            'cert_oc',//��֯��������֤
            'cert_bl',
            'cert_tax'
        )
    );

    /**
     * ��֤����
     * array(�ֶΣ����򣬴�����Ϣ�����������ӹ���ʱ�䣩
     * ������0�������ֶ�����֤ 1��������֤ 2����Ϊ��ʱ��֤
     *
     */
    private $rules = array(
        array('user_id','number','�û�id����'),//Ĭ��������
    );



    /**
     *��ȡ��֤����
     * @param $user_id
     */
    public function getCertData($user_id=0){
        return $this->getCertDetail($user_id,self::$certType);


    }



    /**
     * ��֤������
     * @param array  $accData �˻����ݣ����ˡ���˾�����ݣ�
     * @param array $certData ��֤���� ����֤������ݣ�
     */
    public function certDealApply($accData,$certData=array()){

        //���鹫˾������Ϣ�Ƿ���Ϲ���
        $m = new \UserModel();
        if($this->user_type==1){
           $check = $m->checkCompanyInfo($accData);
        }
        else
            $check = $m->checkPersonInfo($accData);
        $certObj = new M(self::$certTable[self::$certType]);


        if($check===true ){
            //������������֤�Ƿ���Ҫ������֤
            $reCertType = $this->checkOtherCert($accData);
            $certObj->beginTrans();
            if(!empty($reCertType))//����������֤�����Ͳ�Ϊ�գ������ʼ��
                $this->certInit($reCertType);

            $this->createCertApply(self::$certType,$accData,$certData);
            $this->chgCertStatus($this->user_id,$certObj);//�����û�����֤״̬
            $res = $certObj->commit();
        }
        else{
            $res = $check;
        }

        if($res===true){
            return \Library\Tool::getSuccInfo();
        }

        else{
            return \Library\Tool::getSuccInfo(0,is_string($res) ? $res : '����ʧ��');

        }

    }

    //��ȡ��������֤�б�
    public function certList($page){
       return parent::certApplyList(self::$certType,$page);
    }

    /**
     * ��ȡ��֤��ϸ��Ϣ
     */
    public function getDetail($id){
        return $this->getCertDetail($id,self::$certType);
    }

    /**
     * ���������
     * @param int $user_id �û�id
     * @param int $result ��˽�� 1��ͨ����0������
     * @param string $info ���
     */
    public function verify($user_id,$result=1,$info=''){
        return $this->certVerify($user_id,$result,$info,self::$certType);
    }


}