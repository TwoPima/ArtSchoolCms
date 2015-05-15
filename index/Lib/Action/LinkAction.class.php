<?php
/*友情链接类*/
class LinkAction extends CommonAction {
	//列表
	public function index(){
		$this->assign('list',D('Link')->where('status=1')->order('sort DESC')->select());
		$this->seo('友情链接列表', C('SITE_KEYWORDS'), C('SITE_DESCRIPTION'), 0);
		$this->display();
	}
	//申请链接
	public function add(){
		if($_SESSION['verify']!=md5($_POST['verify'])){
			 echo '<div class="pop">验证码错误，发表失败！</div>';
			 return false;
		}else{
			$data = $_POST;
			if(D('Link')->add($data)){
				echo '<div class="pop">发表成功，请等待审核！</div>'; 
			}else{
				echo '<div class="pop">发表失败！</div>';
			}
		}
	}
}