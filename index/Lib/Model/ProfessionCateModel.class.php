<?php
 class ProfessionCateModel extends RelationModel{
	protected $_link=array(
	'Teacher'=>array(
		'mapping_type'=>HAS_MANY,
		'class_name'=>'teacher',
		"parent_key" => 'id',
		'foreign_key'=>'pid',
		'mapping_name'=>'tea',
		'mapping_order'=>'',
		//关联的字段，可以多个
		'mapping_fields'=>'teacher',
		'as_fields'=>'name',
	),
);

}