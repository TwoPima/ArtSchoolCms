<?php
/*空类*/
class EmptyAction extends Action {
	//空模块
	public function index(){
		$this->dispath();
    }
	//空操作
	public function _empty(){
		$this->dispath();
	}
	public function dispath(){
		$url = $_SERVER['PATH_INFO'];
		$ary = explode('/', $url);
		$rewrite = urldecode($ary[1]);
		$r = D("Router")->where("rewrite='".$rewrite."'")->getField('url');
		if($r){
			$exp = explode('/', $r);
			R(ucfirst($exp[0]), $exp[1]);
		}else{
			$this->redirect("index/index");
		}	
	}	
}