<?php
/*前台动作基类*/
class CommonAction extends Action {
	//初始化
	function _initialize(){
		Load('extend');
		import("ORG.Util.Page"); //载入分页类
		$this->site_root="http://".$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']==80?'':':'.$_SERVER['SERVER_PORT']).__ROOT__."/";
		
		//导航数据组装
		$article_cate_mod = M('Article_cate');
		$where_menu['is_nav']="0";
		$result = $article_cate_mod->where($where_menu)->order('sort_order ASC')->select();
		$article_cate_list = array();
		foreach ($result as $val) {
			if ($val['pid']==0) {
				$article_cate_list['parent'][$val['id']] = $val;
			} else {
				$article_cate_list['sub'][$val['pid']][] = $val;
			}
		}
		$this->assign('article_cate_list',$article_cate_list);
		
		//获取网站配置信息
		$setting_mod = M('Setting');
		$setting = $setting_mod->select();
		foreach ( $setting as $val ) {
			$set[$val['name']] = stripslashes($val['data']);
		}
		$this->assign('set',$set);
	
		//友情链接
		$this->assign('link',M('Flink')->where('status=1')->order('ordid DESC')->select());
	
	}
	//导航index操作；
	//统一分配变量
	//首页更多操作;根据传过来的表名取数据
	public function index(){
		//封装一个留学生index方法
		//1.哪个表；2.表里提取哪种类型数据，3.不操作数据表；
		/* $name=$this->getActionName();
		 $M = M($name);
		$this->assign("list", D($name)->listNews($page->firstRow, $page->listRows));
		$list=M($name)->select();
		$this->assign('list',$list); */
		$this->display();
	}
	/* public function listNews($firstRow = 0, $listRows = 20,$where) {
		$name=$this->getModelName();
		$M = M($name);
		$list = $M->where($where)->limit("$firstRow , $listRows")->select();
		return $list;
	} */
	//详细操作；根据传过来的表名和类型取数据
	public function detail(){		
		$table=$_GET['m'];
		$model=M($table);
		//$str=$model->getPk ();
		//$where[$str]=(int) $_GET['id'];
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
		$result=array();
		foreach ($result_se as $value){
			$result[]=$value;
		}
		//上一篇  
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="没有了！";
		}
		//下一篇  
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();  
		if (empty($after)) {
			$after="没有了！";
		}
		$this->assign('front',$front);
		$this->assign('after',$after); 
		$this->assign('detail',$result);
		$this->display();
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
	
	//搜索部分
	public function search(){
		//搜索会员信息
		$action_name=$this->getActionName();
		$model=D('Member_detail');
		$data = $model->create();
		$condition = array();
		$this->assign("list", $model->listNews('Member_detail',$page->firstRow, $page->listRows,$condition));
		$this->display($action_name);
	}
	

   
    //文件下载
    public function download(){
    	$site=$_GET['site'];
		$filename = $_SERVER[DOCUMENT_ROOT].__ROOT__.'/data/'.$site.'/'.$_GET['filename'];
		header("Content-type: application/octet-stream");  
		header("Content-Length: ".filesize($filename));  
		header("Content-Disposition: attachment; filename={$_GET['filename']}");	
		$fp = fopen($filename, 'rb');  
		fpassthru($fp);  
		fclose($fp); 
    }
  
    //空操作
/* 	public function _empty(){
		$this->redirect("/");
	} */
	//更多操作;根据传过来的表名取数据；导航栏有数据库的直接连接到导航栏方法；
	public function listMore(){
		$name=$this->getActionName();
		$M = M($name);
		$this->assign("list", D($name)->listNews($page->firstRow, $page->listRows));
		$list=M($name)->select();
		$this->assign('list',$list);
		$this->display();
	}
	/* +++++++++++++++字符串处理++++
	 * 
	 * eg: chgtitles($classList[$i]['name'],1);
	 * +++++++++++ */
	function chgtitle($title,$length){
		$encoding='utf-8';
		if(mb_strlen($title,$encoding)>$length){
			$title=mb_substr($title,0,$length,$encoding).'...';
		}
		return $title;
	}
	function chgtitles($title,$length){
		$encoding='utf-8';
		if(mb_strlen($title,$encoding)>$length){
			$title=mb_substr($title,0,$length,$encoding);
		}
		return $title;
	}
	/*  
	 * 获取菜单的当前位置
	 * 当前位置-第一个参数 catid为当前栏目的id
	 *
	 */
	Public function getNowHere($catid){
		$cat = M("Article_cate");
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;&nbsp;首页&nbsp;&nbsp;</a>';
		$uplevels = $cat->field("id,name")->where("id=$catid")->find();
		$nowHere="$herestr"."->".$uplevels['name'];
		return $nowHere;
	}
	
	/*+++++++++
	 * 获得艺术硕士、研究所、文化艺术团、精品课程的当前位置；
	*
	* ++++  */
	Public function secGetNowHere($catid,$model){
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;&nbsp;首页&nbsp;&nbsp;</a>';
		$get_mod_cate=$model.'_'.'cate';
		$cate=M($get_mod_cate);
		if (empty($catid)) {
			$uplevels=$cate->where('pid=0')->field("id,name")->order('sort_order ASC')->limit(1)->find();
		}else {
			$uplevels = $cate->field("id,name")->where("id=$catid")->find();
		}
		$nowHere="$herestr"."->".$uplevels['name'];
		return $nowHere;
	}
/*
 * 单一分类名称详细展示；
 *  艺术硕士、研究所、文化艺术团、精品课程；
 */
	public  function detailCatesingle($catid,$model){
		$get_mod_cate=$model.'_'.'cate';
		$cate=M($get_mod_cate);
		if (empty($catid)) {
			$result=$cate->where('pid=0')->field("id,name")->order('sort_order ASC')->limit(1)->find();
		}else {
			$where['id']=$catid;
			$result = $cate->where($where)->field("id,name")->find();
		}
		$detail_catname=$result['name'];
		return $detail_catname;
	}
	
	
	
	
}