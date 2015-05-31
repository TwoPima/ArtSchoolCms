<?php
class IndexAction extends CommonAction{
    //首页
	public function _before_index(){
		//---------------------重要通知
		$this->assign('Notice',M('Notice')->where('type=0 AND is_show=1')->order('uploadtime DESC')->limit(11)->select());
		//---------------------学院新闻
		$this->assign('CollegeNotice',M('Notice')->where('type=1 AND is_show=1')->order('uploadtime DESC')->limit(10)->select());
		//---------------------幻灯片轮播数据添加
		$this->assign('Ad',M('Ad')->where("type='image' AND status=1")->order('ordid ASC')->limit(5)->select());
		$this->assign('Adasc',M('Ad')->where("type='image' AND status=1")->order('ordid ASC')->limit(1)->select());
		$this->assign('Addesc',M('Ad')->where("type='image' AND status=1")->order('ordid DESC')->limit(1)->select());
		//学科管理部
		$this->assign('Profession',M('ProfessionCate')->order('sort_order ASC')->limit(5)->select());
		//办公机构
		$dep_mod = M('Article_cate');
		$where_dep['is_dep']="1";
		$where_dep['pid']="0";
		$result_dep = $dep_mod->where($where_dep)->order('sort_order ASC')->limit(5)->select();
		$this->assign('Department',$result_dep);
		
		$Master=M('Nav')->where("type=0")->select();
		$this->assign('Master',$Master);//提取logo艺术硕士
	/* 	dump($Master);
		exit(); */
		$coirse=M('Nav')->where("type=1")->select();
		$this->assign('coirse',$coirse);//提取logo精品课程
		
		$Institute=M('Nav')->where("type=2")->select();
		$this->assign('Institute',$Institute);//提取logo研究院
		
		$military=M('Nav')->where("type=3")->select();
		$this->assign('military',$military);//提取logo军工技术团
	
		
    }
	//站内搜索
	public function search(){
		$article_mod = D('article');
		$data = $_POST['words'];
		import("ORG.Util.Page");
		$count = $article_mod->where("status=1 AND title LIKE '%$data%' OR content LIKE '%$data%' or seo_title like '%$data%' ")->count();
		$page = new Page($count,10);
		$article_list = $article_mod->where("status=1 AND title LIKE '%$data%' OR content LIKE '%$data%' or seo_title like '%$data%' ")->limit($p->firstRow.','.$p->listRows)->order('add_time DESC,ordid ASC')->select();
		$showPage = $page->show();
		foreach($article_list as $val){
			$val['title']=str_replace($data,"<font color=red><b>$data</b></font>",$val['title']);
			$val['content']=str_replace($data,"<font color=red><b>$data</b></font>",$val['content']);
		}
		$this->assign('list',$val);
		$this->assign("page", $showPage);
		$this->display();
		}

		
	
}