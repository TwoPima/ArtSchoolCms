<?php
/*
// 院长致辞
// +----------------------------------------------------------------------
*/
class NoticeAction extends CommonAction {
	public function more(){
		if ($_GET['type']=="0") {
			$str="重要通知";
			$str1="0";
		}else {
			$str="学院新闻";
			$str1="1";
		}
		$condition['type']=$str1;
		$condition['is_show']="1";
		$m=M('Notice');
		$count = $m->where($condition)->count();
		$page = new Page($count,5);
		$article_list = $m->where($condition)->limit($page->firstRow.','.$page->listRows)->order('uploadtime DESC')->select();
		$showPage = $page->show();
		
		
		$this->assign('notice_list',$article_list);
		$this->assign('bigmenu',$str);
		$this->assign("page", $showPage);
		$this->display();
		
	}
	
	
}

?>