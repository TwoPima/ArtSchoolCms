<?php
class CommonModel extends Model {
	public function listNews($name,$firstRow = 0, $listRows = 20,$where) {
		$M = M($name);
		$count = $M->where($where)->count();
		import("ORG.Util.Page");       //载入分页类
		$page = new Page($count, 20);
		$showPage = $page->show();
		$this->assign("page", $showPage);
		$list = $M->where($where)->limit("$firstRow , $listRows")->select();
		return $list;
	}
	public function getPosition($id){
		$type = D('Category')->where('status=1')->find($id);
		if($type['pid']==0){
			$position = $id;
		}else{
			$position = $type['pid'];
		}
		return $position;
	}
	public function getCategoryMap($id){
		$type = D('Category')->where('status=1')->find($id);
		if($type['pid']==0){
			$types = D('Category')->where('status=1 AND pid='.$type['id'])->select();
			if(is_array($types)){
					foreach($types as $val) $ary[]=$val['id'];
			}
			$map['tid']	= array('in',$ary);
		}else{
			$map['tid'] = array('eq',$id);
		}
		return $map;		
	}
}