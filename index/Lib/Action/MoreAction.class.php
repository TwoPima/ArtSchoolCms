<?php
/*
// read more 的整体操作方法
// +----------------------------------------------------------------------
*/
class MoreAction extends CommonAction {
	
	public function _before_index(){
		$condition['cid']=$_GET['id'];
		$name=$_GET['name'];
		$m=M($_GET['name']);
		$this->assign("list", M($name)->listNews($name,$page->firstRow, $page->listRows,$condition));
		
	}
}

?>