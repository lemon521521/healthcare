<?php
Class BaseModel extends Model{
    
    //数据库连接 用于跨库操作
    protected $db_con = array();
    
    function __construct(){
		parent::__construct();
	}
    
    /**
     * 数据库切库
     * @param array $config
     * @return multitype:|NULL
     */
    public function get_db_con($config=''){
        if(!empty($config) && is_string($config) && false === strpos($config,'/')) { // 支持读取配置参数
            $con_key = md5($config);
            if(!empty($this->db_con[$con_key]) && is_object($this->db_con[$con_key])){
                return $this->db_con[$con_key];
            }
            $config  =  C($config);
            $this->db_con[$con_key] = Db::getInstance($config);
            return $this->db_con[$con_key];
        }
        return null;        
    }
	
	/**
	 * 增加记录
	 * @param string $table_name
	 * @param array $data
	 * @param string $str
	 * @return boolean
	 */
	public function add($table_name,$data,$str=""){
		$add = $this->handleUpdateData($data);
		if(!$add){
			return false;
		}
		$sql = "insert into $table_name set  $add";
		if(!empty($str)){
			$sql .= $str;
		}
		return $this->send_query($sql,2);
	}
	
	/**
	 * 删除记录
	 * @param string $table_name
	 * @param array $condition
	 * @param string $str
	 */
	public function delete($table_name,$condition,$str=""){
		$sql = "delete from $table_name where $condition";
		return $this->send_query($sql,2);
	}
	
	/**
	 * 更新记录
	 * @param string $table_name
	 * @param array $data
	 * @param array $condition
	 * @param string $str
	 * @return boolean
	 */
	public function update($table_name,$data,$condition,$str=""){
		$update = $this->handleUpdateData($data);
		if(!$update){
			return false;
		}
		if(empty($condition)){
			return false;
		}
		$sql = "update $table_name set $update ";
		if(!empty($str)){
			$sql .= $str;
		}
		$sql .= " where $condition";
		return $this->send_query($sql,2);
	}
	
	
	/**
	 * 查询记录
	 * @param string $table
	 * @param array $data
	 * @param array $where
	 * @param string $str
	 */
	public function select($table,$data,$where="",$str=""){
		$columns = $this->column($data);
		if(!empty($str)){
			$columns .= $str; 
		}
		$sql = "select ".$columns." from $table ";
		if(!empty($where)){
			$sql .= " where $where"; 
		}
		return $this->send_query($sql);
	}
	
	/**
	 * 原生态查询
	 * @param string $sql
	 * @param sql $type
	 * @return array
	 */
	public function original_query($sql,$type=1){
		$result = false;
		if($sql){
			$result = $this->send_query($sql,$type);
		}
		return $result;
	}
	
	private function send_query($sql,$type=1){
		$start_time = microtime(true);
		switch ($type){
			case 1:
				$result = $this->query($sql);
				break;
			case 2:
				$result = $this->execute($sql);
			default:
				$result = false;
		}
//		if(LOG_SWITCH == 1){
			$end_time = microtime(true);
			$access_time = floor(($end_time-$start_time)*1000);
			$log_content = 'sql:'.$sql."\n";
			$log_content.='start_time:'.$start_time."\n";;
			$log_content.='end_time:'.$end_time."\n";
			$log_content.='query_time:'.$access_time."\n";
			$log_content.='error:'.mysql_error()."\n";
			$file = '/sqlerror'.date('Ymd').'.log';
			error_log($log_content,3,$file);
//		}
		return $result;
	}
	
	/**
	 * 拼接部分相关sql语句
	 * 用于insert update 语句 与 where 条件语句
	 * @param  $data
	 */
	public function handleUpdateData($data){
		if(!$data){
			return false;
		}
		$setValue = "";
		$data = _addslashes($data);
		foreach ($data as $key=>$value) {
			$setValue .= "$key='$value',";		
		}
		$setValue = substr($setValue, 0,strlen($setValue)-1);//去掉最后的逗号
		return $setValue;
	}

	/**
	 * @param $data value为查询的列名
	 */
	public function column($column,$prefix=""){
		if(!$column){
			$column = array("*");
		}
		$select = "";
		foreach ($column as $value){
			$select .= "$prefix $value,";
		}
		$select = substr($select, 0,strlen($select)-1);//去掉最后的逗号
		$select = preg_replace($pattern="/\. /", $replacement=".", $select);
		$select .= " ";//为了在拼接sql字符串的时候与from 隔开
		return $select;
	}
	
}

?>