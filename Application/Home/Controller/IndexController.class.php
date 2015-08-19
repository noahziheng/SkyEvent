<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if (session('?user')) {
    		$uid = session('user');
	    	$user = D("User");
	    	$user = $user->getUser(intval($uid));
    	}else{
    		$user['group'] = -1;
    	}
    	$this->assign('user',$user);
    	$announce = M("Announcement")->select();
    	foreach ($announce as $key => $a) {
    		$a['content'] = json_decode($a['content'],true);
    		foreach ($a['content'] as $k => $value) {
    			if ($k == LANG_SET) {
    				$a['content'] = $value;
    				break;
    			}
    		}
    		$announce[$key] = $a;
    	}
    	$this->assign('announce',$announce);
    	$event = D('Event')->getAll();
    	$this->assign('event',$event);
    	$this->display();
    }
    public function password($pass)
    {
	echo md5($pass);
    }
    public function testAPI($data)
    {
    	dump(json_decode(\Org\Net\HttpCurl::get('http://api.vateud.net/members/id/1248613.json'),true));
    }
    public function json()
    {
    	$data = array(
    		'zh-cn' => '本周环中国我们将飞向中国最南端旅游城市鹿城三亚！',
    		'en-us' => 'Have you participated our "Tour of China 2014" event last year? VATPRC is pround to announce "Tour of China 2015" this year. During the four months, we will take you around China and show you the diverse landscapes of the country.

This week, we will continue our tour to Sanya, the southern most tourist city of China. Come and fly with us on this Saturday, August 22nd, with full ATC coverage at both airports. We are looking forward to seeing you on the scope!',
    	);
    	echo json_encode($data);
    }
}