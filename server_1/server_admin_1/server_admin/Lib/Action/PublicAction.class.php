<?php
class PublicAction extends BaseAction {
	
    public function header(){
    	$this->display();
    }
    public function footer(){
    	$this->display();
    }
    public function navibar(){
    	$this->display();
    }
    public function sidebar(){
    	$this->display();
    }
    
    public function verify() {
        $type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }
    
}