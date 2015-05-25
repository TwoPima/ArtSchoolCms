<?php
/*
// 艺术硕士
// +----------------------------------------------------------------------
*/
class MasterAction extends CommonAction {
	
	public function _before_index(){
		$mod_cate_list=M('Master_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		//资讯列表
		$detail_mod=M('Master');
		$where1['status']="1";
		$where1['is_hot']="1";
		$where1['is_best']="1";
		$count = $detail_mod->where($where1)->count();
		$page = new Page($count,10);
		$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
		$showPage = $page->show();
		$this->assign('master_article_list',$article_list);
		$this->assign("page", $showPage);
		$this->assign('cate_list',$re_cate_list);
	}
	
	
	public function _before_articleList(){
		$mod_cate_list=M('Master_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
	}
	public function articleList(){
		//资讯列表
		$detail_mod=M('Master');
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
			$this->assign('article_list',$article_list);
			$this->assign("page", $showPage);
		}
	}
}

?>