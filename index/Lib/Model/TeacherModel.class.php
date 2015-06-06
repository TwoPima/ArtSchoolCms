<?php
 class TeacherModel extends RelationModel{
	protected$_auto=array(
		array('time','time',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
		);
	
	protected $_link=array(
	'Teacher'=>array(
		'mapping_type'=>BELONGS_TO,
		 'class_name'=>'teacher',
		//外键，也就是表Stus中的字段
			"parent_key" => 'id',
		'foreign_key'=>'id',
		'mapping_name'=>'tea',
		//关联的字段，可以多个
		'mapping_fields'=>'teacher',
				//'condition'=>'cname',
		//'as_fields'=>'cname:classname'
	),
);

}