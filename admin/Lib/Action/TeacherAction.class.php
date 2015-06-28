<?php
// +----------------------------------------------------------------------
// |中北大学艺术学院后台管理系统
// +----------------------------------------------------------------------
// | provide by ：马晓成
// 
// +----------------------------------------------------------------------
// | Author: 857773627@qq.com
// +----------------------------------------------------------------------

class TeacherAction extends BaseAction
{
	private $teacher_mod;
	function __construct(){
		$this->teacher_mod=M('Teacher');
	}
	/*public function index()
	 {
		$teacher=D('Teacher');
		$teacher_list = $teacher->order('ordid ASC')->select();
		$list_rel=array();
		foreach ($teacher_list as $value){			
			$list_rel[]=$value;
		}	
		$this->assign('teacher_list',$list_rel);
		$this->display();
	} */
	public function index()
	{
		$article_mod = D('teacher');
		$article_cate_mod = D('profession_cate');
		import("ORG.Util.Page");
		$count = $article_mod->count();
		$p = new Page($count,20);
		$article_list = $article_mod->limit($p->firstRow.','.$p->listRows)->order('create_time DESC,ordid ASC')->select();
	
		$key = 1;
		foreach($article_list as $k=>$val){
			$article_list[$k]['key'] = ++$p->firstRow;
			$article_list[$k]['cate_name'] = $article_cate_mod->where('id='.$val['pid'])->find();
		}
		$result = $article_cate_mod->order('sort_order ASC')->select();
		$cate_list = array();
		foreach ($result as $val) {
			if ($val['pid']==0) {
				$cate_list['parent'][$val['id']] = $val;
			} else {
				$cate_list['sub'][$val['pid']][] = $val;
			}
		}
		$page = $p->show();
		$this->assign('page',$page);
		$this->assign('cate_list', $cate_list);
		$this->assign('article_list',$article_list);
		$this->display();
	 }
	function edit()
	{
	if(isset($_POST['dosubmit'])){
			$profession_mod = M('Teacher');
			$data = $profession_mod->create();
			if ($_FILES['img']['name']!='') {
				$upload_list = $this->_upload();
				$data['img'] = $upload_list['0']['savename'];
			}
			//最后的整体操作
			$result = $profession_mod->where('id='.$data['id'])->save($data);
			if(false !== $result){
				$this->success(L('operation_success'),U('Teacher/index'));
			}else{
				$this->error(L('operation_failure'));
			}
		}else{
			//不是编辑操作
			$article_mod = D('Teacher');
			if( isset($_GET['id']) ){
				$article_id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : $this->error(L('please_select'));
			}
			//专业提取
			$pro_cate_mod = D('Profession_cate');
			$result_pro = $pro_cate_mod->where('pid=0')->order('sort_order ASC')->select();
			$pro_list = array();
			foreach ($result_pro as $val) {
				$pro_list[]=$val;
			}
			$this->assign('pro_list',$pro_list);
			
			$article_info = $article_mod->where('id='.$article_id)->find();
			$this->assign('show_header', false);
			$this->assign('Teacher',$article_info);
			$this->display();
		}
	}

	function add(){

	if(isset($_POST['dosubmit'])){
			$profession_mod = M('Teacher');
			$data = $profession_mod->create();
			if ($_FILES['img']['name']!='') {
				$upload_list = $this->_upload();
				$data['img'] = $upload_list['0']['savename'];
			}
			
			/* if($data['pid']==0){
				$this->error('请选择专业类别');
			} */
			$result = $profession_mod->add($data);
			if($result){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
			//专业提取
			$pro_cate_mod = D('Profession_cate');
			$result_pro = $pro_cate_mod->where('pid=0')->order('sort_order ASC')->select();
			$pro_list = array();
			foreach ($result_pro as $val) {
				$pro_list[]=$val;
			}
			$this->assign('pro_list',$pro_list);
				
	    	$this->display();
		}
	}

	function delete_attatch()
    {
    	$attatch_mod = D('attatch');
    	$article_mod = D('Teacher');
    	$article_id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : exit('0');
    	$aid = isset($_GET['aid']) && intval($_GET['aid']) ? intval($_GET['aid']) : exit('0');
		$article_info = $article_mod->where('id='.$article_id)->find();
    	$aid_arr = explode(',', $article_info['aid']);
    	foreach ($aid_arr as $key=>$val) {
    	    if ($val == $aid) {
    	        unset($aid_arr[$key]);
    	    }
    	}
    	$aids = implode(',', $aid_arr);
    	$article_mod->where('id='.$article_id)->save(array('aid'=>$aids));
    	echo '1';
    	exit;
    }

	function delete()
    {
    	if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
    		$this->error('请选择要删除的选项！');
    	}
    	$old_nav =$this->teacher_mod->where('id='.$_REQUEST['id'])->find();
    	
    	if (isset($_POST['id']) && is_array($_POST['id'])) {
    		$cate_ids = implode(',', $_POST['id']);
    		$this->teacher_mod->delete($cate_ids);
    	} else {
    		$cate_id = intval($_GET['id']);
    		$this->teacher_mod->delete($cate_id);
    	}
    	$this->success('已成功删除');
    }

    public function _upload()
    {
    	import("ORG.Net.UploadFile");
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 31457280;
        $upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
        $upload->savePath = './data/teacher/';

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
	function sort_order()
    {
    	$article_mod = D('Teacher');
		if (isset($_POST['listorders'])) {
            foreach ($_POST['listorders'] as $id=>$sort_order) {
            	$data['ordid'] = $sort_order;
                $article_mod->where('id='.$id)->save($data);
            }
            $this->success(L('operation_success'));
        }
        $this->error(L('operation_failure'));
    }

    //修改状态
	function status()
	{
		$article_mod = D('Teacher');
		$id 	= intval($_REQUEST['id']);
		$type 	= trim($_REQUEST['type']);
		$sql 	= "update ".C('DB_PREFIX')."article set $type=($type+1)%2 where id='$id'";
		$res 	= $article_mod->execute($sql);
		$values = $article_mod->field("id,".$type)->where('id='.$id)->find();
		$this->ajaxReturn($values[$type]);
	}

}
?>