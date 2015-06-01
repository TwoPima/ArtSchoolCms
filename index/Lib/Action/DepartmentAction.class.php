<?php
/*
// read more 的整体操作方法
// +----------------------------------------------------------------------
*/
class DepartmentAction extends CommonAction {
	public function detail(){
		$table=$_GET['mo'];
		$model=M($table);
		$cate_name_model=M($table.'_'.'cate');
		//部门菜单
		$where_menu['is_dep']="1";
		$result = $cate_name_model->where($where_menu)->order('sort_order ASC')->select();
		$dep_cate_list = array();
		foreach ($result as $val) {
			if ($val['pid']==0) {
				$dep_cate_list['parent'][$val['id']] = $val;
			} else {
				$dep_cate_list['sub'][$val['pid']][] = $val;
			}
		}
		$this->assign('dep_cate_list',$dep_cate_list);
		
		//分类名称详细显示一个
		$detail_cate=$this->detailCatesingle($_GET['id'],$table);
		
		//左侧您现在的位置
		$getNowHere=$this->secGetNowHere($_GET['id'],$table);
		//部门详细操作
		$dep_detail=$cate_name_model->where('cate_id='.$_GET['id'])->find();
		
		$this->assign('now_here',$getNowHere);
		$this->assign('detail_cate',$detail_cate);
		$this->assign('detail_dep',$dep_detail);
		
		/* 
		//上一篇
		$front=$model->where("id<".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($front)) {
			$front="没有了！";
		}
		//下一篇
		$after=$model->where("id>".$_GET['id'])->order('id desc')->limit('1')->find();
		if (empty($after)) {
			$after="没有了！";
		}
		$this->assign('front',$front);
		$this->assign('after',$after); */
		$this->display();
	}
}

?>