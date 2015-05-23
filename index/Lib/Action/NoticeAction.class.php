<?php
/*
// 院长致辞
// +----------------------------------------------------------------------
*/
class NoticeAction extends CommonAction {
	public function more(){
		if ($_GET['type']=="0") {
			$str="重要通知";
		}else {
			$str="学院新闻";
		}
		$condition['type']=$_GET['type'];
		$condition['is_show']="1";
		$m=M($_GET['mo']);
		$count = $m->where($condition)->count();
		$page = new Page($count,20);
		$article_list = $m->where($condition)->limit($page->firstRow.','.$page->listRows)->order('uploadtime DESC')->select();
		$showPage = $page->show();
		
		
		$this->assign('list',$article_list);
		$this->assign('bigmenu',$str);
		$this->assign("page", $showPage);
		$this->display();
		
	}
	
}

?>