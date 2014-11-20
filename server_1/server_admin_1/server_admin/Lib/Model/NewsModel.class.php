<?php
/**
 * 文件描述
 *
 * @author shenyh
 * @date 2014-10-9
 * @version 1.0.0
 */
class NewsModel extends BaseModel{
	public function getNewsList(){
		$sql = "select * from `news` where status=2 order by `insert_time` desc";
		$result = $this->original_query($sql);
		return $result;
	}
	public function addNews($data){
		$result = false;
		if($data){
			$table_name = 'news';
			$this->add($table_name, $data);		
			$result = $this->getLastInsID();
		}
		return $result;
	}
	public function updateNews($data,$condition){
		$table_name = 'news';
		$this->update($table_name, $data, $condition);		
		return $this->getLastSql();
	}
	public function delNews($id){
		$sql = "update news set status=0 where id='$id'";
	 	$this->original_query($sql,2);
		return $this->getLastSql();
	}
	public function getNewsById($id){
		$sql = "select * from news where id = '$id'";
		$result = $this->original_query($sql);
		return $result;
	}	
}
?>