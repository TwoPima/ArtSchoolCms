<?php
 class TeacherModel extends RelationModel{
	protected$_auto=array(
		array('time','time',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
		);
	
	protected $_link=array(
	'Teacher'=>array(
		'mapping_type'=>BELONGS_TO,
		'class_name'=>'ProfessionCate',
		"parent_key" => 'id',
		'foreign_key'=>'pid',
		'mapping_name'=>'tea',
		'mapping_order'=>'',
		//关联的字段，可以多个
		'condition '=>'status=1',
		'mapping_fields'=>'id,name',
		//'as_fields'=>'cname:classname'
	),
);

}