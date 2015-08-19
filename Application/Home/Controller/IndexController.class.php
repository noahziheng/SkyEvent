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
    		$a['content'] = json_decode($a['content']);
    		foreach ($a['content'] as $k => $value) {
    			if ($k == LANG_SET) {
    				$a['content'] = $value;
    				break;
    			}
    		}
    		$announce[$key] = $a;
    	}
    	$this->assign('announce',$announce);
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
    	$data[0] = array(
    		'name' => "eAIP People's Republic of China",
    		'href' => 'http://www.eaipchina.cn',
    		'remark' => '(AIP -> AD)'
    	);
    	echo json_encode($data);
    }
}