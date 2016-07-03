<?php
return array(
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
	'CUSTOM_EVENT_IGNOREJSON' => array('id' , 'starttime' , 'endtime' , 'banner' , 'type' , 'status'),
	'DATA_CACHE_TYPE'       =>  'Redis',
	'REDIS_HOST' => '216.189.52.222',
	'LAYOUT_ON'=>true,
	'LAYOUT_NAME'=>'layout',
	//'SHOW_PAGE_TRACE' =>true,
	'EMAIL_TPL' => array(
		'usercheck' => array(
			'zh-cn' => array(
				0 => "SkyEvent 电子邮件验证",
				1 => "尊敬的\$USERNAME (\$ID):<br><br>欢迎您加入SkyEvent请点击或复制下面的连接到地址栏打开以验证您的邮件地址。<br><a href=\"".ROOT_URL."User/emailcheck/$1\">".ROOT_URL."User/emailcheck/$1</a><br>感谢您的配合！<br>",
			),
			'en-us' => array(
				0 => "SkyEvent E-mail Check",
				1 => "Hi \$USERNAME (\$ID):<br><br>Welcome to SkyEvent,Please click or copy this link to your browser for vaildate your email.<br><a href=\"".ROOT_URL."User/emailcheck/$1\">".ROOT_URL."User/emailcheck/$1</a><br>Thanks for co-op!<br>",
			),
		),
		'booking' => array(
			'zh-cn' => array(
				0 => '【SkyEvent Booking】您已预约新的航班',
				1 => '<p>尊敬的 $USERNAME ($ID):</p><p>我们收到您提交的如下活动预约信息，现与您进行确认：</p><br>活动：$1<br>预约类型：$2<br>预约呼号：$3<br>出发机场（ICAO）：$4<br>到达机场（ICAO）：$5<br>航路：$6<br>推开时间：$7<br>用户姓名：$8<br>用户VATSIM等级：$9<br><br><p>如不能参与活动请登陆SkyEvent个人中心及时取消！</p><p>如有其他疑问请联系开发者Email:noahgaocn@gmail.com</p>',
			),
			'en-us' => array(
				0 => '【SkyEvent Booking】You have a new booking',
				1 => '<p>Hi $USERNAME ($ID),</p><p>We receive your apply for a event,please check it now:</p><br>Event : $1<br>Type : $2<br>Callsign : $3<br>Depature (ICAO) : $4<br>Arrival (ICAO)  : $5<br>Route : $6<br>Push TIme : $7<br>User Name : $8<br>User\'s VATSIM Rating : $9<br><br><p>Please sign in SkyEvent Dashboard to cancel if you can\'t join this event!</p><p>You can contact me by Email(noahgaocn@gmail.com) if you need.</p>',
			),
		),
		'booking_cancel' => array(
			'zh-cn' => array(
				0 => '【SkyEvent Booking】您已预约的航班被取消！',
				1 => '<p>尊敬的 $USERNAME ($ID):</p><p>我们收到一条取消您预约航班的请求，现与您进行确认：</p><br>活动：$1<br>预约类型：$2<br>预约呼号：$3<br>出发机场（ICAO）：$4<br>到达机场（ICAO）：$5<br>航路：$6<br>推开时间：$7<br>操作用户姓名：$8<br>操作用户组：$9<br><br><p>如仍想参加活动可登陆SkyEvent重新预约！</p><p>如有其他疑问请联系开发者Email:noahgaocn@gmail.com</p>',
			),
			'en-us' => array(
				0 => '【SkyEvent Booking】Your booking have been canceled!',
				1 => '<p>Hi $USERNAME ($ID),</p><p>We receive a apply for cancel your booking,please check it:</p><br>Event : $1<br>Type : $2<br>Callsign : $3<br>Depature (ICAO) : $4<br>Arrival (ICAO)  : $5<br>Route : $6<br>Push TIme : $7<br>Adminisator\'s Name : $8<br>Adminisator\'s UserGroup : $9<br><br><p>Please sign in SkyEvent to booking again if you want rejoin this event!</p><p>You can contact me by Email(noahgaocn@gmail.com) if you need.</p>',
			),
		),
	)
);