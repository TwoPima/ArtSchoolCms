<?php
/*
// 艺术硕士
 * 排序找出第一个基本概况的信息；
// +----------------------------------------------------------------------
*/
class MasterAction extends CommonAction {
		public function index(){
		//加载头部导航信息
		$mod_cate_list=M('Master_cate');
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		
		
		//确定进入后是第一个页面的内容
		$detail_mod=M('Master');
		$article_list=$detail_mod->order('ordid ASC')->select();
		$count =$detail_mod->order('ordid ASC')->count();
		$page = new Page($count,10);
		$showPage = $page->show();
		
		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $mod_cate_list->where($where2)->select();
		
		//左侧您现在的位置
		$getNowHere=$this->getNowHere($_GET['id']);
		
		$this->assign('now_here',$getNowHere);
		$this->assign('article_list',$article_list);
		$this->assign('detail_cate',$detail_cate);
		$this->assign("page", $showPage);
		$this->assign('left_cate_list',$re_cate_list);
		$this->display();
	}
	
	public function detail(){
		$mod_cate_list=M('Master_cate');
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
		$menu_mod = M('Master_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
	
	
		$this->assign('mainleft_cate_list',$result_cate);
	
		$this->assign('front',$front);//上一条
		$this->assign('after',$after);//下一条
		$this->assign('detail',$result_se);
		$this->display();
	}
	/*+++++++左边菜单点击显示页面+++++++  */
	public function articleList(){
		$get_mod=$_GET['mo'];
		$get_mod_cate=$get_mod.'_'.'cate';
		$mod_cate_list=M($get_mod_cate);
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
		$this->assign('left_cate_list',$re_cate_list);
		//资讯列表
		$detail_mod=M($get_mod);
		$where1['cate_id']=$_GET['id'];
		$where1['status']="1";
		$count = $detail_mod->where($where1)->count();
		if ($count=="1") {
			$article_list = $detail_mod->where($where1)->select();
			$this->assign('detail',$article_list);
			$this->display('detail');
		}else {
			$page = new Page($count,10);
			$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
			$showPage = $page->show();
			$this->assign('article_list',$article_list);
			$this->assign("page", $showPage);
			$this->display();
		}
	}
	/*+++++获得默认页面的数据+++++  */
	public function firstdetail($id,$model){
		$mod_cate_list=M($model);
		$re_cate_list=$mod_cate_list->where('pid=0')->order('sort_order ASC')->select();
	}

	//根据分类名获取分类id
	public function getclass($class_name,$action_name){
		$m=M($action_name.'_class');
		$str=$m->getPk ();
		$where['type_name']=$class_name;
		$result=$m->where($where)->select();
		$cid=$result[0][$str];
		return $cid;
	}
	Public function getNowHere($catid){
		$cat = M("Article_cate");
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;&nbsp;首页&nbsp;&nbsp;</a>';
		$uplevels = $cat->field("id,name")->where("id=$catid")->find();
		$nowHere="$herestr"."->".$uplevels['name'];
		return $nowHere;
	}
}

?>