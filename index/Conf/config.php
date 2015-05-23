<?php
/*
// | MobileCms 移动应用软件后台管理系统
// +----------------------------------------------------------------------
// | provide by ：phonegap100.com
// 
// +----------------------------------------------------------------------
// | Author: htzhanglong@foxmail.com
// +----------------------------------------------------------------------
*/
if (!defined('THINK_PATH'))	exit();

$config = require("config.inc.php");
$array = array( 	    
	'URL_MODEL' => '2',
    //缓存配置
 //   'DATA_CACHE_TYPE' => 'file', // 数据缓存方式 文件
//    'DATA_CACHE_TIME' => 0, // 数据缓存时间
 //   'DATA_CACHE_SUBDIR' => true,
 //   'DATA_PATH_LEVEL' => 2,
//	'URL_PATHINFO_DEPR' =>'-',  //参数之间的分割符号    	
    'DEFAULT_LANG' => 'zh-cn', // 默认语言	
	'SHOW_PAGE_TRACE'=>true,
		//'URL_HTML_SUFFIX'       => 'html',  // URL伪静态后缀设置
		//'HTML_CACHE_ON' => true, // 开启静态缓存
		//'URL_ROUTER_ON' => true, // 开启路由转换
		//'URL_MODEL'=>'2',//前台隐藏index.php
		//'URL_REWRITE'=>'2',//
);
return array_merge($config,$array);
?>