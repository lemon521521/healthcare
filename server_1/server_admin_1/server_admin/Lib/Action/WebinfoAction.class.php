<?php
/**
* 
* @filename: WebinfoAction.class.php
* @date: 2014-10-27
* @author: 张灏 <EMAIL>
* @version: v1.0
* @copyright: Copyright (c) 2011-2014 (http://www.credithc.com)
* @class: 首页信息管理 
*/
class WebinfoAction extends BaseAction{
	public function index(){
		$this->get_activities_list();
		$this->display();
	}
	
	public function add(){
		if ($this->isPost()){
			$this->add_activities();
		}
		$this->display();
	}
	
	public function get_activities_list($type=1){
		$model = new ActivitiesModel('activities');
		$search = array('isdel'=>0);
		if(is_array($type)){
			$type_str = join(',', $type);
			$search['types'] = array('in',$type_str);
		}else{
			$search['types'] = $type;
		}
		if ($this->isGet()){
			if (isset($_GET['title'])){
				$title = trim($_GET['title']);
				if ($title) $search['title']=array('like','%'.$title.'%');
			}
		}
		$list = $this->_search($model, $search, 'sort DESC');
	}
	
	public function add_activities(){
		$model = new ActivitiesModel('activities');
		if ($model->create()){
			if($model->add()){
				$this->success('添加内容成功');
			}else{
				$this->error($model->getError());
			}
		}else{
			$this->error($model->getError());
		}
		exit;
	}
	public function edit(){
		if ($this->isPost()){
			$this->save_activities();
		}
		$model = new ActivitiesModel('activities');
		$data = $this->find_info($model);
		$this->assign('info',$data);
		$this->display();
	}
	
	public function save_activities(){
		$model = new ActivitiesModel('activities');
		if ($model->create()){
			if($model->save()){
				$this->success('保存内容成功');
			}else{
				$this->error($model->getError());
			}
		}else{
			$this->error($model->getError());
		}
		exit;
	}
	
	public function del(){
		$model = new ActivitiesModel('activities');
		$result = $this->_del($model);
		if ($result){
			$this->success('删除成功');
		}else{
			$this->error($model->getError());
		}
		
	}
	
	public function ads(){
		$type = array('2','3','4');
		$this->get_activities_list($type);
		$this->display('ads');
	}
	
	public function  addads(){
		if ($this->isPost()){
			$this->add_activities();
		}
		$this->display();
	}
	
	public function editads(){
		$this->edit();
	}
}
?>