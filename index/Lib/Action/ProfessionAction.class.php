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
		//图片新闻
		$pro_mod = M('Profession');
		$where3['cate_id']=$_GET['pid'];
		$detail_photo = $pro_mod->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],Profession);
		//提取专业介绍
		$intro_mod=M('Profession');
		$where['cate_id']=$_GET['pid'];
		$where['status']="1";
		$intro_pro= $intro_mod->where($where)->order('ordid ASC')->find();
	
		$this->assign('now_here',$getNowHere);
		$this->assign('left_cate_list',$left_cate_list);
		$this->assign('detail',$intro_pro);
		
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

		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
	
		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
	
		$this->assign('now_here',$getNowHere);

		$this->assign('detail_cate',$detail_cate);
		
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->find();
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->find();
		$this->assign('front',$front);
		$this->assign('after',$after);
		$this->assign('detail',$result_se);
		$this->display();
	}
}

?>