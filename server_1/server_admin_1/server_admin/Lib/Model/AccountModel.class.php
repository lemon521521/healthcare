<?php
Class AccountModel extends BaseModel{
	
    function __construct(){
		parent::__construct();
	}
	
 	public function addAccount($data){
 		$result = false;
 		if($data){
	 		$table_name = 'account';
	 		$this->add($table_name, $data);
	 		$result = $this->getLastInsID();
 		}
 		return $result;
 	}
 	
 	public function delAccount($id){
 		$sql = "delete from account where account_id='$id'";
 		return $this->original_query($sql,2);
 	}
 	
 	public function updateAccount($data,$condition){
 		$table_name = 'account';
 		$this->update($table_name, $data, $condition);
 		return $this->getLastInsID();
 	}
 	public function getAccountById($id){
 		$sql = "select * from account where account_id = '$id'";
 		$result = $this->original_query($sql);
 		return $result;
 	}
 	
 	public function getAccountByName($name){
 		$sql = "select * from account where account_name = '$name'";
 		$result = $this->original_query($sql);
 		return $result;
 	}
 	
 	public function getAccounts(){
 		$sql = "select * from account order by account_id desc";
 		$result = $this->original_query($sql);
 		return $result;
 	}
 	
}

?>