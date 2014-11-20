<?php
/**
 * 费用管理
 * @author Administrator
 *
 */
class CostAction extends BaseAction{
	
	public function index() {
		$product_id = $_GET['id'];
		$m_cost = new CostModel();
		$cost_list = $m_cost->getCostList($product_id);
		$m_article = new ProductModel();
		$pinfo = $m_article->getproductById($product_id);
		$this->assign('pinfo',$pinfo[0]);
		$this->assign('cost_list',$cost_list);
		$this->display();
	}
	
	public function add(){
		if($this->isPost()){
		 	$accept_params = array('product_id','cost_name','content','cost_sort');
			$data=array();
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
				$data[$gval] = $$gval;
			}	
			$data['createtime']=time();
			$data['updatetime']=time();
			$m_cost = new CostModel();
			$cost_id = $m_cost->addCost($data);
			if(!$cost_id){
				$this->error("添加费用失败",U('Cost/index',array('id'=>$product_id)));
			}else{
				$this->success('添加费用成功',U('Cost/index',array('id'=>$product_id)));
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
		 	$accept_params = array('product_id','cost_name','content','cost_sort');
			$data=array();
			foreach($accept_params as $gval) {
				$$gval = isset($this->params[$gval]) ? $this->params[$gval] : '';
				$data[$gval] = $$gval;
			}	
			$data['updatetime']=time();		
			$id = $_POST['id'];
			$model = new CostModel();
			$res = $model->updateCost($data," id=".$id);			
			$this->success('费用更新成功',U('Cost/index',array('id'=>$product_id)));
		}else{
			$id=$_GET['id'];
			$model = new CostModel();
			$costinfo = $model->getCostById($id);
			$m_article = new ProductModel();
			$pinfo = $m_article->getproductById($costinfo[0]['product_id']);	
			$this->assign('pinfo',$pinfo[0]);		
			$this->assign('costinfo',$costinfo[0]);
			$this->display();
		}
		
	}
	
	public function del(){
		$model = new CostModel();
		$id = (int)$_GET['id'];
		$info = $model->deleteCost($id);
		$this->success('删除成功');
		
	}
}
?>