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
		//提出左侧导航列表
		$where_menu['pid']="$id";
		$dep_cate_list = $cate_name_model->where($where_menu)->order('sort_order ASC')->select();
		$this->assign('dep_cate_list',$dep_cate_list);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		$this->assign('now_here',$getNowHere);
		//右侧提出第一条数据的正文
		$dep_cate_con = $cate_name_model->where($where_menu)->order('sort_order ASC')->limit(1)->select();
		$name_id= $dep_cate_con[0][id];
		$this->assign('dep_cate_con',$dep_cate_con);
		//右侧第的列表信息
		$where_article_list['cate_id']="$name_id";
		$article_list=$model->where($where_article_list)->order('add_time ASC')->select();
		$this->assign('article_list',$article_list);
		$this->display();
		/* 
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="没有了！";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			$after="没有了！";
		}
		$this->assign('front',$front);
		$this->assign('after',$after); */
	}
		public function articleList(){
		$table=$_GET['mo'];
		$pid=$_GET['pid'];
		$id=$_GET['id'];
		$model=M($table);
		$cate_name_model=M($table.'_'.'cate');
		//右侧名字找出来
		$where_name['id']="$id";
		$dep_cate_name = $cate_name_model->where($where_name)->select();
		$this->assign('dep_cate_name',$dep_cate_name);
		//提出左侧导航列表
		$where_menu['pid']="$pid";
		$dep_cate_list = $cate_name_model->where($where_menu)->order('sort_order ASC')->select();
		$this->assign('dep_cate_list',$dep_cate_list);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		$this->assign('now_here',$getNowHere);
		//右侧第的列表信息
		$where_article_list['cate_id']="$id";
		$article_list=$model->where($where_article_list)->order('add_time ASC')->select();
		$this->assign('article_list',$article_list);
		$this->display();
}
		public function detail(){
		$table=$_GET['mo'];
		$id=$_GET['id'];
		$model=M($table);
		$where['id']="$id";
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		$this->assign('now_here',$getNowHere);
		//正文部分
		$detail=$model->where($where)->select();
		$this->assign('detail',$detail);
		$this->display();
		}
}
?>