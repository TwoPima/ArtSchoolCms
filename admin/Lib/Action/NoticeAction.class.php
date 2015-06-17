<?php
// +----------------------------------------------------------------------
// |中北大学艺术学院后台管理系统
// +----------------------------------------------------------------------
// | provide by ：马晓成
// 
// +----------------------------------------------------------------------
// | Author: 857773627@qq.com
// +----------------------------------------------------------------------
class NoticeAction extends BaseAction{	
	private $notice_mod;
	function __construct(){
		$this->notice_mod=M('notice');
	}
	function index()
	{		
		/*通知列表  */
		import("ORG.Util.Page");
		$count = $this->notice_mod->count();
		$p = new Page($count,20);
		$article_list = $this->notice_mod->limit($p->firstRow.','.$p->listRows)->order('add_time DESC,ordid ASC')->select();
		
		$notice_list = $this->notice_mod->order('add_time desc')->select();
		$list_rel=array();
		foreach ($notice_list as $value){			
			$list_rel[]=$value;
		}	
		
		$page = $p->show();
		$this->assign('page',$page);
		$this->assign('notice_list',$list_rel);
		/* $big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=Notice&a=add\', title:\'添加通知\', width:\'540\', height:\'510\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);','添加通知');
		$this->assign('big_menu',$big_menu); */
		$this->assign('show_header', true);
		$this->display();
	}
	function add()
	{
		if(isset($_POST['dosubmit'])){
			if( false === $vo = $this->notice_mod->create() ){
				$this->error( $this->notice_mod->error() );
			}
			if($vo['name']==''){
				$this->error('通知名称不能为空');
			}
			if($vo['add_time']==''){
				$this->error('请选择时间');
			}
			$result = $this->notice_mod->where("id=".$vo['id']." AND name='".$vo['name']."'")->count();
			if($result != 0){
				$this->error('该名称已经存在');
			}
			//时间处理
			$vo['add_time'] = strtotime($_POST['add_time']);
			//保存当前数据
			$app_cate_id = $this->notice_mod->add($vo);
			$this->success(L('operation_success'),U('Notice/index'));
		}else{			
			$this->assign('show_header', false);
			$this->display();
		}
	}

	function edit()
	{
		/* 通知编辑 */
		if(isset($_POST['dosubmit'])){
			if( false === $vo = $this->notice_mod->create() ){
				$this->error( $this->notice_mod->error() );
			}
			if($_POST['add_time']==''){
				$this->error('请选择时间');
			}
			$old_notice = $this->notice_mod->where('id='.$_POST['id'])->find();

			//名称不能重复
		/* 	if ($_POST['name'] != $old_notice['name']) {
				if ($this->_cate_exists($_POST['name'], $_POST['id'])) {
					$this->error('名称不能重复！');
				}
			}
 */			//时间处理
			$vo['add_time'] = strtotime($_POST['add_time']);
			$app_cate_id = $this->notice_mod->save($vo);
			$this->success(L('operation_success'),U('Notice/index'));
		}else{
			$id = isset($_REQUEST['id'])&&intval($_REQUEST['id'])?intval($_REQUEST['id']):$this->error('请选择分类');
			$notice = $this->notice_mod->where('id='.$id)->find();			
			//print_r($notice);
			//$notice['add_time']=date('Y-m-d',$notice['add_time']);
			$this->assign('notice',$notice);			
			$this->assign('show_header', false);
			$this->display();
		}
	}

	private function _cate_exists($name,$id=0)
	{
		$result = M('notice')->where("name='".$name."' AND id<>'".$id."'")->count();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	function delete()
	{
		if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
			$this->error('请选择要删除的通知！');
		}
		$old_notice = $this->notice_mod->where('id='.$_REQUEST['id'])->find();
		/* if( $old_notice['system']=='1' ){
			$this->error('您无权删除');
		} */
		if (isset($_POST['id']) && is_array($_POST['id'])) {
			$cate_ids = implode(',', $_POST['id']);
			$this->notice_mod->delete($cate_ids);
		} else {
			$cate_id = intval($_GET['id']);
			$this->notice_mod->delete($cate_id);
		}
		$this->success('已成功删除');
	}

	//修改状态
	function status()
	{
		$id 	= intval($_REQUEST['id']);
		$type 	= trim($_REQUEST['type']);
		$sql 	= "update ".C('DB_PREFIX')."notice set $type=($type+1)%2 where id='$id'";
		$res 	= $this->notice_mod->execute($sql);
		$values = $this->notice_mod->where('id='.$id)->find();
		$this->ajaxReturn($values[$type]);

	}

}
?>