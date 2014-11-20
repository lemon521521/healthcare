<?php
class SeoInfoModel extends Model{
	
	protected $_auto = array(
			array('createtime','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
			array('lastupdate','time',3,'function')
	);
	
	public function insertData($data = array()){
		if (empty($data)) {
			return false;
		}
		$data = $this->cover($data);
		if (!$data['title'] && !$data['keyword'] && !$data['des']) {
			return false;
		}
		$this->create($data);
		if ($data['id']){
			$this->save();
		}else{
			$this->add();
		}
		return true;
	}
	
	public function cover($data){
		return array_filter($data , function($v){ return trim($v); });
	}
}
?>