<?php
/*
//导航数据二次菜单显示
// +----------------------------------------------------------------------
*/
class SubmenuAction extends CommonAction {
	public function _before_index(){
		//分类列表
		$menu_mod = M('Article_cate');
		$where['pid']=$_GET['pid'];
		$where['status']="1";
		$result_cate = $menu_mod->where($where)->order('sort_order ASC')->select();
		//资讯列表
	 	$detail_mod=M('Article');
		$where1['cate_id']=$_GET['id'];
		$where1['status']="1";
		$count = $detail_mod->where($where1)->count();
		$page = new Page($count,20);
		$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
		$showPage = $page->show(); 
	 	//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
		$result_cate_detail=array();
		foreach($detail_cate as $value){
			$result_cate_detail[]=$value;
		} 
		$this->assign('mainleft_cate_list',$result_cate);
		$this->assign('article_list',$article_list);
		$this->assign('detail_cate',$result_cate_detail);
		$this->assign("page", $showPage);
	}
}

?>