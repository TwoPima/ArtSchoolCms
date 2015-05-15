<?php
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__));
if (is_file(ROOT_PATH . '/data/install.lock')) {
    header('Location: ./index.php');
    exit;
}
/* 应用名称*/
define('APP_NAME', 'install');
/* 应用目录*/
define('APP_PATH', './install/');
/* 数据目录*/
define('DATA_PATH', './data/');
/* HTML静态文件目录*/
define('HTML_PATH', DATA_PATH . 'html/');
/* DEBUG开关*/
define('APP_DEBUG', true);
require(ROOT_PATH.'/core/core.php');
?>