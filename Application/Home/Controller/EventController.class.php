<?php
namespace Home\Controller;
use Think\Controller;
class EventController extends Controller {
    public function index(){
        $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
    }
    public function view($id=0){
        if ($id==0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $user['group'] = -1;
        }else{
            $user = session('user');
        }
        $this->assign('user',$user);
        $event = D('Event')->getOne($id);
        if ($event['status'] == 1 and $user['group'] < 3) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $this->assign('event',$event);
        $this->display();
    }
    public function post($id=0)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $this->assign('user',$user);
        if ($id !== 0) {
            $this->assign('type',1);
            date_default_timezone_set('UTC');
            $event = M("Event")->find($id);
            $event['title'] = json_decode($event['title'],true);
            $event['detail'] = json_decode($event['detail'],true);
            $event['route'] = json_decode($event['route'],true);
            $this->assign('event',$event);
            $this->assign('id',$id);
        }else{
            $this->assign('type',0);
        }
        $this->display();
    }

    public function submit($id)
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
        if ($id !== '0') {
            $data['id'] = $id;
            $res = M('Event')->save($data);
        }else{
            $data['author'] = $user['id'];
            $res = M('Event')->add($data);
        }
        if(!$res){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function delete($id)
    {
        if (!session('?user')) {
            $this->error('Bad Request');
        }
        $user = session('user');
        if ($user['group'] < 3) {
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

    public function admin()
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 3) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $this->assign('user',$user);
        $events = D('Event')->adminlist();
        $this->assign('events',$events);
        $this->display();
    }

    public function publish($id)
    {
        $event = D('Event');
        $time = $event->field('status,starttime,endtime')->find($id);
        if ($time['status'] == 1) {
            $res = $event->statusCheck(5,$time['starttime'],$time['endtime'],$id);
        }else{
            $data = array('status' => 1);
            $res = M('Event')->where('id='.$id)->data($data)->save($data);
        }
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function booking($type=0,$eid=0)
    {
        if ($type == 0 or $eid == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        if ($type != '1' and $type != '2') {
            $this->error("Bad Request!");
        }
        $event = M('Event');
        $event = $event->where('id='.$eid)->field('status,title')->find();
        $event['title'] = json_decode($event['title'],true);
        if (!$event['title'][LANG_SET]) {
            $event['title'] = $event['title']['en-us'];
        }else{
            $event['title'] = $event['title'][LANG_SET];
        }
        if ($event['status'] == 2) {
            $this->error(L('event_outdate'));
        }
        $con = array('type' => $type, 'eid' => $eid );
        $bookings = M('Booking')->where($con)->order('custom asc,id asc')->select();
        date_default_timezone_set('UTC');
        $con = array('eid' => $eid,'user' => $user['id']);
        $booked = M('Booking')->where($con)->field('id,callsign')->find();
        foreach ($bookings as $key => $value) {
            if ($value['user']==0) {
                $bookings[$key]['user'] = L('unbooked');
                $bookings[$key]['usermark'] = 0;
            }else{
                $bookings[$key]['user'] = D('User')->getFullname($value['user']);
                $bookings[$key]['usermark'] = 1;
            }
            $bookings[$key]['info'] = json_decode($value['info'],true);
            $bookings[$key]['time'] = date('Hi',$value['time']).'z';
        }
        $this->assign('bookings',$bookings);
        $this->assign('booked',$booked);
        $this->assign('type',$type);
        $this->assign('event',$event);
        $this->display();
    }

    public function book($id=0)
    {
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $data['id'] = $id;
        $data['user'] = $user['id'];
        $res = M('Booking')->save($data);
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }
    public function cancel($id=0)
    {
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $data['id'] = $id;
        $data['user'] = 0;
        $res = M('Booking')->save($data);
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }
}