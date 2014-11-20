<?php
class MemberAction extends BaseAction{
	
	public function __construct(){
		parent::__construct();	
	}
	
	public function index() {
		$model = M('member');		
		$order = "createtime desc";
		$search = array();
		if ($this->isPost()){
			$name = trim($this->params['name']);
			if ($name) $search['name'] = array('name'=>$name);
		}
		$lists = $this->_search($model, $search, $order);
		$this->display();		
	}
}
?>