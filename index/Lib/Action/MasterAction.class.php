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
	public function _before_detail(){
		$mod_cate_list=M('Master_cate');
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
			$front="没有了！";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			$after="没有了！";
		}
		//分类列表
		$menu_mod = M('Master_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
	
		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
	
		$this->assign('now_here',$getNowHere);
		$this->assign('mainleft_cate_list',$result_cate);
		$this->assign('detail_cate',$detail_cate);
	
		$this->assign('front',$front);
		$this->assign('after',$after);
		$this->assign('detail',$result_se);
		$this->display();
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
			$this->assign('detail',$article_list);
			$this->assign("page", $showPage);
			$this->display('articleList');
		}
	}
}

?>