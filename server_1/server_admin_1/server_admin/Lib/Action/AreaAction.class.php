<?php
class AreaAction extends BaseAction{

	/**
	 * 文件描述
	 *
	 * @author shenyh
	 * @date 2014-10-9
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */
	public function index() {
		
		$this->getList();
		$this->display();
	}
	public function getList(){
		$model = new AreaModel();
		$Arealist = $model->getAreaList();
		$this->assign('Arealist',$Arealist);
	}
	public function add(){
		if($this->isPost()){
			$data=array();
			$data['name']=$_POST['name'];
			$data['en_name']=$_POST['en_name'];
			$data['area_url']=$_POST['thumb_img'];
			$data['order_sort']=$_POST['order_sort'];
			$data['reg_time']=date("Y-m-d H:m:s");
			$model = new AreaModel();
			$area_id=$model->addArea($data);
			if($area_id){
				$this->success("国家添加成功",U('Area/index'));
			}else{
				$this->error("国家添加失败");
			}
		}else{
			$this->display();
		}
	}
	public function edit(){
		if($this->isPost()){
			$data=array();
			$data['name']=$_POST['name'];
			$data['en_name']=$_POST['en_name'];
			$data['order_sort']=$_POST['order_sort'];
			$data['area_url']=$_POST['thumb_img'];
			$id=$_POST['id'];
			$where=" id =".$id;
			$model = new AreaModel();
			$area_id=$model->updateArea($data,$where);
			if($area_id){
				$this->success("国家更新成功",U('Area/index'));
			}else{
				$this->error("国家更新失败");
			}
		}else{
			$this->getAreaById();
			$this->display();
		}
	}
	public function del(){
		$model = new AreaModel();
		$id = (int)$_GET['id'];
		$info = $model->delArea($id);
		if($info){
			$this->success('已删除',U('Area/index'));
		}else{
			$this->error("删除失败");
		}
	}
	public function getAreaById(){
		$id=$_GET['id'];
		$model = new AreaModel();
		$Area=$model->getAreaById($id);
		$this->assign("Area",$Area);
	}
	
}
?>