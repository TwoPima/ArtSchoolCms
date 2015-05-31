<?php
// +----------------------------------------------------------------------
// | MobileCms 移动应用软件后台管理系统
// +----------------------------------------------------------------------
// | provide by ：phonegap100.com
// 
// +----------------------------------------------------------------------
// | Author: htzhanglong@foxmail.com
// +----------------------------------------------------------------------

class ProfessionCateAction extends BaseAction
{
	//分类列表
    function index()
    {
        $article_cate_mod = M('Profession_cate');
        $article_mod = D('Profession');
    	$result = $article_cate_mod->order('sort_order ASC')->select();
    	$article_cate_list = array();
    	foreach ($result as $val) {
    	    if ($val['pid']==0) {
//    	    	$cates = $article_cate_mod->where("pid=".$val['id'])->select();
//    	    	$nums = 0;
//    	    	if( $cates ){
//    	    		foreach( $cates as $sval ){ $nums+=$article_mod->where("cate_id=".$sval['id'])->count(); }
//    	    	}else{
//    	    		$nums = $article_mod->where("cate_id=".$val['id'])->count();
//    	    	}
//    	    	$val['nums'] =$nums;
    	        $article_cate_list['parent'][$val['id']] = $val;
    	    } else {
    	    	//$val['nums'] = $article_mod->where("cate_id=".$val['id'])->count();
    	        $article_cate_list['sub'][$val['pid']][] = $val;
    	    }
    	}
    	$this->assign('article_cate_list',$article_cate_list);
		//$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=ProfessionCate&a=add\', title:\''.L('add_cate').'\', width:\'500\', height:\'400\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_cate'));
		//$this->assign('big_menu',$big_menu);
		$this->display();
    }
    /* 编辑 */
    function edit()
    {
    	if(isset($_POST['dosubmit'])){
    		$article_mod = D('ProfessionCate');
    		$attatch_mod = D('attatch');
    		$data = $article_mod->create();
    			if ($_FILES['img']['name']!='') {
    				$upload_list = $this->_upload();
    				$data['img'] = $upload_list['0']['savename'];
    			}
    		$result = $article_mod->where('id='.$data['id'])->save($data);
    		if(false !== $result){
    			$this->success(L('operation_success'),U('ProfessionCate/index'));
    		}else{
    			$this->error(L('operation_failure'));
    		}
    	}else{
    		$article_cate_mod = M('Profession_cate');
			if( isset($_GET['id']) ){
				$cate_id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : $this->error(L('please_select').L('article_name'));
			}
			$article_cate_info = $article_cate_mod->where('id='.$cate_id)->find();

			$result = $article_cate_mod->order('sort_order ASC')->select();
	    	$cate_list = array();
	    	foreach ($result as $val) {
	    	    if ($val['pid']==0) {
	    	        $cate_list['parent'][$val['id']] = $val;
	    	    } else {
	    	        $cate_list['sub'][$val['pid']][] = $val;
	    	    }
	    	}
		    $this->assign('cate_list', $cate_list);
			$this->assign('article_cate_info',$article_cate_info);
			$this->assign('show_header', false);
			$this->display();
    	}
    
    
    }
    //添加分类数据
    function add()
    {
    	if(isset($_POST['dosubmit'])){
    		$article_cate_mod = M('Profession_cate');
    		if( false === $vo = $article_cate_mod->create() ){
    			$this->error( $article_cate_mod->error() );
    		}
    		if($vo['name']==''){
    			$this->error('分类名称不能为空');exit;
    		}
    		$result = $article_cate_mod->where("name='".$vo['name']."' AND pid='".$vo['pid']."'")->count();
    		if($result != 0){
    			$this->error('该分类已经存在');
    		}
    		if ($_FILES['img']['name']!='') {
    				$upload_list = $this->_upload();
    				$vo['img'] = $upload_list['0']['savename'];
    		}
    		//保存当前数据
    		$article_cate_id = $article_cate_mod->add($vo);
    		$this->success(L('operation_success'), '', '', 'add');
    	}else{
    		$article_cate_mod = D('Profession_cate');
    		$result = $article_cate_mod->order('sort_order ASC')->select();
    		$article_cate_list = array();
    		foreach ($result as $val) {
    			if ($val['pid']==0) {
    				$article_cate_list['parent'][$val['id']] = $val;
    			} else {
    				$article_cate_list['sub'][$val['pid']][] = $val;
    			}
    		}
    		$this->assign('article_cate_list',$article_cate_list);
    		$this->assign('show_header', false);
    		$this->display();
    	}
    
   	 }
    
    function delete()
    {
        if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
            $this->error('请选择要删除的分类！');
		}
		$article_cate_mod = M('profession_cate');
		if (isset($_POST['id']) && is_array($_POST['id'])) {
		    $cate_ids = implode(',', $_POST['id']);
		    $article_cate_mod->delete($cate_ids);
		} else {

		    $cate_id = intval($_GET['id']);
		    $article_cate_mod->delete($cate_id);
		}
		$this->success(L('operation_success'));
    }
    private function _cate_exists($name, $pid, $id=0)
    {
    	$where = "name='".$name."' AND pid='".$pid."'";
    	if( $id&&intval($id) ){
    		$where .= " AND id<>'".$id."'";
    	}
        $result = M('article_cate')->where($where)->count();
        //echo(M('article_cate')->getLastSql());exit;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function sort_order()
    {
    	$article_cate_mod = M('Profession_cate');
		if (isset($_POST['listorders'])) {
            foreach ($_POST['listorders'] as $id=>$sort_order) {
            	$data['sort_order'] = $sort_order;
                $article_cate_mod->where('id='.$id)->save($data);
            }
            $this->success(L('operation_success'));
        }
        $this->error(L('operation_failure'));
    }
    //修改状态
	function status()
	{
		$article_cate_mod = D('Profession_cate');
		$flink_mod = D('flink');
		$id 	= intval($_REQUEST['id']);
		$type 	= trim($_REQUEST['type']);
		$sql 	= "update ".C('DB_PREFIX')."profession_cate set $type=($type+1)%2 where id='$id'";
		$res 	= $article_cate_mod->execute($sql);
		$values = $article_cate_mod->where('id='.$id)->find();
		$this->ajaxReturn($values[$type]);
	}
	public function _upload()
	{
		import("ORG.Net.UploadFile");
		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize = 3292200;
		//$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
		$upload->savePath = './data/profession/';
	
		$upload->saveRule = uniqid;
		if (!$upload->upload()) {
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		} else {
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo();
		}
		return $uploadList;
	}
	
}
?>