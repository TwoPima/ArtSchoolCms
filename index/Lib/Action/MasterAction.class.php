<?php
/*
// 艺术硕士
// +----------------------------------------------------------------------
*/
class MasterAction extends CommonAction {
	
	public function _before_index(){
		$mod_cate_list=M('Master_cate');
		$re_cate_list=$mod_cate_list->order('sort_order ASC')->select();
		$master_cate_list = array();
		foreach ($re_cate_list as $val) {
			if ($val['pid']==0) {
				$master_cate_list['parent'][$val['id']] = $val;
			} else {
				$master_cate_list['sub'][$val['pid']][] = $val;
			}
		}
		$this->assign('cate_list',$master_cate_list);
		$this->display();
	}
}

?>