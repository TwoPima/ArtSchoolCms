<?php
/*
// 精品课程
// +----------------------------------------------------------------------
*/
class CoirseAction extends CommonAction {
	
public function index(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order DESC')->limit(7)->select();
		$re_cate_list1=$mod_cate_list->where($where_index)->order('sort_order ASC')->limit(1)->find();
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('top_cate_list1',$re_cate_list1);
		//视频课件提取
		$whereArt['type']="1";
		$count =$model->where($whereArt)->count();
		$video_list=$model->where($whereArt)->order('ordid ASC')->select();
		$page = new Page($count,9);
		$showPage = $page->show();
		$this->assign("page", $showPage);
		$this->assign('video_list',$video_list);
		//专业提取
		$prolist=M('Profession_cate')->where('status=1 AND pid=0')->order('sort_order ASC')->select();
		$this->assign('pro_list',$prolist);
		
		$this->display();
	}
	/*  *
	 * 任何文章的详细操作
	* 
	*/
	public function detail(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order DESC')->limit(7)->select();
		$re_cate_list1=$mod_cate_list->where($where_index)->order('sort_order ASC')->limit(1)->find();
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('top_cate_list1',$re_cate_list1);
	
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		$this->assign('detail',$result_se);
		//分类列表
		$menu_mod = M('Coirse_cate');
		$cate_where['pid']=$_GET['id'];
		$cate_where['status']="1";
		//$cate_where['in_site']="0";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		
		//左侧您现在的位置
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;首页&nbsp;</a>'.'->&nbsp;'.'<a href="__URL__/index">精品课程</a>&nbsp;&nbsp;';
		$this->assign('now_here',$herestr);
	
		$this->display();
	}
	/*  *
	 * 根据头部导航下的菜单提取相关文档信息；
	* 
	*/
	public function articleList(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order DESC')->limit(7)->select();
		$re_cate_list1=$mod_cate_list->where($where_index)->order('sort_order ASC')->limit(1)->find();
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('top_cate_list1',$re_cate_list1);
		//左侧分类显示菜单
		$cate_where['pid']=$_GET['id'];
		$cate_where['status']="1";
		//$cate_where['in_site']="0";
		$result_cate = $mod_cate_list->where($cate_where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		//左侧您现在的位置
		$herestr= '位置:'.'<a style="color:#000;" href="__APP__">&nbsp;首页&nbsp;</a>'.'->&nbsp;'.'<a href="__URL__/index">精品课程</a>&nbsp;&nbsp;';
		$nowwhere['id']=$_GET['id'];
		$uplevels = $mod_cate_list->field("id,name")->where($nowwhere)->find();
		$nowHere="$herestr"."->&nbsp;&nbsp;".$uplevels['name'];
		$this->assign('now_here',$nowHere);
		//提取信息
		$where['id']=$_GET['id'];
		$where['status']="1";
		$article_list=$model->where($where)->order('ordid ASC')->select();
		$count =$model->where($where)->count();
		$page = new Page($count,10);
		$showPage = $page->show();
		
		$this->assign('page', $showPage);
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('pro_list',$prolist);
		$this->assign('article_list',$article_list);
		$this->display();
	}
	/*  *
	 * 根据专业提取相关文档信息；
	 * 包括视频和文档
	 */
	public function proArticleList(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order DESC')->limit(7)->select();
		$re_cate_list1=$mod_cate_list->where($where_index)->order('sort_order ASC')->limit(1)->find();
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('top_cate_list1',$re_cate_list1);
		
/* 		//专业提取
		$wherPro['id']=$_GET['id'];
		$pro_mod=M('Profession_cate');
		$prolist=$pro_mod->where($wherPro)->order('sort_order ASC')->find();
		$this->assign('prolist',$prolist); */
		//专业提取
		$pro_mod=M('Profession_cate');
		$prolist=$pro_mod->where('status=1 AND pid=0')->order('sort_order ASC')->select();
		$this->assign('pro_list',$prolist);
		//左侧您现在的位置
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;首页&nbsp;</a>'.'->&nbsp;'.'<a href="__URL__/index">精品课程</a>&nbsp;&nbsp;';
		$nowwhere['id']=$_GET['id'];
		$uplevels = $pro_mod->field("id,name")->where($nowwhere)->find();
		$nowHere="$herestr"."->&nbsp;&nbsp;".$uplevels['name'];
		$this->assign('now_here',$nowHere);
		//左侧详细标题
		$where_left['id']=$_GET['id'];
		$left_detail_name = $pro_mod->field("id,name")->where($where_left)->find();
		$this->assign('left_detail_name',$left_detail_name);
		//根据专提取信息
		$where['pro_id']=$_GET['id'];
		$where['status']="1";
		$where['type']=$_GET['type'];
		$count =$model->where($where)->count();
		$article_video_list=$model->where($where)->order('ordid ASC')->select();
		$page = new Page($count,10);
		$showPage = $page->show();
		$this->assign("page", $showPage);
		$this->assign('article_video_list',$article_video_list);
		if ($_GET['type']=="1"){
			$this->display('proVideoList');
		}else {
			$this->display();
			
		}
	}
}

?>