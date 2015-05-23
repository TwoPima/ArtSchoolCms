<?php
/*
//导航数据二次菜单显示
// +----------------------------------------------------------------------
*/
class SubmenuAction extends CommonAction {
	public function _before_index(){
		$menu_mod = M('Article_cate');
		$where['pid']=$_GET['id'];
		$where['status']="1";
		$result = $menu_mod->where($where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result);
	}
}

?>