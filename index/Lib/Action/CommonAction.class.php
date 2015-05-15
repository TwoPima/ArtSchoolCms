<?php
/*前台动作基类*/
class CommonAction extends Action {
	//初始化
	function _initialize(){
		//友情链接全部取出
		//文章取出5条
		//同校活动取出5条
		Load('extend');
		import("ORG.Util.Page");       //载入分页类
		$this->assign('menu',M('menu')->where('parentid=0 AND type=1')->order('sort')->limit(8)->select());//导航数据组装
		//seo
		$systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
		F("systemConfig", $systemConfig, WEB_ROOT . "Common/");
		$this->assign("site", $systemConfig);
		//爱情攻略
		$footwhere['sys_type']="2";
		$findMenu=M('Article')->where($footwhere)->order('sort')->limit(4)->select();
		$this->assign('footMenu',$findMenu);
		$this->assign('wishing',M('Wish')->where('status=1')->order('create_time DESC')->limit(2)->select());//许愿框
		//个人心情语录展示
		$this->assign('mood',M('Mood')->where('status=1')->order('create_time DESC')->limit(3)->select());
		//标签展示（置顶的永远显示）
		$this->assign('label',M('Label')->where('status=1')->order('sort DESC')->limit(8)->select());
		//友情链接
		$this->assign('link',M('Link')->where('status=1')->order('sort DESC')->select());
		//首页活动
		$Activity=M('Activity');
		/* $ip=get_client_ip();
		 $country=$this->getCity($ip);
		where('class=1 AND isLock=1') */
		$this->assign('Activity1',$Activity->where('isLock=1')->limit(5)->order('activity_id desc')->select());
		$this->assign('Activity2',$Activity->where('isLock=1')->limit(5)->order('activity_id desc')->select());
		/* 
		//最新留言
		$new_leave = D('Message')->where('status=1 AND pid=0 AND aid=0')->order('add_time DESC')->limit(5)->select();
		foreach ($new_leave as $key => $val){
			$new_leave[$key] = $this->msgmodify($val);
		}
		$this->assign('new_leave',$new_leave);
		//最新评论
		$new_comment = D('Message')->where('status=1 AND pid=0 AND aid!=0')->order('add_time DESC')->limit(5)->select();
		foreach ($new_comment as $key => $val){
			$new_comment[$key] = $this->msgmodify($val);
		} */
		 //首页心情语录和爱情攻略
		/* $mood=M('Article');
		$cid=$this->getclass('心情语录','Article');
		$where['cid']=$cid;
		$this->assign('mood',$mood->where($where)->limit(5)->order('article_id desc')->select());
		$cid1=$this->getclass('爱情攻略','Article');
		$where1['cid']=$cid1;
		$this->assign('loveStrategy',$mood->where($where1)->limit(5)->order('article_id desc')->select());
		$this->assign('new_comment',$new_comment);
		$this->assign('nav_list',$nav_list);  */
		/*
		 * 用封装之后的调用方式 $id = $this->router();
		$type = D('Category')->where('status=1')->find($id);
		$map = D('Common')->getCategoryMap($id);*/
		
	}
	/* public function listNews($firstRow = 0, $listRows = 20,$where) {
		$name=$this->getModelName();
		$M = M($name);
		$list = $M->where($where)->limit("$firstRow , $listRows")->select();
		return $list;
	} */
	//详细会员操作；根据传过来的表名和类型取数据
	public function detail(){
		$table=$_GET['table'];
		$model=M($table);
		$str=$model->getPk ();
		$where[$str]=(int) $_GET['id'];
		$result=$model->where($where)->select();
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
	public function getCity($ip){
		//ip地址转换
		import('ORG.Net.IpLocation');// 导入IpLocation类
		$Ip = new IpLocation(); // 实例化类 参数表示IP地址库文件
		$result = $Ip->getlocation($ip); // 获取域名服务器所在的位置
		$country=$result[0]['country'];
		return $country;
		/*dump($area); 输出array(5) {
		["ip"] => string(14) "61.135.169.105"
		["beginip"] => string(12) "61.135.162.0"
		["endip"] => string(14) "61.135.169.255"
		["country"] => string(9) "北京市"
		["area"] => string(12) "百度蜘蛛"
		}   */
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
	
	//首页更多方法
	public function more(){
		$condition['cid']=$_GET['id'];
		$name=$_GET['name'];
		$m=M($name);
		$this->assign("list", D($name)->listNews($name,$page->firstRow, $page->listRows,$condition));
		$this->display();
	}
    //SEO赋值
    public function seo($title,$keywords,$description,$positioin){
    	$this->assign('title',$title);
    	$this->assign('keywords',$keywords);
    	$this->assign('description',$description);
    	$this->assign('position',$positioin);
    }
    //路由解析
    public function router(){
    	//路由判断,路径参数还原
		$url = $_SERVER['PATH_INFO'];
		$ary = explode('/', $url);
		$rewrite = urldecode($ary[1]);
		$r = D("Router")->where("rewrite='".$rewrite."'")->getField('url');
		if($r){
			$exp = explode('/', $r);
			$id = $exp[3];
		}elseif ($_GET['id']){
			$id = $_GET['id'];
		}
		return $id;
    }
    //URL转换
    public function changurl($ary){
    	if(is_array($ary)){    		
			if(key_exists('apv', $ary)){	
    			$ary['rewrite']?$ary['url']='__APP__/'.$ary['rewrite']:$ary['url']='__APP__/article/view/id/'.$ary['id'];
			}elseif(key_exists('module', $ary)){
				$ary['rewrite']?$ary['url']='__APP__/'.$ary['rewrite']:$ary['url']='__APP__/'.strtolower($ary['module']).'/index/id/'.$ary['id'];
			}else{
				$ary['rewrite']?$ary['url']='__APP__/'.$ary['rewrite']:$ary['url']='__APP__/video/view/id/'.$ary['id'];
			}
			return $ary;
		}		
    }
    //模板选择
    public function choosetpl($ary){
    	if(is_array($ary)){
    		if(strpos($ary['template'], ':')){
    			$exp = explode(':', $ary['template']);
    			$file = $_SERVER['DOCUMENT_ROOT'].APP_TMPL_PATH.$exp[0].'/'.$exp[1].'.html';
    		}    		
    		if(strpos($ary['template'], ':') && is_file($file)){
    			$this->display($ary['template']);
    		}else{
    			if(key_exists('apv', $ary)){
    				$this->display('article:view');
    			}elseif (key_exists('module', $ary)){
    				$this->display(strtolower($ary['module']).':index');
    			}else{
    				$this->display('video:view');
    			}
    		}
    	}
    }
    //文件下载
    public function download(){
		$filename = $_SERVER[DOCUMENT_ROOT].__ROOT__.'/Public/Upload/download/'.$_GET['filename'];
		header("Content-type: application/octet-stream");  
		header("Content-Length: ".filesize($filename));  
		header("Content-Disposition: attachment; filename={$_GET['filename']}");	
		$fp = fopen($filename, 'rb');  
		fpassthru($fp);  
		fclose($fp); 
    }
    //留言评论信息处理
    public function msgmodify($ary){
    	if(is_array($ary)){
    		if($ary['adder_id']) $ary['adder_name']=getUserName($ary['adder_id']);
    		$ary['adder_email'] = md5($ary['adder_email']);
    	}
    	return $ary;
    }
    //导航index操作；
    //统一分配变量
    //首页更多操作;根据传过来的表名取数据
    public function index(){
    	//封装一个留学生index方法
    	//1.哪个表；2.表里提取哪种类型数据，3.不操作数据表；
    	$name=$this->getActionName();
    	$M = M($name);
    	$this->assign("list", D($name)->listNews($page->firstRow, $page->listRows));
    	$list=M($name)->select();
    	 $this->assign('list',$list);
    	$this->display();
    }
    //空操作
	public function _empty(){
		$this->redirect("/");
	}
	//更多操作;根据传过来的表名取数据；导航栏有数据库的直接连接到导航栏方法；
	public function listMore(){
		$name=$this->getActionName();
		$M = M($name);
		$this->assign("list", D($name)->listNews($page->firstRow, $page->listRows));
		$list=M($name)->select();
		$this->assign('list',$list);
		$this->display();
	}
	//详细会员操作；根据传过来的表名和类型取数据
	public function memberDetail(){
		$this->display();
	}
	//详细牵手恋人操作；根据传过来的表名取数据
	public function SuccessDetail(){
		$this->display();
	}
	
	public function foot(){
		//$model= 查到数据
		$m=M('Article_class');
		$where['sys_type']=2;
		$datas=$m->where($where)->select();
		foreach($datas as $k=>$v){
			$map['cid']=$v['cid'];
			$datas[$k]['data']=M('Article')->where($map)->select();
		}
		$this->assign('menu',$datas);
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
	
}