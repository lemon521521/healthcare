<?php
/**
 * 文件描述
 *
 * @author shenyh
 * @date 2014-9-22
 * @version 1.0.0
 */
class PhysicianModel extends BaseModel{
	public function getPhysicianList(){
		$sql = "select * from `physician` where status=2 order by `insert_time` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public function addPhysician($data){
		$result = false;
		if($data){
			$table_name = 'physician';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function updatePhysician($data,$condition){
		$table_name = 'physician';
		$this->update($table_name, $data, $condition);
		return $this->getLastSql();
	}
	public function delPhysician($id){
		$sql = "update physician set status=0 where id='$id'";
		$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function getPhysicianById($id){
		$sql = "select * from physician where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
}
?>