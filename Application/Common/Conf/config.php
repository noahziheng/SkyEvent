<?php
return array(
	// 关闭多模块访问
	'MULTI_MODULE'          =>  false,
	'DEFAULT_MODULE'        =>  'Home',
	'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
	'URL_PARAMS_BIND_TYPE'  =>  1, // 设置参数绑定按照变量顺序绑定
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'db', // 服务器地址
	'DB_NAME'   => 'skyevent', // 数据库名
	'DB_USER'   => 'skyevent', // 用户名
	'DB_PWD'    => 'vatprc12138', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'SESSION_OPTIONS' =>  array(
		'expire' => USER_EXPIRES,
	),
	//邮件配置
	'THINK_EMAIL' => array(
		'SMTP_HOST'   => 'smtp.exmail.qq.com', //SMTP服务器
		'SMTP_PORT'   => '465', //SMTP服务器端口
		'SMTP_USER'   => 'noreply@noahgao.net', //SMTP服务器用户名
		'SMTP_PASS'   => 'VATprc12138', //SMTP服务器密码
	),
);
