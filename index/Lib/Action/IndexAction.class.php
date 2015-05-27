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
		$this->assign('Profession',M('Profession')->order('sort_order ASC')->limit(5)->select());
		//办公机构
		$this->assign('Department',M('Department')->order('sort_order ASC')->limit(5)->select());
		
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
	/* 	$data = $_POST['words'];
		$r = D('Article')->where("status=1 AND title LIKE '%$data%' OR content LIKE '%$data%'")->select();
		foreach($r as $val){
			$val['title']=str_replace($data,"<font color=red><b>$data</b></font>",$val['title']);
			$val['content']=str_replace($data,"<font color=red><b>$data</b></font>",$val['content']);
			$list[]=$this->changurl($val);
		}
		$this->assign('list',$list);
		$this->seo('搜索'.$data.'结果', C('SITE_KEYWORDS'), C('SITE_DESCRIPTION'), 0);
		 */
		$article_mod = D('article');
		$article_cate_mod = D('article_cate');
		
		//搜索
		$where = '1=1';
		if (isset($_GET['keyword']) && trim($_GET['keyword'])) {
			$where .= " AND title LIKE '%".$_GET['keyword']."%'";
			$this->assign('keyword', $_GET['keyword']);
		}
		if (isset($_GET['time_start']) && trim($_GET['time_start'])) {
			$time_start = $_GET['time_start'];
			$where .= " AND add_time>='".$time_start."'";
			$this->assign('time_start', $_GET['time_start']);
		}
		if (isset($_GET['time_end']) && trim($_GET['time_end'])) {
			$time_end = $_GET['time_end'];
			$where .= " AND add_time<='".$time_end."'";
			$this->assign('time_end', $_GET['time_end']);
		}
		if (isset($_GET['cate_id']) && intval($_GET['cate_id'])) {
			$where .= " AND cate_id=".$_GET['cate_id'];
			$this->assign('cate_id', $_GET['cate_id']);
		}
		import("ORG.Util.Page");
		$count = $article_mod->where($where)->count();
		$p = new Page($count,20);
		$article_list = $article_mod->where($where)->limit($p->firstRow.','.$p->listRows)->order('add_time DESC,ordid ASC')->select();
		
		$key = 1;
		foreach($article_list as $k=>$val){
			$article_list[$k]['key'] = ++$p->firstRow;
			$article_list[$k]['cate_name'] = $article_cate_mod->field('name')->where('id='.$val['cate_id'])->find();
		}
		$result = $article_cate_mod->order('sort_order ASC')->select();
		$cate_list = array();
		foreach ($result as $val) {
			if ($val['pid']==0) {
				$cate_list['parent'][$val['id']] = $val;
			} else {
				$cate_list['sub'][$val['pid']][] = $val;
			}
		
			}
			$this->display();
		}

		
	
}