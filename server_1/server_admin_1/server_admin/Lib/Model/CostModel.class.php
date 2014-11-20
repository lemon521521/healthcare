<?php

/**
 * 产品费用
 * @author Administrator
 *
 */
class CostModel extends BaseModel{	
	public function getCostList($product_id){
		$sql = "select * from `product_cost` where product_id=$product_id order by `createtime` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	
	public function getCostById($id){
		$sql = "select * from `product_cost` where id=$id";
		$result = $this->original_query($sql);
		return $result;
	}
	
	public function addCost($data=array()){		
			$result = false;
			if($data){
				$table_name = 'product_cost';
				$this->add($table_name, $data);
				$result = $this->getLastInsID();
			}
			return $result;		
	}
	
	public function updateCost($data=array(),$condition){
		$table_name = 'product_cost';
		$res = $this->update($table_name, $data, $condition);
		return $res;
	}
	
	public function deleteCost($id){
		$sql = "delete from `product_cost` where id=$id";
		$result = $this->original_query($sql,2);
		return $result;
	}
}
?>