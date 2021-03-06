<?php
// +----------------------------------------------------------------------
// |中北大学艺术学院后台管理系统
// +----------------------------------------------------------------------
// | provide by 马晓成 ：
// 
// +----------------------------------------------------------------------
// | Author: 857773627@qq.com
// +----------------------------------------------------------------------

class DepartmentAction extends BaseAction
{
	private $department_mod;
	function __construct(){
		$this->department_mod=M('ArticleCate');
	}
	public function index()
	{
		/*列表  */
		$where['is_dep']="1";
		$where['pid']="0";
		$department_list = $this->department_mod->where($where)->order('sort_order ASC')->select();
		$list_rel=array();
		foreach ($department_list as $value){			
			$list_rel[]=$value;
		}	
		$this->assign('department_list',$list_rel);
		$this->display();
	}
	/* 编辑 */
	function edit()
	{
		if(isset($_POST['dosubmit'])){
			$article_mod = D('ArticleCate');
			$attatch_mod = D('attatch');
			$data = $article_mod->create();
			if ($_FILES['img']['name']!=''||$_FILES['attachment']['name'][0]!='') {
			    $upload_list = $this->_upload();
			    if ($_FILES['img']['name']!=''&&$_FILES['attachment']['name'][0]!='') {
				    $data['img'] = $upload_list['0']['savename'];
				    array_shift($upload_list);
				    $aid_arr = array();
			        foreach ($upload_list as $att) {
			            $file['title'] = $att['name'];
			            $file['filetype'] = $att['extension'];
					    $file['filesize'] = $att['size'];
					    $file['url'] = $att['savename'];
					    $file['uptime'] = date('Y-m-d H:i:s');
						$attatch_mod->add($file);
						$aid_arr[] = mysql_insert_id();
			        }
			        $data['aid'] = implode(',', $aid_arr);
			    } elseif ($_FILES['img']['name']!='') {
			        $data['img'] = $upload_list['0']['savename'];
			    } else {
			        $aid_arr = array();
			        foreach ($upload_list as $att) {
			            $file['title'] = $att['name'];
			            $file['filetype'] = $att['extension'];
					    $file['filesize'] = $att['size'];
					    $file['url'] = $att['savename'];
					    $file['uptime'] = date('Y-m-d H:i:s');
						$attatch_mod->add($file);
						$aid_arr[] = mysql_insert_id();
			        }
			        $data['aid'] = implode(',', $aid_arr);
			    }
			    if ($data['aid']) {
			        $article_info = $article_mod->where('id='.$data['id'])->find();
			        if ($article_info['aid']) {
			            $data['aid'] = $article_info['aid'].','.$data['aid'];
			        }
			    }
			}
			$result = $article_mod->save($data);
			if(false !== $result){
				$this->success(L('operation_success'),U('Department/index'));
			}else{
				$this->error(L('operation_failure'));
			}
		}else{
			$article_mod = D('ArticleCate');
			if( isset($_GET['id']) ){
				$article_id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : $this->error(L('please_select'));
			}
			$article_info = $article_mod->where('id='.$article_id)->find();

			//附件
			$attatch_mod = D('attatch');
			$article_info['attatch'] = $attatch_mod->where("aid IN (".$article_info['aid'].")")->select();

			$this->assign('show_header', false);
			$this->assign('Department',$article_info);
			$this->display();
		}


	}

	function add()
	{
		if(isset($_POST['dosubmit'])){
			$article_mod = D('ArticleCate');
			$attatch_mod = D('attatch');
			if(false === $data = $article_mod->create()){
				$this->error($article_mod->error());
			}
			if ($_FILES['img']['name']!=''||$_FILES['attachment']['name'][0]!='') {
			    if ($_FILES['img']['name']!=''&&$_FILES['attachment']['name'][0]!='') {
				    $upload_list = $this->_upload();
				    $data['img'] = $upload_list['0']['savename'];
				    array_shift($upload_list);
				    $aid_arr = array();
			        foreach ($upload_list as $att) {
			            $file['title'] = $att['name'];
			            $file['filetype'] = $att['extension'];
					    $file['filesize'] = $att['size'];
					    $file['url'] = $att['savename'];
					    $file['uptime'] = date('Y-m-d H:i:s');
						$attatch_mod->add($file);
						$aid_arr[] = mysql_insert_id();
			        }
			        $data['aid'] = implode(',', $aid_arr);
			    } elseif ($_FILES['img']['name']!='') {
			        $upload_list = $this->_upload();
			        $data['img'] = $upload_list['0']['savename'];
			    } else {
			        $upload_list = $this->_upload();
			        $aid_arr = array();
			        foreach ($upload_list as $att) {
			            $file['title'] = $att['name'];
					    $file['filetype'] = $att['extension'];
					    $file['filesize'] = $att['size'];
					    $file['url'] = $att['savename'];
					    $file['uptime'] = date('Y-m-d H:i:s');
						$attatch_mod->add($file);
						$aid_arr[] = mysql_insert_id();
			        }
			        $data['aid'] = implode(',', $aid_arr);
			    }
			}
			$data['add_time']=date('Y-m-d H:i:s',time());
			$result = $article_mod->add($data);
			if($result){
				$this->success('添加成功',U('Department/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
	    	$this->display();
		}
	}

	function delete()
    {
    	
    	$this->error('请在内容管理下的导航分类管理里进行删除操作！');
    }

    public function _upload()
    {
    	import("ORG.Net.UploadFile");
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 3292200;
        //$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
        $upload->savePath = './data/department/';

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