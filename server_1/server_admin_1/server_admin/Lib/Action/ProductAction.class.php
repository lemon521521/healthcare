<?php
class ProductAction extends BaseAction{
	
	/**
	 * 产品相关
	 *
	 * @author shenyh
	 * @date 2014-9-21
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */
	public function __construct(){
		parent::__construct();	
		import('@.ORG.Util.editor');
	}
	public function index() {
		$model = D('product');
		$search = array('is_del'=>0);
		if ($this->isGet()){
			if (isset($_GET['title'])){
				$title = trim($_GET['title']);
				if ($title) $search['title']=array('like','%'.$title.'%');
			}
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
		$this->display();
	}
	public function add(){
					
		if($this->isPost()){
			$data=array();
			$data=array();
			$data['category_id']=$_POST['subpid']==0?($_POST['pid']==0?0:$_POST['pid']):$_POST['subpid'];
			$data['title']=$_POST['title'];
			$data['short_title']=$_POST['short_title'];
			$data['area_id']=$_POST['area_id'];
			$data['hospital_id']=$_POST['hospital_id'];
			$data['price']=$_POST['price'];
			$data['tel']=$_POST['tel'];
			$data['stroke_number']=$_POST['stroke_number'];
			$data['web_highlights']=$_POST['web_highlights'];
			$data['travel_highlights']=$_POST['travel_highlights'];
			$data['product_highlights']=$_POST['product_highlights'];
			$data['description']=$_POST['description'];			
			$data['characteristic']=$_POST['characteristic'];			
			$data['instructions']=$_POST['instructions'];
			$data['visainfo']=$_POST['visainfo'];
			$data['recommend']=$_POST['recommend'];
			$data['hot']=$_POST['hot'];
			$data['createtime']=time();
			$model = new ProductModel();
			$product_id=$model->addArticle($data);
			if(!$product_id){
				$this->error("插入产品表失败");
			}else{
				if(!empty($_POST['des_img'])){
					$image_arr=explode('%', $_POST['des_img']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=4;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("产品介绍图插入失败");
						}
					}
				}
				if(!empty($_POST['char_img'])){
					$image_arr=explode('%', $_POST['char_img']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=5;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("优势特色图插入失败");
						}
					}
				}
				if(!empty($_POST['bulk_upload'])){
					$image_arr=explode('%', $_POST['bulk_upload']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=3;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("产品图插入失败，请重新添加");
						}
					}
				}
				$this->success('产品添加成功');
			}
		}else{
			$this->select();
			$this->country();
			$html_str=$this->selectCategory(0,5,0);			
			$this->assign('hospital_str',$html_str);
			$recommend=$this->selectCategory(0,6);	
			$this->assign('recommend',$recommend);
			$this->display();
		}
		 
	}
	public function edit(){
		if($this->isPost()){		
			$data=array();
			$data['category_id']=$_POST['subpid']==0?($_POST['pid']==0?0:$_POST['pid']):$_POST['subpid'];
			$data['title']=$_POST['title'];
			$data['short_title']=$_POST['short_title'];
			$data['area_id']=$_POST['area_id'];
			$data['hospital_id']=$_POST['hospital_id'];
			$data['price']=$_POST['price'];
			$data['tel']=$_POST['tel'];
			$data['stroke_number']=$_POST['stroke_number'];
			$data['web_highlights']=$_POST['web_highlights'];
			$data['travel_highlights']=$_POST['travel_highlights'];
			$data['product_highlights']=$_POST['product_highlights'];
			$data['description']=$_POST['description'];			
			$data['characteristic']=$_POST['characteristic'];
			$data['instructions']=$_POST['instructions'];
			$data['visainfo']=$_POST['visainfo'];
			$data['recommend']=$_POST['recommend'];
			$data['hot']=$_POST['hot'];
			$data['updatetime']=time();
			$product_id=$_POST['id'];
			$model = new ProductModel();
			$getLastInsID=$model->updateproduct($data," id=".$product_id);			
			if(!$getLastInsID){
				$this->error("产品数据更新失败");
			}else{
				if(!empty($_POST['des_img'])){
					$image_arr=explode('%', $_POST['des_img']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=4;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("产品介绍图插入失败");
						}
					}
				}
				if(!empty($_POST['char_img'])){
					$image_arr=explode('%', $_POST['char_img']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=5;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("优势特色图插入失败");
						}
					}
				}				
				if(!empty($_POST['bulk_upload'])){
					$image_arr=explode('%', $_POST['bulk_upload']);
					foreach ($image_arr as $v){
						if(empty($v)){
							continue;
						}
						$picture=array();
						$picture['url']=$v;
						$picture['type']=3;
						$picture['name']=$data['title'];
						$picture['createtime']=time();
						$picture['product_id']=$product_id;
						$picture_id=$model->addPicture($picture);
						if(!$picture_id){
							$this->error("产品更新失败");
						}
					}
				}
				$this->success('产品更新成功',U('Product/index'));
			}
			
			
		}else{
			$this->getproductById();
			$this->display();
		}
		
	}
	public function del(){
		$model = new ProductModel();
		$id = (int)$_GET['id'];
		$info = $model->delproduct($id);
		if($info){
			$this->success('已删除');
		}else{
			$this->error("删除失败");
		}
		
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
	
	public function get_data(){
		$editor=new editor();
		$a=$editor->getEditorContent();   //获取编辑器的内容
		print_r($a);
		die;
		$this->assign('a',$a);
		$this->display("test");
	}
	/**
	 * 三级联动数据构造函数
	 *
	 * @author shenyh
	 * @date 2014-9-21
	 * @version 1.0.0	 
	 */
	public function select(){
		$Category =$this->selectCategory(0,1,0);
		//$Category = $model->getCategory();		
		$this->assign('Category',$Category);
	}
	public function ajaxBySub(){
		$id=$_REQUEST['id'];
		//$model = new ProductModel();
		//$SubCategory = $model->getSubCategory($id);
		//$html='<option value=0>请选择二级栏目</option>';
		/* if($SubCategory){
			foreach ($SubCategory as $v){
				$html.='<option value='.$v['id'].'>'.$v['name'].'</option>';
			}
		} */
		$SubCategory =$this->selectCategory($id,2,0);
		echo json_encode($SubCategory);
	}
	public function ajaxByChrSub(){
		$id=$_REQUEST['id'];
		/* $model = new ProductModel();
		$SubCategory = $model->getChrSubCategory($id);
		$html='<option value=0>请选择三级栏目</option>';
		if($SubCategory){
			foreach ($SubCategory as $v){
				$html.='<option value='.$v['id'].'>'.$v['name'].'</option>';
			}
		} */
		$SubCategory =$this->selectCategory($id,3,0);
		echo json_encode($SubCategory);
	}
	/**
	 * 下拉框选择
	 */
		
	public function selectCategory($parent_id,$type,$select_id){		
		$model = new ProductModel();
		header("Content-Type:text/html;charset=utf-8");
		switch($type){
			case 1:
				$slect=$model->getCategory();
				$html_str='<option value=0>请选择一级栏目</option>';
				break;
			case 2:
				$html_str='<option value=0>请选择二级栏目</option>';
				$slect=$model->getSubCategory($parent_id);
				break;
			case 3:
				$html_str='<option value=0>请选择三级栏目</option>';
				$slect=$model->getChrSubCategory($parent_id);
				break;
			case 4:
				$html_str='<option value=0>请选择国家</option>';
				$slect=$model->getCountryByName();
				break;
			case 5:
				$html_str='<option value=0>请选择医院</option>';
				$slect=$model->hospital_select();				
				break;
			case 6:				
				$slect=C('PRODUCT_STATUS');		
				break;
			default:
				break;	
		}
		if($slect){
			foreach ($slect as $k=>$v){
				
				if($type==6){	
					if($k==$select_id){
						$select_str='selected="selected"';
					}else{
						$select_str='';
					}				
					$html_str.='<option value="'.$k.'" '.$select_str.'>
						'.$v.'
					</option>';
				}else{
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
		}
		return $html_str;
	}
	public function country(){
		
		$country = $this->selectCategory(0,4,0);		
		$this->assign('country',$country);
	}
	public function getproductById(){
		$id=$_GET['id'];
		$model = new ProductModel();
		$productList=$model->getproductById($id);
		if($productList){
			$data=array();
			foreach ($productList as $k=>$v){				
				$pic=$model->getPictureByProductId($v['id'],0);
				$img_str='';
				$pic_html='<div id="J_imageView">';
				foreach ($pic as $kk=>$vv){
					if($vv['type'] == 4 || $vv['type'] == 5){
						continue;
					}
					$pic_html.='<img src="'.$vv['url'].'" height="100px" width="100px">';
					$img_str.=$vv['url'].'%';
				}
				$pic_html.='</div>';
				
				$productList[$k]['picture']=$pic_html;
				$productList[$k]['img_url']=$img_str;				
				$productList[$k]['recommend_select']=$this->selectCategory(0,6,$v['recommend']);
				$pid=$model->getCategoryByPid($v['category_id']);				
				if($pid==0){
					$productList[$k]['pid']=$this->selectCategory(0,1,$v['category_id']);
					$productList[$k]['subpid']=$this->selectCategory($v['category_id'],2,0);
				}else{					
					$productList[$k]['pid']=$this->selectCategory(0,1,$pid);
					$productList[$k]['subpid']=$this->selectCategory($pid,2,$v['category_id']);
				}
				$productList[$k]['country']=$this->selectCategory(0,4,$v['area_id']);			
				$productList[$k]['hospital_name']=$this->selectCategory(0,5,$v['hospital_id']);
				$intr_img_arr=explode('%', $v['product_img']);
		
				if($intr_img_arr){
					$intr_html='<div id="intr_img_div">';
					foreach ($intr_img_arr as $vv){
						if(empty($vv)){
							continue;
						}
						$intr_html.='<img src="'.$vv.'" height="100px" width="100px">';
					
					}
					$intr_html.='</div>';
					$productList[$k]['intr_img']=$intr_html;
				}else{
					$productList[$k]['intr_img']='<div id="intr_img_div"></div>';
				}				
				$effect_img_arr=explode('%', $v['product_effect_img']);				
				if($effect_img_arr){
					$effect_html='<div id="effect_img_div">';
					foreach ($effect_img_arr as $_vv){
						if(empty($_vv)){
							continue;
						}
						$effect_html.='<img src="'.$_vv.'" height="100px" width="100px">';
				
					}
					$effect_html.='</div>';
					$productList[$k]['effect_img']=$effect_html;
				}else{
					$productList[$k]['effect_img']='<div id="effect_img_div"></div>';
				}
				
			}
		}
		//print_r($productList);
		$this->assign('productList',$productList);
	}
	public function pic_edit(){
		$product_id=$_REQUEST['id'];
		$model = new ProductModel();
		$PicturetList=$model->getPictureByProductId($product_id);		
		if($PicturetList){		              	
			foreach ($PicturetList as $k=>$v){
				$select=$this->pic_select($v['type']);	
				$sort_select=$this->pic_sort_select($v['order_sort']);
				$PicturetList[$k]['select']="
              	<select name='pic[".$k."][type]' class='type' select_id=".$v['id'].">
              	".$select."							
				</select>
              ";
				$PicturetList[$k]['sort_select']="
				<select name='pic[".$k."][order_sort]' class='sort' sort_select_id=".$v['id'].">
				".$sort_select."
				</select>
				";
			}
		}
		$this->assign('pid',$product_id);
		$this->assign("PicturetList",$PicturetList);
		$this->display('pic_index');
	}
	public function pic_select($select_id){
		$select_arr=array("首页图","推荐图","详情图","产品介绍图","优势特色图");
		$select_html='';
		foreach ($select_arr as $k=>$v){			
			$n=$k+1;			
			if($n==$select_id){
				$select_str='selected="selected"';
			}else{
				$select_str='';
			}
			$select_html.='<option '.$select_str.' value="'.$n.'">'.$v.'</option>';
		}
		return $select_html;
	}
	public function pic_sort_select($select_id){
		$select_arr=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
		$select_html='';
		foreach ($select_arr as $k=>$v){
			$n=$k+1;
			if($n==$select_id){
				$select_str='selected="selected"';
			}else{
				$select_str='';
			}
			$select_html.='<option '.$select_str.' value="'.$n.'">'.$v.'</option>';
		}
		return $select_html;
	}
	public function pic_del(){
		$id = $_GET['id'];							
		$model = new ProductModel();
		$where=" id=".$id;
		$pic_id=$model->delPicture($where);		
		if($pic_id){
			$this->success('删除图片成功');
		}else{
			$this->error("删除图片失败");
		}
	}
	
	public function ajax_pic_eidt(){	
		if($this->isGet()){
			$model = new ProductModel();
			$type = $_GET['type'];
			$id = $_GET['id'];							
			$picture_arr['type']=$type;
			$where=" id=".$id;
			$pic_id=$model->updatepicture($picture_arr,$where);
			if($pic_id){
				echo 1;
			}else{
				echo 0;
			}			
		}else{
			echo 0;
		}				
	}
	public function ajax_pic_sort(){
		if($this->isGet()){
			$model = new ProductModel();
			$order_sort= $_GET['order_sort'];
			$id = $_GET['id'];
			$picture_arr['order_sort']=$order_sort;
			$where=" id=".$id;
			$pic_id=$model->updatepicture($picture_arr,$where);
			if($pic_id){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	public function pic_eidtname(){
		if($this->isPost()){
			$model = new ProductModel();					
			$id = $_POST['pic_id'];
			$product_id=$_POST['product_id'];
			$picture_arr['name']=$_POST['name'];
			$where=" id=".$id;
			$pic_id=$model->updatepicture($picture_arr,$where);
			if($pic_id){
				$this->success('图片名称更新成功');
			}else{
				$this->error("图片名称修改失败");
			}
			
		}else{
			$this->error("图片名称修改失败");
		}
	}
}
?>