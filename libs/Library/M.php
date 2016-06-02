<?php

/**
 * ģ���� ����Yaf�лὫ��Model��β���࿴��ģ���࣬���ڵ�ǰ��Ŀģ���в��ң����Ը���ΪData;
 * author: wplee
 * Date: 2016/1/28
 */

namespace Library;
use \Library\DB\DbFactory;
class M{



	protected $db = null;//DBʵ��

    private $tablePre = '';

	public $tableData = array();//�������µ�����

	private $tableName = '';

	private $whereStr = '';

	private $whereParam = array();

    private $fields   = '*';

    private $group    = '';

    private $order    = '';

    private $limit    = ' LIMIT 500';

	private $pk       = 'id';

	static private $check    = null;

	private $error   = '';
	
	public function __construct($tableName) {
		$this->db = DbFactory::getInstance();
		$this->tableName = $this->tablePre.$tableName;
	}

	//��������
	public function pk($pk){
		$this->pk = $pk;
	}
	/**
	 * �������ݶ����ֵ
	 * @access public
	 * @param string $name ����
	 * @param mixed $value ֵ
	 * @return void
	 */
	public function __set($name,$value) {
		// �������ݶ�������
		$this->tableData[$name]  =   $value;
	}

	/**
	 * ��ȡ���ݶ����ֵ
	 * @access public
	 * @param string $name ����
	 * @return mixed
	 */
	public function __get($name) {
		return isset($this->tableData[$name])?$this->tableData[$name]:null;
	}

	/**


	/**
	 * ������ݶ����ֵ
	 * @access public
	 * @param string $name ����
	 * @return boolean
	 */
	public function __isset($name) {
		return isset($this->tableData[$name]);
	}

	/**
	 * �������ݶ����ֵ
	 * @access public
	 * @param string $name ����
	 * @return void
	 */
	public function __unset($name) {
		unset($this->tableData[$name]);
	}

	//��ȡ������Ϣ
	public function getError(){
		return $this->error;
	}

	//��������
	public function beginTrans(){
		$this->db->beginTrans();
	}
	//����ع�
	public function rollBack(){
		$this->db->rollBack();
	}
	//�����ύ
	public function commit(){
		return $this->db->commit();

	}

	//�Ƿ���������
	public function inTrans(){
		return $this->db->inTrans();
	}

	/**
	 * @brief ������������ĵ�����
	 * @param $data array ���»�����������
     */
	public function data($data){
		$this->tableData = $data;
		return $this;
	}

	/**
	 * ���ò������� �򷵻ص�ǰ��������
	 * @param $tableName str ����
	 * @return $this
     */
	public function table($tableName=''){
		if($tableName==''){
			return $this->tableName;
		}else{
			$this->tableName = $this->tablePre.$tableName;
			$this->clear();
			return $this;
		}
	}

	/**
	 *�������
	 *
     */
	private function clear(){
		$this->tableData = array();
		$this->whereStr = '';
		$this->whereParam = array();
		$this->fields   = '*';
		$this->group    = '';
		$this->order    = '';
		$this->limit    = ' LIMIT 500';
		$this->error = '';
	}

	/**
	 * @param $where array or str ��ѯ����
	 * @return string ��ѯ�����ַ���
	 */
	public function where($where){
		if(!isset($where))return false;
		$sql = '';
		$this->whereParam = array();//���where����
		if(is_array($where)){
			$sql .= ' WHERE ';
			foreach($where as $key=>$val){
				if(!is_array($val)){
					if($key=='_string'){
						$sql .= $val.' AND ';
					}
					else{
						$sql .= $key.' = :'.$key.' AND ';
						$this->whereParam[$key] = $val;
					}
				}
				else{
       				if($key=='_string'){
						$sql .= $val[0].' AND ';
						$this->whereParam = array_merge($this->whereParam,$val[1]);
					}
					else{
						foreach($val as $ekey => $eval){
							//����ȵ����
							switch(strtolower($ekey)){

								case 'neq' : {
									$sql .= $key.' <> :'.$key.$ekey.' AND ';
								}
									break;
								case 'gt' : {
									$sql .= $key.' > :'.$key.$ekey.' AND ';
								}
									break;
								case 'lt' : {
									$sql .= $key.' < :'.$key.$ekey.' AND ';
								}
									break;
								case 'eq' :
								default : {
									$sql .= $key.' = :'.$key.$ekey.' AND ';
								}
								break;

							}

							$this->whereParam[$key.$ekey] = $eval;
						}


					}
				}

			}
			$sql = substr($sql,0,-4);
			//$this->whereParam = $where;
		}
		else if(is_string($where)){
			$sql = ' WHERE '.$where;
		}
		$this->whereStr = $sql;
		return $this;
	}

	/**
	 * @brief ����where�����󶨲�������,where����Ϊstrʱ�趨
	 * @param $bindArr
	 * @return $this
     */
	public function bindWhere($bindArr){
		$this->whereParam = array_merge($this->whereParam,$bindArr);
		return $this;
	}

	/**
	 * @brief �滻bindWhere
	 * @param $bindArr
	 * @return $this
	 */
	public function bind($bindArr){
		$this->whereParam = array_merge($this->whereParam,$bindArr);
		return $this;
	}

    /**
     * @brief ���ò�ѯ���ֶ�
     * @$fields array or str ��ѯ�ֶ�
     */
    public function fields($fields='*'){
        if(is_string($fields))
            $this->fields = $fields;
        else if(is_array($fields)){
            $sql = '';
            foreach($fields as $key=>$val){
                $sql .= $val.',';
            }
            $sql = substr($sql,0,-1);
            $this->fields = $sql;
        }
        return $this;

    }


    /**
     *���ò�ѯ����
     * @param string $order  ���������ֶΣ����磺id ,id DESC
     */
    public function order($order=''){
        if($order != ''){
            $this->order = ' ORDER BY '.$order;
        }
        return $this;


    }

    /**
     * ���ò�ѯlimit
     * @param $limit str
     */
    public function limit($limit=''){
        if($limit != ''){
            $this->limit = ' LIMIT '.$limit;
        }
		else $this->limit = '';
        return $this;
    }

	/**
     * @brief ��������
	 * @param bool $trans �Ƿ�Ӧ����������
	 * @return bool
     */
	public function add($trans=0) {
		$res = false;

		if(!empty($this->tableData)){
			$insData = $this->tableData;

			$insertCol = '';
			$insertVal = '';
			foreach($insData as $key => $val)
			{
				$insertCol .= '`'.$key.'`,';
				$insertVal .= ':'.$key.',';
			}
			$sql = 'INSERT INTO '.$this->tableName.' ( '.rtrim($insertCol,',').' ) VALUES ( '.rtrim($insertVal,',').' ) ';

			$res =  $this->db->exec($sql,$this->tableData,'INSERT');
		}

		return $res;
	}

	/**
	 * �����ϴ�������Ŀ��id
	 * @return [type] [description]
	 */
	public function lastInsertId(){
		return $this->db->lastInsertId();
	}

	/**
	 * �����������
	 */
	public function adds($trans=0){
		$res = false;

		if(!empty($this->tableData)){
			$insData = $this->tableData;

			$insertCol = '';
			$insertVal = '';
			$bindData = array();
			foreach($insData as $key => $val)
			{
				$temp = '';
				if($insertCol==''){
					foreach($insData[$key] as $k=>$v){
						$insertCol .= '`'.$k.'`,';
					}
				}
				foreach($insData[$key] as $k=>$v){
					$temp .= ':'.$k.'_'.$key.',';
					$bindData[$k.'_'.$key] = $v;

				}
				$insertVal .= '('.rtrim($temp,',').'),';


			}
			$sql = 'INSERT INTO '.$this->tableName.' ( '.rtrim($insertCol,',').' ) VALUES  '.rtrim($insertVal,',');

			$res =  $this->db->exec($sql,$bindData,'INSERT');
		}

		return $res;
	}

	/**
	 * @brief ��������
	 * @param bool $trans
	 * @return bool|���ش�����
     */
	public function update($trans=0){
		$res = false;

		if(!empty($this->tableData) && $this->whereStr != ''){
			$sql = 'UPDATE '.$this->tableName.' SET ';
			foreach($this->tableData as $key=>$val){
				$sql .= '`'.$key.'` = :'.$key.',';
			}
			$sql = rtrim($sql,',');

			$sql .= $this->whereStr;
			$res =  $this->db->exec($sql,array_merge($this->tableData,$this->whereParam),'UPDATE');
		}
		return $res;
	}

	/**
	 * ɾ������
	 * @return bool|���ش�����
     */
	public function delete($trans=0){
		$res = false;

		if($this->whereStr != ''){
			$sql = 'DELETE FROM '.$this->tableName.$this->whereStr;
			$res =  $this->db->exec($sql,$this->whereParam,'DELETE');

		}
		return $res;
	}

    /**
     * @brief ��ȡ��������
     * @param array or string $cols ��ѯ�ֶ�,֧�������ʽ,��array('cols1','cols2')
     * @param array or string $orderBy �����ֶ�
     * @param array or string $desc ����˳�� ֵ: DESC:����; ASC:����;
     * @param array or int $limit ��ʾ�������� Ĭ��(500)
     * @return array ��ѯ���
     */
    public function select()
    {
        $sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;
        $res =  $this->db->exec($sql,$this->whereParam,'SELECT');
        return $res;
    }

    /**
     * @brief ��ѯһ�����
     * @return array ���ش�����
     */
    public function getObj(){
        $this->limit(1);
        $sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;

        $res =  $this->db->exec($sql,$this->whereParam,'SELECT');
        return empty($res) ? array() : $res[0];
    }

	/**
	 * ��ȡһ���ֶ�
	 * @param string $field �ֶ�
	 * @return ���ش�����
     */
	public function getField($field){
		$this->limit(1)->fields($field);
		$sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;
		$res =  $this->db->exec($sql,$this->whereParam,'SELECT');
		if(!empty($res))return $res[0][$field];
		return false;
	}

	/**
	 * ��ȡһ���ֶζ�������
	 *
	 */
	public function getFields($field){
		$this->fields($field);
		$sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->limit ;
		$res =  $this->db->exec($sql,$this->whereParam,'SELECT');
		if(!empty($res)){
			$arr = array();
			foreach($res as $key=>$val){
				$arr[] = $res[$key][$field];
			}
			return $arr;
		}
		return array();
	}

    /**
     * ִ��һ��sql
     * @param $sql
     * @return ��ѯ���
     */
    public function query($sql,$param=array(),$type=''){
        $res =  $this->db->exec($sql,array_merge($this->whereParam,$param),$type);
		return $res;
    }

	/**
	 * �ֶ�ֵ����
	 * @access public
	 * @param string $field  �ֶ���
	 * @param integer $step  ����ֵ
	 * @return boolean
	 */
	public function setInc($field,$step=1,$trans=0) {

		if($this->whereStr!='') {
			$sql = 'UPDATE '.$this->tableName.' SET '.$field.' = '.$field.' + :step '.$this->whereStr;
			return $this->query($sql,array_merge(array('step'=>$step),$this->whereParam),'UPDATE');
		}
		return false;


	}

	/**
	 * �ֶ�ֵ����
	 * @access public
	 * @param string $field  �ֶ���
	 * @param integer $step  ����ֵ
	 * @return boolean
	 */
	public function setDec($field,$step=1,$trans=0) {
		if($this->whereStr!='') {
			$sql = 'UPDATE '.$this->tableName.' SET '.$field.' = '.$field.' - :step '.$this->whereStr;
			return $this->query($sql,array_merge(array('step'=>$step),$this->whereParam),'UPDATE');
		}
		else return false;

	}

	/**
	 *������£������ֶ�Ψһ���Ѵ�������£������������
	 * @param array $insert ��������
	 * @param array $update ��������
	 * @param bool $trans
	 * @return 
     */
	public function insertUpdate($insert,$update,$trans=0){
		$sql = 'INSERT INTO '.$this->table();
		$insertCol = '';
		$insertVal = '';
		foreach($insert as $key => $val)
		{
			$insertCol .= '`'.$key.'`,';
			$insertVal .= ':'.$key.',';
		}
		$sql .= ' ( '.rtrim($insertCol,',').' ) VALUES ( '.rtrim($insertVal,',').' ) ON DUPLICATE KEY UPDATE';

		foreach($update as $key=>$val){
			$sql .= '`'.$key.'` = :'.$key.',';
		}
		$sql = rtrim($sql,',');
		return $this->bind(array_merge($insert,$update))->query($sql,array(),'UPDATE');

	}

	/**
	 * ������֤
	 * @param array $rules ��֤����
	 * @param int $type 1 : ���� 2������
	 * @param array $data Ҫ��֤������
	 * @return bool ��֤��� �������false�����޸�$this->error��ֵ
	 */
	public function validate($rules,$data=array(),$type=''){
		$checkData = empty($data) ? $this->tableData : $data;
		if(!is_object(self::$check))
			self::$check = new check();
		return self::$check->validate($checkData,$rules,$this->error,$type,$this->pk);
	}






}
?>