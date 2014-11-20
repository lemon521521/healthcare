<?php
class TravelAction extends BaseAction{
	
	/**
	 * 行程管理
	 *
	 * @author shenyh
	 * @date 2014-10-28
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */

	public function index() {
		$product_id = $_GET['id'];
		$model = new TravelModel();
		$Travellist = $model->getTravelByProductId($product_id);
		$m_article = new ProductModel();
		$pinfo = $m_article->getproductById($product_id);
		$this->assign('pinfo',$pinfo[0]);
		$this->assign('Travellist',$Travellist);
		$this->display();
	}
	
	public function add(){
		if($this->isPost()){
		 	$accept_params = array('product_id','type','travel_name','travel_title','flight','catering',
		 	'hotel','travel','travel_img','day','detail');
			$data=array();
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
				$data[$gval] = $$gval;
			}	
			$data['createtime']=time();
			$data['updatetime']=time();
			$model = new TravelModel();
			$travel_id=$model->addTravel($data);
			if(!$travel_id){
				$this->error("添加行程失败",U('Travel/index',array('id'=>$product_id)));
			}else{
				$this->success('添加行程成功',U('Travel/index',array('id'=>$product_id)));
			}
						
		}else{
			$product_id = $_GET['id'];
			$m_article = new ProductModel();
			$pinfo = $m_article->getproductById($product_id);			
			$this->assign('pinfo',$pinfo[0]);
			$this->display();
		}
		 
	}
	public function edit(){
		if($this->isPost()){		
		 	$accept_params = array('product_id','type','travel_name','travel_title','flight','catering',
		 	'hotel','travel','travel_img','day','detail');
			$data=array();
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
				$data[$gval] = $$gval;
			}	
			$data['updatetime']=time();		
			$travel_id = $_POST['travel_id'];
			$model = new TravelModel();
			$getLastInsID=$model->updatetravel($data," id=".$travel_id);			
			if(!$getLastInsID){
				$this->error("行程数据更新失败",U('Travel/index',array('id'=>$product_id)));
			}else{				
				$this->success('行程数据更新成功',U('Travel/index',array('id'=>$product_id)));
			}
		}else{
			$id=$_GET['id'];
			$model = new TravelModel();
			$travelList=$model->getTravelById($id);
			$img_str='';
			$travel_img_arr=explode('%', $travelList[0]['travel_img']);
			$pic_html='<div id="J_imageView">';
			foreach ($travel_img_arr as $vv){
				if(empty($vv)){
					continue;
				}
				$pic_html.='<img src="'.$vv.'" height="100px" width="100px">';
				$img_str.=$vv.'%';
			}
			$pic_html.='</div>';
			
			$travelList[0]['picture']=$pic_html;
			$travelList[0]['img_str']=$img_str;
			$m_article = new ProductModel();
			$pinfo = $m_article->getproductById($travelList[0]['product_id']);	
			$this->assign('pinfo',$pinfo[0]);		
			$this->assign('travelList',$travelList[0]);
			$this->display();
		}
		
	}
	public function del(){
		$model = new TravelModel();
		$id = (int)$_GET['id'];
		$info = $model->deltravel($id);
		if($info){
			$this->success('已删除');
		}else{
			$this->error("删除失败");
		}
		
	}
		
	/**
	 * 三级联动数据构造函数
	 *
	 * @author shenyh
	 * @date 2014-9-21
	 * @version 1.0.0	 
	 */
	public function select(){
		$Products =$this->selectProducts();		
		$this->assign('Products',$Products);
	}
	
	/**
	 * 下拉框选择
	 */
		
	public function selectProducts($select_id){		
		$model = new TravelModel();
		$slect=$model->product_select();
		if($slect){
			foreach ($slect as $v){
				if($v['id']==$select_id){
					$select_str='selected="selected"';
				}else{
					$select_str='';
				}
				$html_str.='<option value="'.$v['id'].'" '.$select_str.'>
						'.$v['name'].'
					</option>';
			}		
		}		
		return $html_str;
	}	
}
?>