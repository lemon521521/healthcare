<?php
import("define", APP_NAME."/Conf/", '.php');
class BaseAction extends Action {
	protected $params = array();
	
	protected $free_login = array(
	            'Login/login',
	            'Public/verify',
	);
	    
	public function __construct(){
		header("Content-Type:text/html; charset=utf-8");
		parent::__construct();
		$this->_init_();
	}
	
	/*
	* 初始化请求数据
	*
	*/
	protected function _init_() {
		if($this->isPost()){
			$this->params = $_POST;
		}else{
			$this->params = $_GET;
		}
		foreach ($this->params as $k=>$value) {
			$this->params[$k]=remove_xss($value);
		}
		$action_name = MODULE_NAME.'/'.ACTION_NAME;
		if(!in_array($action_name,$this->free_login)){
			if(!session('?account_id')){
				$this->redirect('Login/login');
			}
		}		
		
	}
	
	public function session_set($key,$value,$expire=0){
		$isSucc = false;
		if($key && $value){
			if(!$expire){
				$expire = 1800;
			}
			session(array('name'=>$key,'expire'=>$expire));
			session($key,$value);
			$isSucc = true;
		}
		return $isSucc;
	}
	
	public function _empty() {  
	    R('Empty/_empty');  
	}
	
	public function alert($type=1,$message=""){
		if(empty($message)){
			switch($type){
				case 1:
					$message='success';
					break;
				case 2:
					$message='error';
					break;
			}
		}
		$alert_html="<div class=\"alert alert-$type\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>$message</div>";
		return $alert_html;
	}
	
	public  function renderJsConfirm($class,$confirm_title="确定要这样做吗？"){
		$confirm_html="<script>";
		if(!is_array($class)){
			$class=explode(',',$class);
		}
		foreach($class as $item){
			$confirm_html .= "
				$('.$item').click(function(){
						var href=$(this).attr('href');
						bootbox.confirm('$confirm_title', function(result) {
							if(result){

								location.replace(href);
							}
						});		
					})
				";
		}
		$confirm_html.="</script>";	
		return $confirm_html;
	}	
	/**
	 * 搜索数据
	 * @param model对象 $model
	 * @param 搜索条件 $search
	 * @param 排序顺序 $order
	 * @return 返回结果
	 */
	public function _search($model,$search,$order){
		if (!$model) return '';
		$step = isset($_REQUEST['step'])?intval($_REQUEST['step']):10;
		$step = ($step<10)?10:$step;
		$step = ($step>100)?100:$step;
		import('ORG.Util.Page');
		$count = $model->where($search)->count();
		$Page = new Page($count,$step);
		return $this->_list($model,$search,$Page,$order);
	}
	/**
	 * 获取所有数据
	 * @param model对象 $model
	 * @param 搜索条件 $search
	 * @param 分页方法 $Page
	 * @param 排序方式 $order
	 * @return 返回结果集
	 */
	public function _list($model,$search,$Page,$order='id ASC'){
		$lists = array();
		$lists = $model->where($search)
			  ->limit($Page->firstRow.','.$Page->listRows)
			  ->order($order)
			  ->select();
		$this->assign('result_list',$lists);
		$this->assign('page',$Page->show());
		return $lists;
	}
	
	public function find_info($model){
		if (isset($_GET['id'])){
			$id = intval($_GET['id']);
			if ($id>0){
				$info = $model->find($id);
				if ($info){
					return $info;	
				}else{
					$this->error('未找到对应的数据');
				}
			}else{
				$this->error('未找到对应的数据');
			}
		}else{
			$this->error('操作有误');
		}
	}
	
	public function _del($model,$isDel=false){
		if (isset($_GET['id'])){
			$id = intval($_GET['id']);
			if ($id>0){
				if ($isDel){
					return $model->where('id='.$id)->delete();
				}else{
					$model->create(array('isdel'=>1));
					return $model->where('id='.$id)->save();
				}
			}else{
				$this->error('未找到对应的数据');
			}
		}else{
			$this->error('操作有误');
		}
	}
	 
	public function __destruct(){
		
	}
}