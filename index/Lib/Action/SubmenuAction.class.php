<?php
/*
//导航数据二次菜单显示
// +----------------------------------------------------------------------
*/
class SubmenuAction extends CommonAction {
	public function index(){
		//分类列表
		$menu_mod = M('Article_cate');
		$where['pid']=$_GET['pid'];
		$where['status']="1";
		$where['in_site']="0";
		$result_cate = $menu_mod->where($where)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		
		//资讯列表
	 	$detail_mod=M('Article');
	 	$where1['is_img'] = "0";
		$where1['cate_id']=$_GET['id'];
		$where1['status']="1";
		//图片新闻
		$where3['cate_id']=$_GET['pid'];
		$where3['is_img']="1";
		$detail_photo = $detail_mod->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//您现在的位置
		$getNowHere=$this->getNowHere($_GET['id']);
		$this->assign('now_here',$getNowHere);
		//判断是否是师资队伍和现任领导
		$where_tea_lea['id']=$_GET['id'];
		$cate_tea_lea = $menu_mod->where($where_tea_lea)->find();
		if ($cate_tea_lea['alias']=="teacher") {
			$mod_tea_leader=M('Teacher');
			$mod_pro=M('Profession_cate');
	 		$zhuanye=$mod_pro->where('pid=0')->order('sort_order ASC')->select();
	 		$zhuanye_array=array();
	 		foreach($zhuanye as $zhuanye_row){
	 			$zhuanye_temp_array['zhuanye']['id']=$zhuanye_row['id'];
	 			$zhuanye_temp_array['zhuanye']['name']=$zhuanye_row['name'];
	 			$whereTeaLeader['is_teacher']="1";
	 			$whereTeaLeader['pid']=$zhuanye_row['id'];
	 			$jiaoshi=$mod_tea_leader->where($whereTeaLeader)->select();
	 			foreach($jiaoshi as $val1){
	 				$teacher_array=array();
	 				$teacher_array['id']=$val1['id'];
	 				$teacher_array['name']=$val1['name'];
	 				$zhuanye_temp_array['jiaoshi'][]=$teacher_array;
	 			}
	 			$zhuanye_array[]=$zhuanye_temp_array;			
	 		}
			$this->assign('teaList',$zhuanye_array);
			$this->display('teacher');
		}elseif ($cate_tea_lea['alias']=="leader"){
			$mod_tea_leader=M('Teacher');
			$whereTeaLeader['is_leader']="1";
			$re_tea=$mod_tea_leader->where($whereTeaLeader)->order('ordid ASC')->select();
			$this->assign('teaList',$re_tea);
			$this->display('leader');
		}else {
			//分页显示
			$count = $detail_mod->where($where1)->count();
		/* 	if ($count<1) {
				$this->detail($_GET['id'],$_GET['pid']);
			}else { */
				$page = new Page($count,15);
				$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
				$showPage = $page->show();
				$this->assign("page", $showPage);
				//分类名称详细显示
				$where2['id']=$_GET['id'];
				$detail_cate = $menu_mod->where($where2)->select();
					
				$this->assign('detail_cate',$detail_cate);
				$this->assign('article_list',$article_list);
				$this->display();
			
		}
		
	}
	public function detail($id){
		if ($_GET['type']=="1") {
		$table=$_GET['mo'];
		$model=M($table);
		$where['id']=$_GET['id'];
		$menu_mod = M('Article_cate');
		//详细页面
		$result_se=$model->where($where)->select();
	/* 	//分类列表
		$cate_where['id']=$result_se[0]['cate_id'];
		$cate_where['status']="1";
		$result_cate = $menu_mod->where($cate_where)->order('sort_order ASC')->select(); */
		//图片显示
		$where_photo['id']=$result_se[0]['cate_id'];
		$detail_photo = $menu_mod->where($where_photo)->select();
		$where_photo1['id']=$detail_photo[0]['pid'];
		$photo = $menu_mod->where($where_photo1)->select();
		$where_photo2['cate_id']=$photo[0]['id'];
		$photo1 = $model->where($where_photo2)->select();
		//位置
		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
		}else {
		//从导航直接传值过来
			$model=M('Article');
			$where['id']=$id;
			//详细页面
			$result_se=$model->where($where)->select();
			//分类列表（直接提取）
			$menu_mod = M('Article_cate');
			$result_cate=$menu_mod->where($where)->limit(1)->select();
			//图片显示
			$where_photo2['cate_id']=$_GET['pid'];
			$photo1 = $model->where($where_photo2)->limit(1)->select();
			//位置
			$getNowHere=$this->getNowHere($id);
		}
		//分类列表
		$where4['id']=$result_se[0]['cate_id'];
		$detail4 = $menu_mod->where($where4)->select();
		$wherePid['pid']=$detail4[0]['pid'];
		$wherePid['status']="1";
		$wherePid['in_site']="0";
		$result_cate = $menu_mod->where($wherePid)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		/* //上一篇
		$where_front['id'] = array('lt',$_GET['id']);
		$where_front['is_img']="0";
		$front=$model->where($where_front)->order('id desc')->find();
		//下一篇
		$where_after['id'] = array('gt',$_GET['id']);
		$where_after['is_img']="0";
		$after=$model->where($where_after)->order('id desc')->find();
			
		$this->assign('front',$front);
		$this->assign('after',$after);
		 */
		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
		//附件下载
		$attatch_mod = D('attatch');
		$whereAtta['type']="0";
		$whereAtta['aid']=$_GET['id'];
		$attatch= $attatch_mod->where($whereAtta)->find();
		$this->assign('attatch',$attatch);
		
		$this->assign('detail_photo',$photo1);
		$this->assign('now_here',$getNowHere);
		$this->assign('mainleft_cate_list',$result_cate);
		$this->assign('detail_cate',$detail_cate);
	
		$this->assign('detail',$result_se);
		$this->display();
	}
	public function showFirstMenu(){
		$menu_mod = M('Article_cate');
		$where['pid']=$_GET['pid'];
		$re_only_menu=$menu_mod->where($where)->count();//判别是否只有一个菜单
		if ($re_only_menu == "0") {
			$this->redirect("Index/index");
		}else {
			//分类列表
			$where['in_site']="0";
			$result_cate = $menu_mod->where($where)->order('sort_order ASC')->select();
			//资讯列表
			$detail_mod=M('Article');
			$result_cate1 = $menu_mod->where($where)->order('sort_order ASC')->limit(1)->find();
			$where1['cate_id']=$result_cate1['id'];
			$where1['status']="1";
			$where1['is_img'] = "0";
			$count = $detail_mod->where($where1)->count();
			$page = new Page($count,15);
			$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
			$this->assign('article_list',$article_list);
			$showPage = $page->show();
			
			//分类名称详细显示
			$where2['id']=$result_cate1['id'];
			$detail_cate = $menu_mod->where($where2)->select();
			$this->assign('detail_cate',$detail_cate);
			//图片新闻
			$where3['cate_id']=$_GET['pid'];
			$where3['is_img']="1";
			$detail_photo = $detail_mod->where($where3)->limit(1)->select();
			$getNowHere=$this->getNowHere($result_cate1['id']);
			$this->assign('now_here',$getNowHere);
			$this->assign('detail_photo',$detail_photo);
			$this->assign('mainleft_cate_list',$result_cate);
		
			$this->assign("page", $showPage);
			$this->display('index');
		}
	}
}

?>