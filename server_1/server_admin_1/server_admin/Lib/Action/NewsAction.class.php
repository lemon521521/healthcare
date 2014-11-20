<?php
class NewsAction extends BaseAction{

	/**
	 * 文件描述
	 *
	 * @author shenyh
	 * @date 2014-11-16
	 * @version 1.0.0
	 * @copyright  Copyright 2014 joincoding.com
	 */
	public function index() {
		$model = D('news');
		$search = array('status'=>2);
		if ($this->isGet()){
			if (isset($_GET['title'])){
				$title = trim($_GET['title']);
				if ($title) $search['title']=array('like','%'.$title.'%');
			}
		}
		$list = $this->_search($model, $search, 'insert_time DESC','Newslist');
		$this->getList();
		$this->display();
	}
	public function getList(){
		$model = new NewsModel();
		$Newslist = $model->getNewsList();
		$this->assign('Newslist',$Newslist);
	}
	public function add(){
		if($this->isPost()){
			$data=array();			
			$data['title']=$_POST['title'];
			$data['author']=$_POST['author'];
			$data['keywords']=$_POST['keywords'];
			$data['description']=$_POST['description'];
			$data['type']=$_POST['type'];
			$data['status']=2;
			$data['content']=$_POST['content'];
			$data['insert_time']=time();
			$data['update_time']=time();			
			$model = new NewsModel();
			$News_id=$model->addNews($data);
			if($News_id){
				$this->success("新闻添加成功",U('News/index'));
			}else{
				$this->error("新闻添加失败");
			}
		}else{
			$select=$this->news_select();
			$this->assign('select',$select);
			$this->display();
		}
	}
	public function edit(){
		if($this->isPost()){
			$data=array();
			$data['title']=$_POST['title'];
			$data['author']=$_POST['author'];
			$data['keywords']=$_POST['keywords'];
			$data['description']=$_POST['description'];
			$data['type']=$_POST['type'];
			$data['status']=2;
			$data['content']=$_POST['content'];
			
			$data['update_time']=time();
			$id=$_POST['id'];
			$where=" id =".$id;
			$model = new NewsModel();
			$News_id=$model->updateNews($data,$where);
			if($News_id){
				$this->success("新闻更新成功",U('News/index'));
			}else{
				$this->error("新闻更新失败");
			}
		}else{
			$News=$this->getNewsById();
			foreach ($News as $k =>$v){
				$News[$k]['select']=$this->news_select($v['type']);
			}
			$this->assign("News",$News);
			$this->display();
		}
	}
	public function del(){
		$model = new NewsModel();
		$id = (int)$_GET['id'];
		$info = $model->delNews($id);
		if($info){
			$this->success('已删除',U('News/index'));
		}else{
			$this->error("删除失败");
		}
	}
	public function getNewsById(){
		$id=$_GET['id'];
		$model = new NewsModel();
		$News=$model->getNewsById($id);
		return 	$News;
	}
	public function news_select($select_id){
		$select_arr=array("公司新闻","产品新闻","海外医院新闻","健康新闻");
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
	
}
?>