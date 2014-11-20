<?php
class LoginAction extends BaseAction {
	
    public function __construct(){
    	parent::__construct();
    }
    
    // 用户登录页面
    public function login() {
    	if($this->isPost()){
	    	$accept_params = array('user_name','password','verify_code');
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
			}
			$m_account = new AccountModel();
			$result = $m_account->getAccountByName($user_name);
			if(empty($result) || strcmp(md5($password),$result[0]['account_pwd']) != 0){
				$message = $this->alert(2,'用户名或密码错误');
				$this->assign('message',$message);
				$this->display();
				exit;
			}
    		if(md5($verify_code) != session('verify')){
				$message = $this->alert(1,'验证码错误');
				$this->assign('message',$message);
				$this->display();
				exit;
    		}
    		$this->session_set('account_id',$result[0]['account_id'],86400);
    		$this->session_set('account_name',$result[0]['account_name'],86400);
    		$this->redirect('Index/index');
    	}else{
    		$this->display();
    	}
    }

    // 用户登出
    public function loginOut() {
    	session(null);
    	session_destroy();
    	$this->redirect('/Login/login');
    }

}