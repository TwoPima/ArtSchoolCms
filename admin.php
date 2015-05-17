<?php
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__));
if (!is_file(ROOT_PATH . '/data/install.lock')) {
    header('Location: ./install.php');
    exit;
}

/* 当前程序版本 */
define('NOW_VERSION', '1.0');
/* 当前程序Release */
define('NOW_RELEASE', '20130219');
/* 应用名称*/
define('APP_NAME', 'admin');
/* 应用目录*/
define('APP_PATH', './admin/');
/* 数据目录*/
define('DATA_PATH', './data/');
/* HTML静态文件目录*/
define('HTML_PATH', DATA_PATH . 'html/');

/* DEBUG开关*/
define('APP_DEBUG', true);
require(ROOT_PATH.'/core/core.php');
?>