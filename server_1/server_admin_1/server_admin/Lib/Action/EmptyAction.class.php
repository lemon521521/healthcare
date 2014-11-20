<?php
class EmptyAction extends BaseAction {

	public function __construct(){
		parent::__construct();
	}
      
    public function _empty() {  
        header('HTTP/1.1 404 Not Found');  
        $this->display('Login:login');  
    } 
    
    public function index() {  
        $this->_empty();  
    }  
      
}