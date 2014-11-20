<?php
/**
 * 产品信息
 *
 * @author shenyh
 * @date 2014-9-22
 * @version 1.0.0
 */
class ProductModel extends BaseModel{
	function __construct(){
		parent::__construct();
	}
	public function getArticle(){
		$sql = "select * from `product` where is_del=0 order by `id` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public  function addArticle($data=array()){		
			$result = false;
			if($data){
				$table_name = 'product';
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
	public function delproduct($id){
		$sql = "update product set is_del=1 where id='$id'";
	 	$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function delPicture($condition){
		if(!$condition) return false;
		$sql = "delete from picture where ".$condition;
		 $this->original_query($sql,2);
		 return $this->getLastSql();
	}
	public function updateproduct($data,$condition){
		$table_name = 'product';
		$this->update($table_name, $data, $condition);		
		return $this->getLastSql();
	}
	public function updatepicture($data,$condition){
		$table_name = 'picture';
		$this->update($table_name, $data, $condition);
		return $this->getLastSql();
	}
	public function updateContent($data,$condition){
		$table_name = 'content';
		$this->update($table_name, $data, $condition);
		return $this->getLastSql();
	}
	public function getproductById($id){
		$sql = "select * from product where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
	
	public function getproductByName($title){
		$sql = "select * from product where title = '$title'";
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
	/**
	 * 取产品内容
	 *
	 * @param  $data
	 */
	public function getContentByProductId($productid,$type){
		if(!$productid)	return false;	
		$where=" and product_id=".$productid."  and type=".$type;
		$sql = "select * from content where 1 ".$where;
		$result = $this->original_query($sql);
		return $result[0]['content'];
	}
	/**
	 * 取产品焦点图
	 *
	 * @param  $data
	 */
	public function getPictureByProductId($productid,$type){	
		if(!$productid) return false;
		if($type){
			$where=" and product_id=".$productid." and type=".$type;
			
		}else{
			$where=" and product_id=".$productid;
		}
		
		$sql = "select * from `picture` where 1".$where." order by type asc,order_sort asc";		
		$result = $this->original_query($sql);
		return $result;
	}
	public function getPictureList($id){
		$sql = "select * from picture where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}
	public function hospital_select(){		
		$sql = "select id,hospital_name as name from `hospital` where 1 and status=2    order by insert_time";
		$result = $this->original_query($sql);
		return $result;
	}
	public function getHospitalById($id){
		if(!$id) return false;
		$sql = "select * from `hospital` where 1 and status=2  and id=".$id;
		$result = $this->original_query($sql);
		return $result;
	}
}
?>