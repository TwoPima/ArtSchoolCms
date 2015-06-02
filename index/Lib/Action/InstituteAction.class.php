<?php
/*
// 艺术硕士
// +----------------------------------------------------------------------
*/
class InstituteAction extends CommonAction {
	public function index(){
		//加载头部导航信息
		$mod_cate_list=M('Institute_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
	
	
		//确定进入后是第一个页面的内容
		/*
		 * 进入后判断是否只有一条数据
		* 如果是一条数据详细展示；
		* 并且只提取
		*  艺术硕士、研究所、文化艺术团、精品课程；
		*/
		/* $catid=$_GET['id'];
			$getmodel="Master";
		$get_mod_cate=$getmodel.'_'.'cate';
		$cate=M($get_mod_cate);
		$model=M($getmodel); */
		$catid=$_GET['id'];
		$model=M('Institute');
		if (empty($catid)) {
			$whereId=$mod_cate_list->where('pid=0')->field("id")->order('sort_order ASC')->find();
			$count =$model->where('cate_id='.$whereId['id'])->count();
			$article_list=$model->where('cate_id='.$whereId['id'])->order('ordid ASC')->select();
		}else {
			$whereArt['cate_id']=$catid;
			$count =$model->where($whereArt)->count();
			$article_list=$model->where($whereArt)->order('ordid ASC')->select();
		}
		$page = new Page($count,10);
		$showPage = $page->show();
	
		//分类名称详细显示一个
		$detail_cate=$this->detailCatesingle($_GET['id'],Institute);
	
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],Institute);
	
		$this->assign('now_here',$getNowHere);
		$this->assign('article_list',$article_list);
		$this->assign('detail_cate',$detail_cate);
		$this->assign("page", $showPage);
		$this->assign('left_cate_list',$re_cate_list);
		$this->display();
	}
	public function detail(){
		$mod_cate_list=M('Institute_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
		$table=$_GET['mo'];
		$model=M($table);
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="3123123123123";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			$after="132123123";
		}
		//分类列表
		$menu_mod = M('Institute_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		//附件下载
		$attatch_mod = D('attatch');
		$whereAtta['type']="3";
		$whereAtta['aid']=$_GET['id'];
		$attatch= $attatch_mod->where($whereAtta)->find();
		$this->assign('attatch',$attatch);
	
		$this->assign('mainleft_cate_list',$result_cate);
	
		$this->assign('front',$front);//上一条
		$this->assign('after',$after);//下一条
		$this->assign('detail',$result_se);
		$this->display();
	}
}

?>