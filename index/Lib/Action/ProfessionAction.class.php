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
		$herestr= '您现在的位置:'.'<a style="color:#000;" href="__APP__">&nbsp;&nbsp;首页&nbsp;&nbsp;</a>';
		if (empty($_GET['id'])) {
			$nowwhere['id']=$_GET['pid'];
			$uplevels=$cate_mod->where($nowwhere)->field("id,name")->find();
		}else {
			$nowwhere['id']=$_GET['id'];
			$uplevels = $cate_mod->field("id,name")->where($nowwhere)->find();
		}
		$nowHere="$herestr"."->&nbsp;&nbsp;".$uplevels['name'];
		$this->assign('now_here',$nowHere);
		//分类名称详细显示一个
			if (empty($_GET['id'])) {
				$cate_where2['id']=$_GET['pid'];
				$result = $cate_mod->where($cate_where2)->field("id,name")->find();
			}else {
				$where2['id']=$_GET['id'];
				$result = $cate_mod->where($where2)->field("id,name")->find();
			}
		$detail_catname=$result['name'];
		$this->assign('detail_cate',$detail_catname);
		
		//提取专业介
		$intro_mod=M('Profession');
		$where_list['status']="1";
		$where_list['is_img'] = "0";
		if (empty($_GET['id'])) {
			$cate_where3['pid']=$_GET['pid'];
			$result = $cate_mod->where($cate_where3)->order('sort_order ASC')->field("id,name")->find();
			$where_list['cate_id']=$result['id'];
			$count =$intro_mod->where($where_list)->count();
			$intro_pro= $intro_mod->where($where_list)->order('ordid ASC')->select();
		}else{
			$where_list['cate_id']=$_GET['id'];
			$count =$intro_mod->where($where_list)->count();
			$intro_pro= $intro_mod->where($where_list)->order('ordid ASC')->select();
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

		//左侧您现在的位置*****传送的ID为cate_id******
		$getNowHere=$this->secGetNowHere($result_se[0]['cate_id'],Profession);
		$this->assign('now_here',$getNowHere);
		//三级页面的图片显示
		$where_photo['id']=$result_se[0]['cate_id'];
		$detail_photo = $menu_mod->where($where_photo)->select();
		$where_photo1['id']=$detail_photo[0]['pid'];
		$photo = $menu_mod->where($where_photo1)->select();
		$where_photo2['cate_id']=$photo[0]['id'];
		$photo1 = $model->where($where_photo2)->select();
		$this->assign('detail_photo',$photo1);
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