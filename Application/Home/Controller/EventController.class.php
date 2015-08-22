<?php
namespace Home\Controller;
use Think\Controller;
class EventController extends Controller {
    public function index(){
    	$this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
    }
    public function view($id){
    	$this->assign('user',session('user'));
    	$event = D('Event')->getOne($id);
    	$this->assign('event',$event);
    	$this->display();
    }
    public function post()
    {
    	if (!session('?user') OR !IS_AJAX) {
    		$this->error("Bad Request!");
    	}
    	$user = session('user');
    	if ($user['group'] < 1) {
    		$this->error("Bad Request!");
    	}
    	$this->assign('user',$user);
    	$this->display();
    }

    public function edit($id)
    {
    	if (!session('?user') OR !IS_AJAX) {
    		$this->error("Bad Request!");
    	}
    	$user = session('user');
    	if ($user['group'] < 1) {
    		$this->error("Bad Request!");
    	}
    	if (!IS_POST) {
    		date_default_timezone_set('UTC');
	    	$event = M("Event")->find($id);
	    	$event['title'] = json_decode($event['title'],true);
	    	$event['detail'] = json_decode($event['detail'],true);
	    	$event['route'] = json_decode($event['route'],true);
    		$event['charts'] = json_decode($event['charts']);
	    	$this->assign('event',$event);
	    	$this->assign('id',$id);
	    	$this->display();
    	}else{
    		$data = $_POST;
    		$tmp['title']['zh-cn'] = \_strip_tags($data['title']['cn']);
    		$tmp['title']['en-us'] = \_strip_tags($data['title']['us']);
    		$tmp['detail']['zh-cn'] = \_strip_tags($data['detail']['cn']);
    		$tmp['detail']['en-us'] = \_strip_tags($data['detail']['us']);
    		$data['title'] = json_encode($tmp['title']);
    		$data['detail'] = json_encode($tmp['detail']);
    		$res = M('Event')->save($data);
    		if(!$res){
    			echo 1;
    		}else{
    			echo 0;
    		}
    	}
    }

    public function delete($id)
    {
    	if (!session('?user') OR !IS_AJAX) {
    		$this->error('Bad Request');
    	}
    	$user = session('user');
    	if ($user['group'] < 1) {
    		$this->error("Bad Request!");
    	}
    	$res = M('Event')->delete(intval($id));
    	if (!$res) {
    		echo 1;
    	}else{
    		echo 0;
    	}
    }

    public function calendar()
    {
    	# code...
    }

    public function submit()
    {
    	if (!session('?user') OR !IS_POST) {
    		$this->error('Bad Request');
    	}
    	$user = session('user');
    	if ($user['group'] < 1) {
    		$this->error("Bad Request!");
    	}
    	$data = $_POST;
    	$tmp['title']['zh-cn'] = \_strip_tags($data['title']['cn']);
    	$tmp['title']['en-us'] = \_strip_tags($data['title']['us']);
    	$tmp['detail']['zh-cn'] = \_strip_tags($data['detail']['cn']);
    	$tmp['detail']['en-us'] = \_strip_tags($data['detail']['us']);
    	$data['title'] = json_encode($tmp['title']);
    	$data['detail'] = json_encode($tmp['detail']);
    	$data['author'] = $user['id'];
    	$res = M('Event')->add($data);
    	if(!$res){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }

    public function admin()
    {
    	if (!session('?user') OR !IS_AJAX) {
    		$this->error("Bad Request!");
    	}
    	$user = session('user');
    	if ($user['group'] < 1) {
    		$this->error("Bad Request!");
    	}
    	$this->assign('user',$user);
    	$events = D('Event')->adminlist();
    	$this->assign('events',$events);
    	$this->display();
    }

    public function publish($id)
    {
    	$event = M('Event');
    	$time = $event->field('starttime,endtime')->find($id);
    	$ctime = time();
    	if ($ctime > $time['endtime']) {
    		$data = array('status' => 2);
    	}elseif ($ctime < $time['starttime']) {
    		$data = array('status' => 3);
    	}else{
    		$data = array('status' => 4);
    	}
    	$res = $event->where('id='.$id)->data($data)->save($data);
    	if (!$res) {
    		$this->error(L('error'));
    	}else{
    		$this->success(L('success'));
    	}
    }
    public function unpublish($id)
    {
    	$data = array('status' => 1);
    	$res = M('Event')->where('id='.$id)->data($data)->save($data);
    	if (!$res) {
    		$this->error(L('error'));
    	}else{
    		$this->success(L('success'));
    	}
    }
}