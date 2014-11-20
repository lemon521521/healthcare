<?php
/**
 * 文件描述
 *
 * @author shenyh
 * @date 2014-10-28
 * @version 1.0.0
 */
class TravelModel extends BaseModel{	
	public function getTravel(){
		$sql = "select * from `product_trip` where status=2 order by `id` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public  function addTravel($data=array()){		
			$result = false;
			if($data){
				$table_name = 'product_trip';
				$this->add($table_name, $data);
				$result = $this->getLastInsID();
			}
			return $result;		
	}
	/**
	 * 插入content表
	 * 
	 * @param  $data
	 */
	public  function addContent($data=array()){
		$result = false; 
		if($data){
			$table_name = '`content`';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	/**
	 * 插入picture表
	 *
	 * @param  $data
	 */
	public  function addPicture($data=array()){
		$result = false;
		if($data){
			$table_name = '`picture`';
			$this->add($table_name, $data);
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function deltravel($id){
		$sql = "update product_trip set status=0 where id='$id'";
	 	$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function delPicture($condition){
		if(!$condition) return false;
		$sql = "delete from picture where ".$condition;
		 $this->original_query($sql,2);
		 return $this->getLastSql();
	}
	public function updatetravel($data,$condition){
		$table_name = 'product_trip';
		$this->update($table_name, $data, $condition);		
		return $this->getLastSql();
	}
	public function updateContent($data,$condition){
		$table_name = 'content';
		$this->update($table_name, $data, $condition);
		return $this->getLastSql();
	}
	public function getTravelById($id){
		$sql = "select * from product_trip where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
	
	public function getTravelByProductId($product_id){
		$sql = "select * from product_trip where product_id = '$product_id' and status=2 order by day asc";
		$result = $this->original_query($sql);
		return $result;
	}
	
	public function gettravel_overviewByName($title){
		$sql = "select * from product_trip where title = '$title'";
		$result = $this->original_query($sql);
		return $result;
	}
	public function getCategory(){
		$sql = "select * from category where pid =0";
		$result = $this->original_query($sql);
		return $result;
	}
	public function getSubCategory($id){
		$sql = "select * from category where pid =".$id;
		$result = $this->original_query($sql);
		return $result;
	}
	public function getCategoryByPid($id){
		$sql = "select * from category where id =".$id;
		$result = $this->original_query($sql);
		return $result[0]['pid'];
	}
	public function getCountryByName($id){				
		$sql = "select * from `base_geography_area` where 1";
		$result = $this->original_query($sql);
		return $result;
	}

	public function product_select(){		
		$sql = "select id,title as name from `product` where 1 and is_del=0    order by createtime";
		$result = $this->original_query($sql);
		return $result;
	}
	public function getProductById($id){
		if(!$id) return false;
		$sql = "select * from `product` where 1 and is_del=0  and id=".$id;
		$result = $this->original_query($sql);
		return $result;
	}
}
?>