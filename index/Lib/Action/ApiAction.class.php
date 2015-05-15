<?php
/*
// | MobileCms 移动应用软件后台管理系统
// +----------------------------------------------------------------------
// | provide by ：phonegap100.com
// 
// +----------------------------------------------------------------------
// | Author: htzhanglong@foxmail.com
// +----------------------------------------------------------------------
*/
class ApiAction extends BaseAction {
	private $page_size=40;	 //总分页数
	public function index() {						
		$this->check();	
		$method=$this->_get('method');
		//执行请求的方法
		$this->$method();
		exit();
	}
	//检测请求是否合法
	private function check(){
		$method_array=array('articleSearchGet','articleCateGet','articleListGet');
		//签名方式				
		$method=$this->_get('method');     //method
		$timestamp=$this->_get('timestamp');   //timestamp
		$key='phonegap100.com';	//双方约定的一个key		
		$sign=$this->_get('sign');  //签名				
		$my_sign=md5(strtolower($method.$timestamp.$key));		
		if(!in_array($method, $method_array)){
			exit('请求的方法不存在');
		}
		if($my_sign!=$sign){
			exit('签名不正确');
		}	
		return true;	
	}
	//获取文章列表
	private function articleSearchGet(){
		$keyword=urldecode($this->_get('keyword'));
		$page=$this->_get('p');
		$order=$this->_get('order');
		$page=isset($page)?$page:1;  //当前的页数
		$sql_where='status=1';		
		$sql_where.= !empty($keyword) ? " AND title LIKE '%" . trim($keyword) . "%'" :'';		
		$article_mod=D('article');
		import("ORG.Util.Page");
		$count = $article_mod->where($sql_where)->count();
		$totalPage=ceil($count/$this->page_size); //总页数
		
		$p = new Page($count,$this->page_size);
		if(empty($order)){
			$order='ordid ASC,id DESC';
		}else{
			$order=str_replace('_', ' ', $order);
		}	
		$articleSearchRel = $article_mod->field('id,title,info')->where($sql_where)->limit($p->firstRow.','.$p->listRows)->order($order)->select();
     	$articleSearchRel=array(
			'result'=>$articleSearchRel,
			'page'=>$page,
			'totalPage'=>$totalPage
		);			
		$articleSearchRel=json_encode($articleSearchRel);
		echo $articleSearchRel;
		exit;
	}
	/*
	 * cid=0 获取全部分类 
	 * cid=123  获取123分类下面的二级分类
	 * */
	private function articleCateGet(){
		$cid=$this->_get('cid');		
		$article_cate_mod = D('article_cate');
		if($cid>0&&is_numeric($cid)){
			$cate_lists = $article_cate_mod->field('id,name,pid')->where("pid={$cid}")->order('sort_order ASC')->select();
		 	 foreach($cate_lists as $key=>$val ){        	
	        	$sub_lists = $article_cate_mod->field('id,name,pid')->where("pid={$val['id']}")->order('sort_order ASC')->select();        	
	        	$cate_lists[$key]['sub']=$sub_lists;
	        }			
		}else{
			$cate_lists = $article_cate_mod->field('id,name,pid')->where('pid=0')->order('sort_order ASC')->select();
	        foreach($cate_lists as $key=>$val ){        	
	        	$sub_lists = $article_cate_mod->field('id,name,pid')->where("pid={$val['id']}")->order('sort_order ASC')->select();        	
	        	$cate_lists[$key]['sub']=$sub_lists;
	        }
		}		
       $cate_lists=json_encode($cate_lists);       
       echo $cate_lists;
       exit;		
	}
	//获取指定分类下面的文章
	private function articleListGet(){		
		$cid=$this->_get('cid');	
		$page=$this->_get('p');
		$order=$this->_get('order');
		$page=isset($page)?$page:1;  //当前的页数			
		$article_mod=D('article');
		$article_cate_mod = D('article_cate');
		
		$sql_where = "1=1 AND status=1";
		$cate_res=$article_cate_mod->field('id,pid')->where("id=$cid")->find();	
		$ids=array();
		if($cate_res['pid']==0){//表示为一级分类
			//$cate_sub_rel=$article_cate_mod->field('id,pid')->where("pid=$cate_res['id']")->find();
			$cate_sub_rel=$article_cate_mod->where("pid=$cid")->select();	
			foreach($cate_sub_rel as $key=>$val){   //二级或者一级分类				
				$cate_three_sub_rel=$article_cate_mod->where("pid='{$val['id']}'")->select();
				foreach ($cate_three_sub_rel as $k=>$v){
					$ids[]=$v['id'];
				}				
			}			
			$sql_where.= " AND cid IN (" . implode(',', $ids) . ")";     //获取商品
		}else{
			$cate_is_sub=$article_cate_mod->field('id,pid')->where("id={$cate_res['pid']}")->find();
			if($cate_is_sub['pid']==0){  //二级分类
				//$cate_sub_rel=$article_cate_mod->where("pid={$cate_is_sub['id']}")->select();				
				$cate_sub_rel=$article_cate_mod->where("pid={$cate_res['id']}")->select();				
				foreach($cate_sub_rel as $key=>$val){   //二级或者一级分类
					$ids[]=$val['id'];
				}			
				$sql_where.= " AND cid IN (" . implode(',', $ids) . ")";     //获取商品
				
			}else{//三级分类
				$sql_where.= " AND cid IN (" . $cid . ")";
			}
		}
		import("ORG.Util.Page");
		$count = $article_mod->where($sql_where)->count();	
		$totalPage=ceil($count/$this->page_size);
		$p = new Page($count,$this->page_size);	
		if(empty($order)){
			$order='ordid ASC,id DESC';
		}else{
			$order=str_replace('_', ' ', $order);
		}
		$article_list = $article_mod->field('id,title,info')->where($sql_where)
			->limit($p->firstRow . ',' . $p->listRows)
			->order($order)->select();
		$article_list=array(
			'result'=>$article_list,
			'page'=>$page,
			'totalPage'=>$totalPage
		);					
		echo (json_encode($article_list));
		exit;
	}
	
}

?>