<?php
class OrderAction extends BaseAction{
	
	public function __construct(){
		parent::__construct();	
	}
	
	public function index() {
		$model = M('orders');		
		$order = "buy_time desc";
		$search = array();
		if ($this->isPost()){
			$trade_no = trim($this->params['trade_no']);
			if ($trade_no) $search['trade_no'] = array('trade_no'=>$trade_no);
			$order_status = $this->params['order_status'];
			if($order_status!=11){
				$search['status'] = $order_status;
			}
		}
		$lists = $this->_search($model, $search, $order);
		$m_goods = new ProductModel();
		foreach ($lists as $k=>$v){
			$ginfo = $m_goods->getproductById($v['goods_id']);
			$lists[$k]['title'] = $ginfo[0]['title'];
			$lists[$k]['price'] = $ginfo[0]['price'];
		}
		$this->assign('result_list',$lists);
		$this->assign('order_status',C("ORDER_STATUS"));
		$this->display();		
	}
	
	public function detail(){
		$trade_no = $this->params['trade_no'];
		$m_order = new OrderModel();
		$oinfo = $m_order->getOrderByTradeno($trade_no);
		$m_goods = new ProductModel();
		$ginfo = $m_goods->getproductById($oinfo[0]['goods_id']);
		$contact = array();
		if(!empty($oinfo[0]['contact'])){
			$contact = $m_order->getContactByUid($oinfo[0]['contact']);	
		}
		$this->assign('contact',$contact);
		$this->assign('order',$oinfo[0]);
		$this->assign('goods',$ginfo[0]);
		$this->display();
	}
	public function del(){
		$trade_no = $this->params['trade_no'];
		$model = new OrderModel();
		$info = $model->delOrder($trade_no);
		if($info){
			$this->success('已删除');
		}else{
			$this->error("删除失败");
		}
		
	}
}
?>