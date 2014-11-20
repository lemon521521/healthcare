<?php
/**
* 文件描述
*
* @author 张灏 
* @date 2014-9-21
* @version 1.0.0
* @copyright  Copyright 2014 joincoding.com
*/ 
class CategoryAction extends BaseAction{
	
	public function index(){
		$this->get_menu();
		$this->display();
	}
	
	public function _before_add(){
		if ($this->isPost()) {
			$model = new CategoryModel();
			if($model->create()){
				$id = $model->add();
				if ($id) {
					$this->success('添加成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
			exit;
		}
		$this->get_menu();
	}
	
	
	public function add(){
		$this->display();
	}
	
	public function _before_edit(){
		$this->find_category_id();
		if ($this->isPost()) {
			$model = new CategoryModel();
			if($model->create()){
				$id = $model->save();
				if ($id) {
					$this->success('添加成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
			exit;
		}
		$this->get_menu();
		
	}
	
	public function find_category_id(){
		$id = $_REQUEST['id'];
		$model = new CategoryModel();
		$info = $model->find($id);
		if (!$info) {
			$this->error('未找到对应操作');
			exit;
		}
		$this->assign('info',$info);
	}
	
	public function edit(){
		$this->display();
	}
	
	public function get_menu(){
		$model = new CategoryModel();
		$menu = $model->select_menu();
		$this->assign('menu',$menu);
	}
	
	public function del(){
		$model = new CategoryModel();
		$id = (int)$_GET['id'];
		$info = $model->find($id);
		if ($info) {
			$model->deleteAllMenu($info);
		}
		$this->success('已删除');
	}
}
?>