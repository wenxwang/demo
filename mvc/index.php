<?php
// 入口文件

// 应用根目录
define('APP_PATH', __DIR__ . '/');

// 调试模式
define('APP_DEBUG', true);

// 加载框架文件
require(APP_PATH . 'vendor/mvc/mvc.php');

// 配置文件
$config = require(APP_PATH . 'config/config.php');

// 实例化框架类
(new mvc\Mvc($config))->run();