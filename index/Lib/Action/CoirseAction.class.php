<?php
/*
// 精品课程
// +----------------------------------------------------------------------
*/
class CoirseAction extends CommonAction {
	
public function index(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$where_index['is_index']=1;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order ASC')->select();
		//视频课件提取
		$whereArt['type']="1";
		$count =$model->where($whereArt)->count();
		$video_list=$model->where($whereArt)->order('ordid ASC')->select();
		$page = new Page($count,9);
		$showPage = $page->show();
		
		//专业提取
		$prolist=M('Profession_cate')->where('status=1 AND pid=0')->order('sort_order ASC')->select();
		$this->assign('video_list',$video_list);
		$this->assign("page", $showPage);
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('pro_list',$prolist);
		$this->display();
	}
	
	public function detail(){
		$mod_cate_list=M('Coirse_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('cate_list',$re_cate_list);
		$table=$_GET['mo'];
		$model=M($table);
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="3123123123123";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			$after="132123123";
		}
		//分类列表
		$menu_mod = M('Coirse_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		//附件下载
		$attatch_mod = D('attatch');
		$whereAtta['type']="0";
		$whereAtta['aid']=$_GET['id'];
		$attatch= $attatch_mod->where($whereAtta)->find();
		$this->assign('attatch',$attatch);
	
		$this->assign('mainleft_cate_list',$result_cate);
	
		$this->assign('front',$front);//上一条
		$this->assign('after',$after);//下一条
		$this->assign('detail',$result_se);
		$this->display();
	}
	public function articleList(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$where_index['is_index']=1;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order ASC')->select();
		//左边分类提取
		$wherPro['pid']=$_GET['id'];
		$prolist=$mod_cate_list->where($wherPro)->order('sort_order ASC')->select();
		
		//提取信息
		$where['id']=$_GET['id'];
		$where['status']="1";
		$article_list=$model->where($where)->order('ordid ASC')->select();
		$count =$model->where($where)->count();
		$page = new Page($count,10);
		$showPage = $page->show();
		
		$this->assign('page', $showPage);
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('pro_list',$prolist);
		$this->assign('article_list',$article_list);
		$this->display();
	}
	public function proArticleList(){
		$mod_cate_list=M('Coirse_cate');
		$model=M('Coirse');
		//加载头部导航信息
		$where_index['pid']=0;
		$where_index['is_index']=1;
		$re_cate_list=$mod_cate_list->where($where_index)->order('sort_order ASC')->select();
		//专业提取
		$wherPro['id']=$_GET['id'];
		$pro_mod=M('Profession_cate');
		$prolist=$pro_mod->where($wherPro)->order('sort_order ASC')->find();
	
	
		//根据专提取信息
		$where['pro_id']=$_GET['id'];
		$where['status']="1";
		$article_list=$model->where($where)->order('ordid ASC')->select();
		$count =$model->where($where)->count();
		$page = new Page($count,10);
		$showPage = $page->show();
	
		$this->assign("page", $showPage);
		$this->assign('top_cate_list',$re_cate_list);
		$this->assign('pro_list',$prolist);
		$this->assign('article_list',$article_list);
		$this->display();
	}
}

?>