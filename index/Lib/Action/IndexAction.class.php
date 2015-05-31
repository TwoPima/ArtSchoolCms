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
		$where_pro['pid']="0";
		$this->assign('Profession',M('ProfessionCate')->where($where_pro)->order('sort_order ASC')->limit(5)->select());
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
		$article_mod = M('Article');
		
		$data = $_POST['word'];
		import("ORG.Util.Page");
		$count = $article_mod->where("status=1 AND title LIKE '%$data%' OR info LIKE '%$data%' or seo_title like '%$data%' ")->count();
		$page = new Page($count,10);
		$article_list = $article_mod->where("status=1 AND title LIKE '%$data%' OR info LIKE '%$data%' or seo_title like '%$data%' ")->order('add_time DESC,ordid ASC')->select();
		$showPage = $page->show();
		$this->assign('list',$article_list);
		$this->assign("page", $showPage);
		//左侧您现在的位置
		$getNowHere=$this->getNowHere($_GET['id']);
		$this->assign('now_here',$getNowHere);
		
		$this->display();
		
		
		/* 下面的是给字体加红 但是没有实现 */
		/* foreach($article_list as $val){
		 $val['title']=str_replace($data,"<font color=red><b>$data</b></font>",$val['title']);
		$val['info']=str_replace($data,"<font color=red><b>$data</b></font>",$val['info']);
		}
		dump($article_list); */
		}

		
	
}