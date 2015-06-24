<?php
class TeacherModel extends RelationModel {
	protected $autoSaveRelations      = false;        // 自动关联保存
	 protected $autoDelRelations        = false;        // 自动关联删除
	 protected $autoAddRelations       = false;        // 自动关联写入
	 protected $autoReadRelations      = false;        // 自动关联查询
	
	protected $_link = array(
			'ProfessionCate'=> array ( 
			 		 'mapping_type'=> BELONGS_TO,//每个老师表属于一个专业
			 		 'mapping_name'=>'Profession',
			 		 'class_name'=>'Profession',
			 		 'foreign_key'=>'id',
					'as_fields'=>'profession_name',
			),
			
	 );
}
