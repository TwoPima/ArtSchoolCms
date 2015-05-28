<?php
/*
// 精品课程
// +----------------------------------------------------------------------
*/
class CoirseAction extends CommonAction {
	public function index(){
		//加载头部导航信息
		$mod_cate_list=M('Coirse_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
		//资讯列表
		$detail_mod=M('Coirse');
		$where1['status']="1";
		$where1['is_hot']="1";
		$where1['is_best']="1";
		$count = $detail_mod->where($where1)->count();
		$page = new Page($count,10);
		$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
		$showPage = $page->show();
		$this->assign('Coirse_article_list',$article_list);
		$this->assign("page", $showPage);
		$this->display();
	}
	
	public function _before_detail(){
		$mod_cate_list=M('Coirse_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
	}
	public function detail(){
		$table=$_GET['mo'];
		$model=M($table);
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="没有了";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			//$after= iconv('UTF-8', 'gb2312//IGNORE', '没有了');
			$after=auto_charset('没有了','utf-8','gb2312');
		}
	
		//分类列表
		$menu_mod = M('Coirse_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
	
	
		$this->assign('mainleft_cate_list',$result_cate);
	
		$this->assign('front',$front);//上一条
		$this->assign('after',$after);//下一条
		$this->assign('detail',$result_se);
		$this->display();
	}
	
	
	public function articleList(){
		$mod_cate_list=M('Coirse_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
		//资讯列表
		$detail_mod=M('Coirse');
		$where1['cate_id']=$_GET['id'];
		$where1['status']="1";
		$count = $detail_mod->where($where1)->count();
		
		if ($count=="1") {
			$article_list = $detail_mod->where($where1)->select();
			$this->assign('detail',$article_list);
			$this->display('detail');
		}else {
			$page = new Page($count,10);
			$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
			$showPage = $page->show();
			$this->assign('detail',$article_list);
			$this->assign("page", $showPage);
			$this->display('articleList');
		}
	}
}

?>