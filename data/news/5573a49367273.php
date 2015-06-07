<?php
function add()
	{
		if(isset($_POST['dosubmit'])){
			$article_mod = D('article');
			$attatch_mod = D('attatch');
			if($_POST['title']==''){
				$this->error(L('input').L('article_title'));
			}
			if(false === $data = $article_mod->create()){
				$this->error($article_mod->error());
			}
			if(!empty($_FILES['img']['name'])||!empty($_FILES['attachment']['name'])){
				$upload_list = $this->_upload();
				if ($_FILES['img']['name']!='') {
					//只有图片不为空时
					$data['img'] = $upload_list['0']['savename'];
				}
				$result = $article_mod->add($data);
				if($result){
					if ($_FILES['attachment']['name'][0]!='') {
						$file['title'] = $upload_list[0]['name'];
						$file['filetype'] = $upload_list[0]['extension'];
						$file['filesize'] = $upload_list[0]['size'];
						$file['url'] = $upload_list[0]['savename'];
						$file['uptime'] = date('Y-m-d H:i:s');
						$file['aid']=$result;
						$attatch_mod->add($file);
					}
					$cate = M('article_cate')->field('id,pid')->where("id=".$data['cate_id'])->find();
					if( $cate['pid']!=0 ){
						M('article_cate')->where("id=".$cate['pid'])->setInc('article_nums');
						M('article_cate')->where("id=".$data['cate_id'])->setInc('article_nums');
					}else{
						M('article_cate')->where("id=".$data['cate_id'])->setInc('article_nums');
					}
					$this->success('添加成功');
				}else{
					//有附件的增加失败
					$this->error('添加失败');
				}
			}
			
				$result = $article_mod->add($data);
				if($result){
					$cate = M('article_cate')->field('id,pid')->where("id=".$data['cate_id'])->find();
					if( $cate['pid']!=0 ){
						M('article_cate')->where("id=".$cate['pid'])->setInc('article_nums');
						M('article_cate')->where("id=".$data['cate_id'])->setInc('article_nums');
					}else{
						M('article_cate')->where("id=".$data['cate_id'])->setInc('article_nums');
					}
					$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
	
		}else{
		//显示增加页面
			$article_cate_mod = D('article_cate');
	    	$result = $article_cate_mod->order('sort_order ASC')->select();
	    	$cate_list = array();
	    	foreach ($result as $val) {
	    	    if ($val['pid']==0) {
	    	        $cate_list['parent'][$val['id']] = $val;
	    	    } else {
	    	        $cate_list['sub'][$val['pid']][] = $val;
	    	    }
	    	}
	    	$this->assign('cate_list',$cate_list);
	    	$this->display();
		}
	
}
	?>