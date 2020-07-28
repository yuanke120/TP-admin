<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

//BIND_MODULE 常量 只需要入口文件添加BIND_MODULE常量，才可以把当前入口文件绑定指定的模块和控制器
//例如 define('APP_PATH')

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

//config配置文件
define('CONF_PATH', __DIR__.'/../config/');  //__DIR__：文件所在的目录

//绑定当前访问index模块
define('BIND_MODULE','index');  //index模块 就是说runtime目录下index模块 别忘config 启动 true

// 定义日志目录
define('LOG_PATH', __DIR__.'/../runtime/log/'.BIND_MODULE.'/');

// 定义项目模板缓存目录
define('CACHE_PATH', __DIR__.'/../runtime/cache/'.BIND_MODULE.'/');

// 定义应用缓存目录
define('TEMP_PATH', __DIR__.'/../runtime/cache/'.BIND_MODULE.'/');

// 定义SESSION保存目录
define('SESSION_PATH', __DIR__.'/../runtime/session/'.BIND_MODULE.'/');

// 加载框架引导文件
require (__DIR__ . '/../thinkphp/start.php');
