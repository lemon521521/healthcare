<?php
/**
 * 文件描述
 *
 * @author shenyh
 * @date 2014-9-22
 * @version 1.0.0
 */
class HospitalModel extends BaseModel{
	public function getHospitalList(){
		$sql = "select * from `hospital` where status=2 order by `insert_time` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public function addHospital($data){
		$result = false;
		if($data){
			$table_name = 'hospital';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function addHospitalPhysicianIndex($data){
		$result = false;
		if($data){
			$table_name = 'hospital_physician_index';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function updateHospital($data,$condition){
		$table_name = 'hospital';
		$this->update($table_name, $data, $condition);
		return $this->getLastSql();
	}
	public function delHospital($id){
		$sql = "update hospital set status=0 where id='$id'";
		$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function getHospitalById($id){
		$sql = "select * from hospital where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
	public function physician_Select($id){
		if($id){
			$where=" and a.id=".$id;
		}else{
			$where='';
		}
		$sql = "SELECT c.physician_name,c.id FROM `hospital` AS a,`hospital_physician_index` AS b,`physician` AS c WHERE a.id=b.hospital_id AND b.physician_id=c.id  ";
		$result = $this->original_query($sql);
		return $result;
	}
	public function physician_AllSelect(){
		
		$sql = "select * from physician where 1 order by insert_time desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public function getHospitalPhysicianById($id){
		$sql = "select * from hospital_physician_index where 1   and hospital_id=".$id;
		$result = $this->original_query($sql);
		return $result;
	} 
	public function getPhysicianByname($id){
		$sql = "select * from physician where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
	public function del_index($id){
		$sql = "delete from hospital_physician_index where hospital_id =".$id;
		return $this->original_query($sql,2);
	}
	public function getCountryByName(){
		$sql = "select * from `base_geography_area` where 1";
		$result = $this->original_query($sql);
		return $result;
	}
}
?>
