<?php
/**
* 文件描述
*
* @author 张灏 
* @date 2014-9-21
* @version 1.0.0
* @copyright  Copyright 2014 joincoding.com
*/ 
class CategoryModel extends Model{
	protected $_validate = array(
		array('name','','该栏目已存在！',0,'unique',1) // 在新增的时候验证name字段是否唯一
	);
	
	protected $_auto = array(
			array('createtime','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
			array('path','getPath',3,'callback')
	);
	/**
	* @return  树状结构
	* @author 张灏
	* @date 2014-9-21下午4:23:24
	* @version v1.0.0
	 */
	public function select_menu(){
		$data = $this->field("*,concat(path,',',id) as bpath")->order('provice desc ,bpath ASC')->select();
		if ($data) {
			return getTree($data);
		}else{
			return '';
		}
	}
	/**
	 * 
	* Enter description here ...
	* @return string|number path路径
	* @author 张灏
	* @date 2014-9-21下午4:22:42
	* @version v1.0.0
	 */
	public function getPath(){
		if (isset($_POST['pid'])&&$_POST['pid']>0) {
			$f = $this->find($_POST['pid']);
			if ($f) {
				return $f['path'].','.$f['id'];
			}
		}
		return 0;
	}
	/**
	 * 
	* Enter description here ...
	* @param 要删除的数据信息 $menuinfo
	* @author 张灏
	* @date 2014-9-21下午4:22:22
	* @version v1.0.0
	 */
	public function deleteAllMenu($menuinfo){
		$where = array('id'=>$menuinfo['id']);
		$this->where($where)->delete();
		$where = array('path'=>array('like','%,'.$menuinfo['id'].',%'));
		$this->where($where)->delete();
		$where = array('path'=>array('like','%,'.$menuinfo['id']));
		$this->where($where)->delete();
		return '';
	}
	
	
}
?>