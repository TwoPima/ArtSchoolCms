<?php
/*
//导航数据二次菜单显示
// +----------------------------------------------------------------------
*/
class SubmenuAction extends CommonAction {
	public function index(){
		//分类列表
		$menu_mod = M('Article_cate');
		$detail_mod=M('Article');
		//图片新闻
		$where3['cate_id']=$_GET['pid'];
		$where3['is_img']="1";
		$detail_photo = $detail_mod->where($where3)->limit(1)->select();
		$this->assign('detail_photo',$detail_photo);
		//您现在的位置
		$getNowHere=$this->getNowHere($_GET['id']);
		$this->assign('now_here',$getNowHere);
		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
		$this->assign('detail_cate',$detail_cate);
		//左边导航分类
		$where1['pid']=$_GET['pid'];
		$where1['status']="1";
		$where1['in_site']="0";
		$result_cate = $menu_mod->where($where1)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		//资讯列表
		$where4['is_img'] = "0";
		$where4['cate_id']=$_GET['id'];
		$where4['status']="1";
		
		//判断是否是师资队伍和现任领导
		$where_tea_lea['id']=$_GET['id'];
		$cate_tea_lea = $menu_mod->where($where_tea_lea)->find();
		if ($cate_tea_lea['alias']=="teacher") {
			$mod_tea_leader=M('Teacher');
			$mod_pro=M('Profession_cate');
			//列出专业
			$zhuanye=$mod_pro->where('pid=0')->order('sort_order ASC')->select();
			$zhuanye_array=array();
			foreach($zhuanye as $key1=>$zhuanye_row){
				$jiaoshi=array();
				$zhuanye_temp_array['zhuanye']['id']=$zhuanye_row['id'];
				$zhuanye_temp_array['zhuanye']['name']=$zhuanye_row['name'];
				$whereTeaLeader['is_teacher']="1";
				$whereTeaLeader['pid']=$zhuanye_row['id'];
				$jiaoshi=$mod_tea_leader->where($whereTeaLeader)->order('create_time DESC,ordid ASC')->select();
				foreach($jiaoshi as $key=>$val1){
					$teacher_array=array();
					$teacher_array['id']=$val1['id'];
					$teacher_array['name']=$val1['name'];
						
					$zhuanye_temp_array['jiaoshi'.$key1][$key]=$teacher_array;
				}
				
				$zhuanye_array[$key1]=$zhuanye_temp_array;
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
			$count = $detail_mod->where($where4)->count();
			if ($count==1) {
				//显示具体文章资讯内容
				$this->indexDetail($_GET['id'],$_GET['pid']);
			}else {
				$page = new Page($count,15);
				$article_list = $detail_mod->where($where4)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
				$showPage = $page->show();
				$this->assign("page", $showPage);
				$this->assign('article_list',$article_list);
				$this->display();
			}
		
		}
	}
	/*  *
	 * 首页其他详细页面
	*/
	public function detail(){
		$model=M('Article');
		$menu_mod = M('Article_cate');
		//详细列表
		$where['id']=$_GET['id'];
		//详细页面
		$result_se=$model->where($where)->select();
		//图片显示
		$where_photo['id']=$result_se[0]['cate_id'];
		$detail_photo = $menu_mod->where($where_photo)->select();
		$where_photo1['id']=$detail_photo[0]['pid'];
		$photo = $menu_mod->where($where_photo1)->select();
		$where_photo2['cate_id']=$photo[0]['id'];
		$photo1 = $model->where($where_photo2)->select();
		//位置
		$getNowHere=$this->getNowHere($result_se[0]['cate_id']);
		//分类列表
		$where4['id']=$result_se[0]['cate_id'];
		$detail4 = $menu_mod->where($where4)->select();
		$wherePid['pid']=$detail4[0]['pid'];
		$wherePid['status']="1";
		$wherePid['in_site']="0";
		$result_cate = $menu_mod->where($wherePid)->order('sort_order ASC')->select();
		$this->assign('mainleft_cate_list',$result_cate);
		//分类名称详细显示
		$where2['id']=$_GET['id'];
		$detail_cate = $menu_mod->where($where2)->select();
		
		$this->assign('detail_photo',$photo1);
		$this->assign('now_here',$getNowHere);
		$this->assign('mainleft_cate_list',$result_cate);
		$this->assign('detail_cate',$detail_cate);
	
		$this->assign('detail',$result_se);
		$this->display();
	}
	/*  *
	 * //首页导航之后的详细页面
	 */
	public function indexDetail($id,$pid){
		$model=M('Article');
		$menu_mod = M('Article_cate');
		//详细页面
		$where3['is_img'] = "0";
		$where3['cate_id']=$id;
		$where3['status']="1";
		$result_se=$model->where($where3)->find();
		$this->assign('detail',$result_se);
		$this->display('indexDetail');
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
			$this->assign('mainleft_cate_list',$result_cate);
			//资讯列表
			$detail_mod=M('Article');
			$result_cate1 = $menu_mod->where($where)->order('sort_order ASC')->limit(1)->find();
			
			//分类名称详细显示
			$where2['id']=$result_cate1['id'];
			$detail_cate = $menu_mod->where($where2)->select();
			$this->assign('detail_cate',$detail_cate);
			//图片新闻
			$where3['cate_id']=$_GET['pid'];
			$where3['is_img']="1";
			$detail_photo = $detail_mod->where($where3)->limit(1)->select();
			$this->assign('detail_photo',$detail_photo);
			
			$getNowHere=$this->getNowHere($result_cate1['id']);
			$this->assign('now_here',$getNowHere);
			
			$where1['cate_id']=$result_cate1['id'];
			$where1['status']="1";
			$where1['is_img'] = "0";
			$count = $detail_mod->where($where1)->count();
			if ($count==1) {
				$this->indexDetail($result_cate1['id'], $result_cate1['pid']);
			}else {
				$page = new Page($count,15);
				$article_list = $detail_mod->where($where1)->limit($page->firstRow.','.$page->listRows)->order('add_time DESC,ordid ASC')->select();
				$this->assign('article_list',$article_list);
				$showPage = $page->show();
				$this->assign("page", $showPage);
				$this->display('index');
			}
			
		}
	}
	public  function teaDetail(){
		$this->display();
	}
}

?>