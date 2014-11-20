<?php
class AccountAction extends BaseAction {
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
    	$m_account = new AccountModel();
    	$accounts = $m_account->getAccounts();
    	$this->assign('accounts',$accounts);
		$this->display();
    }
    
    public function add(){
    	if($this->isPost()){
		 	$accept_params = array('user_name','password');
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
			}	
			$m_account = new AccountModel();
			$data = array('account_name'=>$user_name,'account_pwd'=>md5($password),'add_time'=>date('Y-m-d H:i:s'),
			'last_login_time'=>date('Y-m-d H:i:s'),'last_login_ip'=>get_client_ipaddr());
			if($m_account->addAccount($data)){
				$this->success('新增用户成功！',U('Account/index'));	
			}else{
				$this->error('新增用户失败');
			}
    	}else{
	    	$this->display();
    	}
    }
    
    public function del(){
	 	$accept_params = array('id');
		foreach($accept_params as $gval) {
			$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
		}	
		$m_account = new AccountModel();
		$re = $m_account->delAccount($id);
		$this->success('删除成功！',U('Account/index'));
    }
    
    public function edit(){
    	$m_account = new AccountModel();
        if($this->isPost()){
		 	$accept_params = array('account_id','user_name','password');
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
			}	
			if($password){
				$data = array('account_name'=>$user_name,'account_pwd'=>$password,'last_login_time'=>date('Y-m-d H:i:s'),'last_login_ip'=>get_client_ipaddr());
				$condition = 'account_id='.$id;
				$m_account->updateAccount($data,$condition);
				$this->success('修改成功！');	
			}else{
				$this->error('修改失败');
			}
    	}else{
 		 	$accept_params = array('id');
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
			}
			if($id){
				$m_account = new AccountModel();
				$account = $m_account->getAccountById($id);
				$this->assign('account',$account[0]);
			}
	    	$this->display();
    	}   	
    }
}