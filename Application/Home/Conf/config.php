<?php
return array(
	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES'=>array(
		'event/:id\d' => array('Event/view', '' , array('method'=>'get')),
		'event/:id\d' => array('Event/post', '' , array('method'=>'post')),
		'event/:id\d' => array('Event/edit', '' , array('method'=>'put')),
		'event/:id\d/:token' => array('Event/delete', '' , array('method'=>'delete')),
		'api/event/:id\d' =>  array('Event/view' , 'type=json' , array('method'=>'get')),
		'api/event/:id\d' => array('Event/post', 'type=json' , array('method'=>'post')),
		'api/event/:id\d' => array('Event/edit', 'type=json' , array('method'=>'put')),
		'api/event/:id\d/:token' => array('Event/delete', 'type=json' , array('method'=>'delete')),
	),
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
);