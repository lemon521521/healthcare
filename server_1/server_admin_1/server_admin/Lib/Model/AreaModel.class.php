<?php
/**
 * 文件描述
 *
 * @author shenyh
 * @date 2014-10-9
 * @version 1.0.0
 */
class AreaModel extends BaseModel{
	public function getAreaList(){
		$sql = "select * from `base_geography_area` where status=2 order by `order_sort` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public function addArea($data){
		$result = false;
		if($data){
			$table_name = 'base_geography_area';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function updateArea($data,$condition){
		$table_name = 'base_geography_area';
		$this->update($table_name, $data, $condition);		
		return $this->getLastSql();
	}
	public function delArea($id){
		$sql = "update base_geography_area set status=0 where id='$id'";
	 	$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function getAreaById($id){
		$sql = "select * from base_geography_area where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}	
}
?>