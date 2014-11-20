<?php
class HospitalAction extends BaseAction{

	/**
	 * 文件描述
	 *
	 * @author shenyh
	 * @date 2014-10-26
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */
	public function index() {	
		$list=$this->getList();
		$this->assign('Hospitallist',$list);
		$this->display();
	}
	public function getList(){
		$physican_str='';
		$model = M('hospital');
		$search['status']=2;
		if ($this->isGet()){
			if (isset($_GET['hospital_name'])){
				$title = trim($_GET['hospital_name']);
				if ($title) $search['hospital_name']=array('like','%'.$title.'%');
			}
		}
		$list=$this->_search($model, $search, '`insert_time` desc');
		return $list;
		/*$Hospitallist = $model->getHospitalList();		
	 	foreach ($Hospitallist as $k=>$v){
			$id=$v['id'];
			$physician_arr_id=$this->getHospitalPhysicianById($id);			
			if($physician_arr_id){
				foreach ($physician_arr_id as $kk=>$vv){
					$physician_id=$vv['physician_id'];
					$physician_name=$this->getPhysicianByname($physician_id);
					$physican_str.=$physician_name.',';
				}
				$Hospitallist[$k]['physician']=$physican_str;
			}else{
				$Hospitallist[$k]['physician']='';
			}
		} */
		//$this->assign('Hospitallist',$Hospitallist);
	}
	public function add(){
		if($this->isPost()){			
			$data=array();
			$data['hospital_name']=$_POST['hospital_name'];
			$data['introduction']=$_POST['introduction'];
			$data['introduction_img']=$_POST['bulk_upload'];
			$data['characteristic']=$_POST['characteristic'];
			$data['medical_team']=$_POST['medical_team'];
			$data['area_id']=$_POST['area_id'];
			$data['high_customers_title']=$_POST['high_customers_title'];
			$data['high_customers']=$_POST['high_customers'];
			$data['honor_information']=$_POST['honor_information'];
			$data['short_title']=$_POST['short_title'];
			$data['hospital_img']=$_POST['thumb_img'];
			$data['hospital_logo']=$_POST['thumb_logo'];
			$data['thumb_img']=$_POST['thumb'];
			$data['address']=$_POST['address'];
			$data['insert_time']=time();
			$data['update_time']=time();
			$model = new HospitalModel();
			$Hospital_id=$model->addHospital($data);
			if($Hospital_id){
				if($_POST['physician_id']){
				foreach ($_POST['physician_id'] as $k=>$v){
					$index_arr['hospital_id']=$Hospital_id;
					$index_arr['physician_id']=$v;
					$index_id=$model->addHospitalPhysicianIndex($index_arr);
					if(!$index_id){
						$this->error("医院关联医师失败");
					}
				}
				}
				$this->success("医院添加成功",U('Hospital/index'));
			}else{
				$this->error("医院添加失败");
			}
		}else{
			$select_str=$this->AllSelect();
			$country=$this->country();
			$this->assign('country',$country);
			$this->assign("select_str",$select_str);
			$this->display();
		}
	}
	public function edit(){
		if($this->isPost()){
			$data=array();
			$data['hospital_name']=$_POST['hospital_name'];
			$data['introduction']=$_POST['introduction'];
			$data['characteristic']=$_POST['characteristic'];
			$data['medical_team']=$_POST['medical_team'];
			$data['area_id']=$_POST['area_id'];
			$data['high_customers']=$_POST['high_customers'];
			$data['high_customers_title']=$_POST['high_customers_title'];
			$data['honor_information']=$_POST['honor_information'];
			$data['short_title']=$_POST['short_title'];
			if(!empty($_POST['thumb_img'])) $data['hospital_img']=$_POST['thumb_img'];
			if(!empty($_POST['thumb_logo'])) $data['hospital_logo']=$_POST['thumb_logo'];			
			if(!empty($_POST['thumb'])) $data['thumb_img']=$_POST['thumb'];			
			$data['address']=$_POST['address'];
			//$data['insert_time']=time();
			$data['update_time']=time();
			$id=$_POST['id'];
			$where=" id =".$id;
			$model = new HospitalModel();
			$Hospital_id=$model->updateHospital($data,$where);
			if($Hospital_id){
					/* 	if($_POST['physician_id']){
			$is_del=$this->del_index($id);
					if($is_del){
						foreach ($_POST['physician_id'] as $k=>$v){
							$index_arr['hospital_id']=$Hospital_id;
							$index_arr['physician_id']=$v;
							$index_id=$model->addHospitalPhysicianIndex($index_arr);
							if(!$index_id){
								$this->error("医院关联医师失败");
							}
						}	
					}
					
				} */
				$this->success("医院更新成功",U('Hospital/index'));
			}else{
				$this->error("医院更新失败");
			}
		}else{
			$this->getHospitalById();
			$this->display();
		}
	}
	public function del(){
		$model = new HospitalModel();
		$id = (int)$_GET['id'];
		$info = $model->delHospital($id);
		if($info){
			$this->success('已删除',U('Hospital/index'));
		}else{
			$this->error("删除失败");
		}
	}
	public function getHospitalById(){
		$id=$_GET['id'];
		$model = new HospitalModel();
		$Hospital=$model->getHospitalById($id);
		if($Hospital){
			foreach ($Hospital as $k=>$v){
				$select=$this->select($id,1);
				$physician_select=$this->select('',0);
				$Hospital[$k]['select']=$select;
				$Hospital[$k]['country']=$this->country($v['area_id']);
				$Hospital[$k]['physician_select']=$physician_select;
				if($v['hospital_img']){
					$Hospital[$k]['html_img']='<div id="J_imageView"> <img src="'.$v['hospital_img'].'" height="100px" width="100px"></div>';
					
				}else{
					$Hospital[$k]['html_img']='<div id="J_imageView"> </div>';
					
				}
				if($v['hospital_logo']){
					$Hospital[$k]['html_logo']='<div id="J_logo"> <img src="'.$v['hospital_logo'].'" height="100px" width="100px"></div>';
					
				}else{
					$Hospital[$k]['html_logo']='<div id="J_logo"></div>';
					
				}
				if($v['thumb_img']){
					$Hospital[$k]['html_thumb']='<div id="J_thumb"> <img src="'.$v['thumb_img'].'" height="100px" width="100px"></div>';
						
				}else{
					$Hospital[$k]['html_thumb']='<div id="J_thumb"></div>';
						
				}
					
						}
		}
		$this->assign("Hospital",$Hospital);
	}
	public function getPhysicianByname($id){		
		$model = new HospitalModel();
		$Hospital=$model->getPhysicianByname($id);
		return $Hospital[0]['physician_name'];
		
	}
	public function AllSelect(){
		header("Content-type:text/html;charset=utf-8");
		$model = new HospitalModel();
		$Hospital=$model->physician_AllSelect();	
		$select_str='';
		if($Hospital){
			foreach ($Hospital as $k=>$v){
				$select_str.='<option  value='.$v['id'].'}>'.$v['physician_name'].'</option>';
			}
			return $select_str;
		}else{
			return false;
		}
	}
	public function select($id,$type){
		header("Content-type:text/html;charset=utf-8");
		$model = new HospitalModel();
		$Hospital=$model->physician_Select($id);
		if($type==1){
			$select='selected';
		}else{
			$select='';
		}
		$select_str='';
		if($Hospital){
			foreach ($Hospital as $k=>$v){
				$select_str.='<option '.$select.' value='.$v['id'].'>'.$v['physician_name'].'</option>';
			}
			return $select_str;
		}else{
			return false;
		}
	}
	public function getHospitalPhysicianById($id){
		$model = new HospitalModel();
		$Hospital=$model->getHospitalPhysicianById($id);
		return $Hospital;
	}
	//删除关联，重新关联医院和医师
	public function del_index($id){
		$model = new HospitalModel();
		$is_del=$model->del_index($id);
		return $is_del;
	}
	public function country($id){
		$model = new HospitalModel();
		$country=$model->getCountryByName();						
		$select_str='';
		if($country){
			foreach ($country as $k=>$v){				
				if($v['id']==$id){
					$select='selected';
				}else{
					$select='';
				}
				$select_str.='<option '.$select.' value='.$v['id'].'>'.$v['name'].'</option>';
			}			
			return $select_str;
		}else{
			return false;
		}
		//$this->assign('country',$country);
	}
}