<?php
return array(
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'diancan', // 数据库名
	'DB_USER'   => 'at100', // 用户名
	'DB_PWD'    => 'at100123', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'at_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
    //调试
	'MODULE_ALLOW_LIST'    =>    array('Admin',"Api"),
	'DEFAULT_MODULE'       =>    'Api',  // 默认模块
	'SHOW_PAGE_TRACE' =>false,

	 'DEFAULT_CONTROLLER'    =>  'System',
	 'DEFAULT_ACTION'        =>  'Login',

	// 'HTML_CACHE_ON'     =>    false, // 开启静态缓存
 //    'HTML_CACHE_TIME'   =>    72000,   // 全局静态缓存有效期（秒）
 //    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
 //    'HTML_CACHE_RULES'  =>     array(
	//  	'Index:index'=>array('{:module}/{:controller}/{:action}',72000,'md5'),
 //    ),
 //    "HTML_PATH"=> APP_PATH.'Html/'
);