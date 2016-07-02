<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

/**
* 获取环境变量
* @param $key
* @param null $default
* @return null|string
*/
function env($key, $default = null)
{
  $value = getenv($key);
  if ($value === false) {
    return $default;
  }
  return $value;
}
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('VERSION', '1.1 Alpha');
define('BUILDTAG', '20160624build1');
define('ROOT_URL', 'http://skyevent.tk/');
define('APP_DEBUG',False);
define('SSO_URL', 'http://sso.skyevent.tk/?callback='.ROOT_URL.'User/login/');
define('USER_EXPIRES', 3600 * 24 *30);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单