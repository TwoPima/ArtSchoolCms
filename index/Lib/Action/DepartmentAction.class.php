<?php
/*
// read more 的整体操作方法
// +----------------------------------------------------------------------
*/
class DepartmentAction extends CommonAction {
	public function index(){
		$table=$_GET['mo'];
		$id=$_GET['id'];
		$model=M($table);
		$cate_name_model=M($table.'_'.'cate');
		//图片新闻
		$where3['cate_id']=$_GET['id'];
		$where3['is_img']="1";
		$detail_photo = $model->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//提出左侧导航列表
		$where_menu['pid']=$id;
		$where_menu['in_site']="0";
		$dep_cate_list = $cate_name_model->where($where_menu)->order('sort_order ASC')->select();
		$this->assign('dep_cate_list',$dep_cate_list);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		$this->assign('now_here',$getNowHere);
		//右侧标题栏的名称
		$dep_cate_con = $cate_name_model->where($where_menu)->order('sort_order ASC')->limit(1)->select();
		$this->assign('dep_cate_con',$dep_cate_con);
		//右侧第的列表信息
		$where_article_list['is_img'] = "0";
		$where_article_list['cate_id']=$dep_cate_con[0]['id'];
		$where_article_list['status']="1";
		$count =$model->where($where_article_list)->count();
		if ($count==1) {
			//显示具体文章资讯内容
			$this->indexDetail($dep_cate_con[0]['id']);
		}else {
			$page = new Page($count,15);
			$article_list=$model->where($where_article_list)->limit($page->firstRow.','.$page->listRows)->order('add_time ASC')->select();
			$showPage = $page->show();
			$this->assign("page", $showPage);
			$this->assign('article_list',$article_list);
			$this->display();
		}
		
	}
	/*  *
	 * //首页导航之后的详细页面
	*/
	public function indexDetail($id){
		$model=M('Article');
		$menu_mod = M('Article_cate');
		//详细页面
		$where3['is_img'] = "0";
		$where3['cate_id']=$id;
		$where3['status']="1";
		$result_se=$model->where($where3)->find();
		$this->assign('detail',$result_se);
		$this->display('indexDetail');
	}
		public function articleList(){
		$table=$_GET['mo'];
		$pid=$_GET['pid'];
		$id=$_GET['id'];
		$model=M($table);
		$cate_name_model=M($table.'_'.'cate');
		//图片新闻
		$where3['cate_id']=$_GET['pid'];
		$where3['is_img']="1";
		$detail_photo = $model->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//右侧名字找出来
		$where_name['id']=$id;
		$dep_cate_name = $cate_name_model->where($where_name)->select();
		$this->assign('dep_cate_name',$dep_cate_name);
		//提出左侧导航列表
		$where_menu['pid']=$pid;
		$where_menu['in_site']="0";
		$dep_cate_list = $cate_name_model->where($where_menu)->order('sort_order ASC')->select();
		$this->assign('dep_cate_list',$dep_cate_list);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		$this->assign('now_here',$getNowHere);
		//右侧第的列表信息
		$where_article_list['cate_id']=$id;
		$where_article_list['is_img'] = "0";
		$where_article_list['status']="1";
		$count =$model->where($where_article_list)->count();
		if ($count==1) {
		//显示具体文章资讯内容
		$this->indexDetail($id);
		}else {
			$page = new Page($count,15);
			$article_list=$model->where($where_article_list)->limit($page->firstRow.','.$page->listRows)->order('add_time ASC')->select();
			$showPage = $page->show();
			$this->assign("page", $showPage);
			$this->assign('article_list',$article_list);
			$this->display();
		}
}
		public function detail(){
		$table=$_GET['mo'];
		$id=$_GET['id'];
		$model=M($table);
		$where['id']=$id;
		$cate_name_model=M($table.'_'.'cate');
		$result_se=$model->where($where)->select();
		//图片新闻
		$where3['id']=$_GET['cate_id'];
		$detail_photo1 = $cate_name_model->where($where3)->limit(1)->select();
		$where3['is_img']="1";
		$where3['cate_id']=$detail_photo1[0]['pid'];
		$where4['cate_id']=$where3['cate_id'];
		$detail_photo = $model->where($where4)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//分类列表
		$menu_mod = M('Article_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		//左侧您现在的位置
		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
		$this->assign('now_here',$getNowHere);
		//正文部分
		$detail=$model->where($where)->select();
		$this->assign('detail',$detail);
		$this->display();
}

}
?>