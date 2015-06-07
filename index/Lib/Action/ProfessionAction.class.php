<?php
/*
 // 学科管理操作方法
// +----------------------------------------------------------------------
*/
class ProfessionAction extends CommonAction {
	public function _before_index(){
		//分类列表
		$cate_mod = M('Profession_cate');
		$cate_where['pid']=$_GET['pid'];
		$cate_where['status']="1";
		$left_cate_list = $cate_mod->where($cate_where)->order('sort_order ASC')->select();
		$this->assign('left_cate_list',$left_cate_list);
		//图片新闻
		$pro_mod = M('Profession');
		$where3['cate_id']=$_GET['pid'];
		$where3['is_img'] = "1";
		$detail_photo = $pro_mod->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],Profession);
		$this->assign('now_here',$getNowHere);
	//分类名称详细显示一个
		$detail_cate=$this->detailCatesingle($_GET['id'],Profession);
		$this->assign('detail_cate',$detail_cate);
		
		//提取专业介
		$intro_mod=M('Profession');
		$where['status']="1";
		$where['is_img'] = "0";
		if (empty($_GET['id'])) {
			$where['pid'] = "0";
			$count =$intro_mod->where($where)->count();
			$intro_pro= $intro_mod->where($where)->order('ordid ASC')->select();
		}else{
			$where['cate_id']=$_GET['id'];
			$count =$intro_mod->where($where)->count();
			$intro_pro= $intro_mod->where($where)->order('ordid ASC')->select();
		}
		$page = new Page($count,10);
		$showPage = $page->show();
		$this->assign("page", $showPage);
		$this->assign('article_list',$intro_pro);
		
	
	
	
		
	}
	public function detail(){
		$table=$_GET['mo'];
		$model=M($table);
		$where['id']=$_GET['id'];
		$result_se=$model->where($where)->select();
	
		//分类列表
		$menu_mod = M('Profession_cate');
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);

		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
		$this->assign('now_here',$getNowHere);

		//上一篇
		$where_front['id'] = array('lt',$_GET['id']);
		$where_front['is_img']="0";
		$front=$model->where($where_front)->order('id desc')->find();
		//下一篇
		$where_after['id'] = array('gt',$_GET['id']);
		$where_after['is_img']="0";
		$after=$model->where($where_after)->order('id desc')->find();
		$this->assign('front',$front);
		$this->assign('after',$after);
		$this->assign('detail',$result_se);
		$this->display();
	}
}

?>