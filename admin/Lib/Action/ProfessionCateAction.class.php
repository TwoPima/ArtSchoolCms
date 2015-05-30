<?php
// +----------------------------------------------------------------------
// |中北大学艺术学院后台管理系统
// +----------------------------------------------------------------------
// | provide by ：马晓成
// 
// +----------------------------------------------------------------------
// | Author: 857773627@qq.com
// +----------------------------------------------------------------------

class ProfessionCateAction extends BaseAction
{
	private $profession_mod;
	function __construct(){
		$this->profession_mod=M('ProfessionCate');
	}
	public function index()
	{
		/*列表  */
		$profession_list = $this->profession_mod->order('sort_order ASC')->select();
		$list_rel=array();
		foreach ($profession_list as $value){			
			$list_rel[]=$value;
		}	
		$this->assign('Profession_list',$list_rel);
		$this->display();
	}
/*  public function index() {   
        $Photo = M('Photo');   
        $list = $Photo->order('create_time desc')->limit(2)->findAll();  
        $this->assign('list', $list);   
        $this->display();   
    }   
  
    public function upload() {   
        if (!emptyempty($_FILES)) {   
            //如果有文件上传 上传附件   
            $this->_upload();   
            //$this->forward();   
        }   
    }    */
	function edit()
	{
		if(isset($_POST['dosubmit'])){
			$profession_mod = M('ProfessionCate');
			$data = $profession_mod->create();
			if ($_FILES['logo']['name']!='') {
				$upload_list = $this->_upload();
				$data['logo'] = $upload_list['0']['savename'];
			}
			//最后的整体操作
			$result = $profession_mod->where('id='.$data['id'])->save($data);
			if(false !== $result){
				$this->success(L('operation_success'),U('ProfessionCate/index'));
			}else{
				$this->error(L('operation_failure'));
			}
		}else{
			//不是编辑操作
			$article_mod = D('ProfessionCate');
			if( isset($_GET['id']) ){
				$article_id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : $this->error(L('please_select'));
			}
			$article_info = $article_mod->where('id='.$article_id)->find();

/* 			//附件
			$attatch_mod = D('attatch');
			$article_info['attatch'] = $attatch_mod->where("aid IN (".$article_info['aid'].")")->select();
 */
			$this->assign('show_header', false);
			$this->assign('Profession',$article_info);
			$this->display();
		}
	}

	function add()
	{
		if(isset($_POST['dosubmit'])){
			$profession_mod = M('ProfessionCate');
			$data = $profession_mod->create();
		  if( false === $vo = $profession_mod->create() ){
		        $this->error( $profession_mod->error() );
		    }
		    if($vo['name']==''){
		    	$this->error('名称不能为空');exit;
		    }
		    $result1 = $profession_mod->where("name='".$vo['name'])->count();
		    if($result1 != 0){
		        $this->error('该分类已经存在');
		    }
			if ($_FILES['logo']['name']!='') {
				$upload_list = $this->_upload();
				$data['logo'] = $upload_list['0']['savename'];
			}
			//$data['add_time']=date('Y-m-d H:i:s',time());
			$result = $profession_mod->add($data);
			if($result){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
	    	$this->display();
		}
	}
	function delete_attatch()
    {
    	$attatch_mod = D('attatch');
    	$article_mod = D('ProfessionCate');
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
    	$old_nav =$this->profession_mod->where('id='.$_REQUEST['id'])->find();
    	
    	if (isset($_POST['id']) && is_array($_POST['id'])) {
    		$cate_ids = implode(',', $_POST['id']);
    		$this->profession_mod->delete($cate_ids);
    	} else {
    		$cate_id = intval($_GET['id']);
    		$this->profession_mod->delete($cate_id);
    	}
    	$this->success('已成功删除');
    }

	function sort_order()
    {
    	$article_mod = D('ProfessionCate');
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
		$article_mod = D('ProfessionCate');
		$id 	= intval($_REQUEST['id']);
		$type 	= trim($_REQUEST['type']);
		$sql 	= "update ".C('DB_PREFIX')."article set $type=($type+1)%2 where id='$id'";
		$res 	= $article_mod->execute($sql);
		$values = $article_mod->field("id,".$type)->where('id='.$id)->find();
		$this->ajaxReturn($values[$type]);
	}
	// 文件上传
  public function _upload()
    {
    	import("ORG.Net.UploadFile");
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 3292200;
        //$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
        $upload->savePath = './data/profession/';//width:200  140

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