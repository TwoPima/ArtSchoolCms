<?php
/**
 +----------------------------------------------------------
 *公用的foot操作
 *aothor:857773627@qq.com xiaocheng
 +----------------------------------------------------------
 */
class CommfootAction extends CommonAction{
	/**
	 +----------------------------------------------------------
	 * 公共menu
	 +----------------------------------------------------------
	 */
	public function menu(){
		//$model= 查到数据
		
		$m=M('Article_class');
		$where['sys_type']=2;
		$datas=$m->where($where)->select();
		foreach($datas as $k=>$v){
			$map['cid']=$v['cid'];
			$datas[$k]['data']=M('Article')->where($map)->select();
		}
		return $datas;
	}
	/* public function right(){
		//$model= 根据文章id->内容
		
	} */
	/**
	 +----------------------------------------------------------
	 * 服务条款
	 +----------------------------------------------------------
	 */
	public function terms(){
	
	
	}
	/**
	 +----------------------------------------------------------
	 * 关于我们
	 +----------------------------------------------------------
	 */
	public function about(){
		$datas=$this->menu();
		//右边内容
		$id=$_GET['id'];
		$m=M('Article');
		$str=$m->getPk ();
		$where[$str]=$id;
		$result=$m->where($where)->select();
		$this->assign('menu',$datas);
		$this->assign('article',$result);
		$this->display();
	
	}
	
	public function aboutmain(){
		$this->display();
	
	}
	/**
	 +----------------------------------------------------------
	 * 公益操作
	 +----------------------------------------------------------
	 */
	public function Nonprofit(){
		$this->display();
	
	}
	/**
	 +----------------------------------------------------------
	 * 权利保护
	 +----------------------------------------------------------
	 */
	public function right(){
		$this->display();
	
	}
	/**
	 +----------------------------------------------------------
	 * 隐私保护
	 +----------------------------------------------------------
	 */
	public function privacy(){
		$this->display();
	
	}
	/**
	 +----------------------------------------------------------
	 * 联系我们
	 +----------------------------------------------------------
	 */
	public function Contact(){
		$this->display();
	
	}
	
}
