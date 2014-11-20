<?php
/**
 * 
 * @author 张灏
 * seo 信息设置
 *
 */
class SeoInfoAction extends BaseAction{
	
	
	public function addIndex(){
		$type = intval($this->params['type_id']);
		if (!$type) {
			$type = 1;
		}
		$type_config = C('SEO_TYPE');
		$this->assign('config',$type_config);
		$index = $this->getSeoInfo($type);
		$this->assign('info',$index);
		$this->assign('type',$type);
		$this->assign('perid',0);
		$this->display('add');
	}
	
	
	private function getSeoInfo($type,$per_id=0){
		$model = M('seo_info');
		$search = array(
				'type'=>intval($type)
		);
		if ($per_id>0) {
			$search['per_id']=$per_id;
		}
		return $model->where($search)->find();
	}
	
	public function add(){
		if ($this->isPost()) {
			$model = new SeoInfoModel();
			$re = $model->insertData($this->params);
			if ($re) {
				$this->success('操作成功');
			}else{
				$this->error('没有任何改变');
			}
		}else{
			$this->error('参数有误');
		}
	}
	
	public function product(){
		$model = D('product');
		$search = array('is_del'=>0);
		if (isset($_GET['title'])){
			$title = trim($_GET['title']);
			if ($title) $search['title']=array('like','%'.$title.'%');
		}
		$list = $this->_search($model, $search, 'id DESC');
		if($list){
			$model = new ProductModel();
			foreach ($list as $k=>$v){
				$hospital_id=$v['hospital_id'];
				$hospital=$model->getHospitalById($hospital_id);
				$list[$k]['hospital_name']=$hospital[0]['hospital_name'];
			}
		}
		$this->getList();
		$this->display('product');
	}
	
	public function getList(){
		$model = new ProductModel();
		$Articlelist = $model->getArticle();
		if($Articlelist){
			foreach ($Articlelist as $k=>$v){
				$hospital_id=$v['hospital_id'];
				$hospital=$model->getHospitalById($hospital_id);
				$Articlelist[$k]['hospital_name']=$hospital[0]['hospital_name'];
			}
		}
		$this->assign('Articlelist',$Articlelist);
	}
	
	public function addproduct(){
		$perid = $this->params['product_id'];
		$perid = intval($perid);
		if ($perid>0){
			$index = $this->getSeoInfo(3,$perid);
			$this->assign('info',$index);
			$this->assign('type',3);
			$this->assign('perid',$perid);
			$this->display('add');
		}else{
			$this->error('参数有误');
		}
	}
	
	public function menu(){
		$this->get_menu();
		$this->display('menu');
	}
	
	public function get_menu(){
		$model = new CategoryModel();
		$menu = $model->select_menu();
		$this->assign('menu',$menu);
	}
	
	public function addmenu(){
		$perid = $this->params['menu_id'];
		$perid = intval($perid);
		if ($perid>0){
			$index = $this->getSeoInfo(2,$perid);
			$this->assign('info',$index);
			$this->assign('type',2);
			$this->assign('perid',$perid);
			$this->display('add');
		}else{
			$this->error('参数有误');
		}
	}
}
?>