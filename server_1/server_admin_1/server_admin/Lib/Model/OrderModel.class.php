<?php
Class OrderModel extends BaseModel{
    
    function __construct(){
		parent::__construct();
	}
    
 	public function getOrderByTradeno($trade_no){
 		$table = 'orders';
 		$sql = "select * from orders where trade_no='$trade_no'";
 		$result = $this->original_query($sql);
 		return $result;
 	}
 	
 	public function delOrder($trade_no,$uid=0){
 		if(empty($trade_no)) return false;
 		$table_name = 'orders';
 		$data = array('is_del'=>1);
 		$condition = "trade_no=$trade_no";
 		if($uid){
 			$condition.=" and uid=$uid";
 		}
 		$res = $this->update($table_name, $data, $condition);
 		return $res;
 	}
 	
 	public function getContactByUid($ids){
 		$sql = "select * from contact where id in($ids)";
 		$result = $this->original_query($sql);
 		return $result;		
 	}
}

?>