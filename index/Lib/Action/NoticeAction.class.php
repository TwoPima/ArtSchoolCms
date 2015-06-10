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
		$page = new Page($count,15);
		$article_list = $m->where($condition)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC')->select();
		$showPage = $page->show();
		
		
		$this->assign('notice_list',$article_list);
		$this->assign('bigmenu',$str);
		$this->assign("page", $showPage);
		$this->display();
		
	}
	public function detail(){
		$model=M('Notice');
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->find();
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->find();
		if ($_GET['type']=="0") {
			$str="重要通知";
			$str1="0";
		}else {
			$str="学院新闻";
			$str1="1";
		}
		//分类列表
		$menu_mod = M('Master_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
	
	
		$this->assign('mainleft_cate_list',$result_cate);
	
		$this->assign('front',$front);//上一条
		$this->assign('after',$after);//下一条
		$this->assign('detail',$result_se);
		$this->assign('bigmenu',$str);
		$this->display();
	}
	
}

?>