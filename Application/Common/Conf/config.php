<?php
return array(
	// 关闭多模块访问
	'MULTI_MODULE'          =>  false,
	'DEFAULT_MODULE'        =>  'Home',
	'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
	'URL_PARAMS_BIND_TYPE'  =>  1, // 设置参数绑定按照变量顺序绑定
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'skyevent', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'adzd1005', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'SESSION_OPTIONS' =>  array(
		'expire' => 3600 * 24 *30,
	),
);