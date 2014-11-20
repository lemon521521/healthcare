<?php
class IndexAction extends BaseAction {
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
		$this->display();
    }
}