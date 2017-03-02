<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link href="__ROOT__/statics/admin/css/style.css" rel="stylesheet" type="text/css"/>
<link href="__ROOT__/statics/css/dialog.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="__ROOT__/statics/js/jquery/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="__ROOT__/statics/js/jquery/plugins/formvalidator.js"></script>
<script language="javascript" type="text/javascript" src="__ROOT__/statics/js/jquery/plugins/formvalidatorregex.js"></script>

<script language="javascript" type="text/javascript" src="__ROOT__/statics/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__ROOT__/statics/js/dialog.js"></script>
<script language="javascript" type="text/javascript" src="__ROOT__/statics/js/iColorPicker.js"></script>
<script language="javascript" type="text/javascript" src="__ROOT__/Statics/js/My97DatePicker/WdatePicker.js"></script>
<script language="javascript">
var URL = '__URL__';
var ROOT_PATH = '__ROOT__';
var APP	 =	 '__APP__';
var lang_please_select = "<?php echo (L("please_select")); ?>";
var def=<?php echo ($def); ?>;
$(function($){
	$("#ajax_loading").ajaxStart(function(){
		$(this).show();
	}).ajaxSuccess(function(){
		$(this).hide();
	});
});

</script>
<title><?php echo (L("website_manage")); ?></title>
</head>
<body>
<div id="ajax_loading">提交请求中，请稍候...</div>
<?php if($show_header != false): if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content-menu ib-a blue line-x">
    	<?php if(!empty($big_menu)): ?><a class="add fb" href="<?php echo ($big_menu["0"]); ?>"><em><?php echo ($big_menu["1"]); ?></em></a>　<?php endif; ?>
    </div>
</div><?php endif; endif; ?>
<div class="pad-lr-10">
    <form id="myform" name="myform" action="<?php echo u('Department/delete');?>" method="post" onsubmit="return check();">
    <div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="4%"><input type="checkbox" value="all" id="check_box" onclick="selectall('id[]');" name="all"></th>              	
                <th width="90"><?php echo L('alias');?></th>
                <th width="90"><?php echo L('office_place');?></th>
				<th width="90"><?php echo L('contract');?></th>
              	<th width="40"><?php echo L('sort_order');?></th>
                <th width="40"><?php echo L('operational');?></th>
            </tr>
        </thead>
    	<tbody>
        	<?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" value="<?php echo ($val["id"]); ?>" name="id[]"></td>                
                <td align="center"><?php echo (msubstr($val["alias"],0,20,'utf-8',false)); ?></td>
                <td align="center"><?php echo ($val["office_place"]); ?></td>
                <td align="center"><?php echo ($val["contract"]); ?></td>
                <td align="center"><input type="text" class="input-text-c input-text" id="sort_<?php echo ($val["id"]); ?>" onblur="sort(<?php echo ($val["id"]); ?>,'sort_order',this.value)" value="<?php echo ($val["sort_order"]); ?>" size="4" name="listorders[<?php echo ($val["id"]); ?>]"></td>
               	<td align="center"><a class="blue" href="<?php echo u('Department/edit', array('id'=>$val['id']));?>">编辑</a></td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

    <div class="btn">
    <label for="check_box">全选/取消</label>
 <input type="submit" class="button" name="dosubmit" value="删除" onclick="return confirm('确认删除')"/>
    </div>
    </div>
    </form>
</div>
<script type="text/javascript">
function edit(id, name) {
	var lang_edit = "编辑";
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:lang_edit+'--'+name,id:'edit',iframe:'?m=Department&a=edit&id='+id,width:'550',height:'400'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
</script>
</body>
</html>