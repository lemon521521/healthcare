<?php
class PhysicianAction extends BaseAction{

	/**
	 * 文件描述
	 *
	 * @author shenyh
	 * @date 2014-10-26
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */
	public function index() {

		$this->getList();
		$this->display();
	}
	public function getList(){
		$model = new PhysicianModel();
		$Physicianlist = $model->getPhysicianList();
		$this->assign('Physicianlist',$Physicianlist);
	}
	public function add(){
		if($this->isPost()){
			$data=array();
			
			$data['physician_name']=$_POST['physician_name'];
			$data['introduction']=$_POST['introduction'];
			$data['img_url']=$_POST['img_url'];
			$data['insert_time']=time();
			$data['update_time']=time();
			$model = new PhysicianModel();
			$Physician_id=$model->addPhysician($data);
			if($Physician_id){
				$this->success("医师添加成功",U('Physician/index'));
			}else{
				$this->error("医师添加失败");
			}
		}else{
			$this->display();
		}
	}
	public function edit(){
		if($this->isPost()){
			$data=array();
				$data['physician_name']=$_POST['physician_name'];
			$data['introduction']=$_POST['introduction'];
			$data['img_url']=$_POST['img_url'];
			//$data['insert_time']=time();
			$data['update_time']=time();
			$id=$_POST['id'];
			$where=" id =".$id;
			$model = new PhysicianModel();
			$Physician_id=$model->updatePhysician($data,$where);
			if($Physician_id){
				$this->success("医师更新成功",U('Physician/index'));
			}else{
				$this->error("医师更新失败");
			}
		}else{
			$this->getPhysicianById();
			$this->display();
		}
	}
	public function del(){
		$model = new PhysicianModel();
		$id = (int)$_GET['id'];
		$info = $model->delPhysician($id);
		if($info){
			$this->success('已删除',U('Physician/index'));
		}else{
			$this->error("删除失败");
		}
	}
	public function getPhysicianById(){
		$id=$_GET['id'];
		$model = new PhysicianModel();
		$Physician=$model->getPhysicianById($id);
		$this->assign("Physician",$Physician);
	}
}