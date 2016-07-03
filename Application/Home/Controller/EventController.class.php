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
        $this->assign('event',$event);
        $tmp=$event['controllers'];
        $booked=false;
        foreach ($tmp as $k => $t) {
            if($t[1]==$user['id']){
                $booked=array();
                $booked['id']=$k;
                $booked['callsign']=$t[0];
                $booked['user']=$t[1];
            }
        }
        $this->assign('booked',$booked);
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
            $tmp = json_decode($event['notams']);
            $event['notams']=array();
            foreach ($tmp as $key => $value) {
                foreach ($value as $v) {
                    $t[]=$v;
                    $t[]=$key;
                    $event['notams'][]=$t;
                    unset($t);
                }
            }
            $event['controllers'] = json_decode($event['controllers']);
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
        $Event = D('Event');
        $data = $_POST;
        $data['status'] = $Event->statusCheck(5,$data['starttime'],$data['endtime'],$data['id']);
        $tmp['title']['zh-cn'] = \_strip_tags($data['title']['cn']);
        $tmp['title']['en-us'] = \_strip_tags($data['title']['us']);
        $tmp['detail']['zh-cn'] = \_strip_tags($data['detail']['cn']);
        $tmp['detail']['en-us'] = \_strip_tags($data['detail']['us']);
        $data['title'] = json_encode($tmp['title']);
        $data['detail'] = json_encode($tmp['detail']);
        $tmp = json_decode($data['notams']);
        $data['notams'] = array();
        $data['controllers'] = \_strip_tags($data['controllers']);
        foreach ($tmp as $t) {
            $k=$t[1];
            $data['notams'][$k][]=$t[0];
        }
        $data['notams'] = json_encode($data['notams']);
        if ($id !== '0') {
            $con['id'] = $id;
            $res = M('Event')->where($con)->save($data);
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

    public function route($eid,$rid)
    {
        $data = M('Event')->field('route')->find($eid);
        $data = json_decode($data['route']);
        $data = $data[$rid];
        $arr=explode(' - ', $data[0]);
        $data=array(
            'dep' => $arr[0],
            'arr' => $arr[1],
            'route' => $data[1]
        );
        $this->ajaxReturn($data);
    }

    public function delete($id)
    {
        if (!session('?user')) {
            $this->error('Bad Request');
        }
        $user = session('user');
        if (!token_ident(3)) {
            $this->error("Bad Request!");
        }
        $res = M('Event')->delete(intval($id));
        if (!$res) {
            echo 1;
        }else{
            echo 0;
        }
    }

    public function publish($id)
    {
        $event = D('Event');
        $time = $event->field('status,starttime,endtime')->find($id);
        dump($time);
        if ($time['status'] == 1) {
            $res = $event->statusCheck(5,$time['starttime'],$time['endtime'],$id);
        }else{
            $data = array('id'=>$id,'status' => 1);
            $res = M('Event')->save($data);
        }
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function controller($id,$bid)
    {
        if (!session('?user')) {
            $this->error('Bad Request');
        }
        $user = session('user');
        if (!token_ident(2)) {
            $this->error("Bad Request!");
        }
        $res = M('Event')->field('controllers')->find(intval($id));
        if (!$res) {
            $this->error(L('error'));
        }else{
            $tmp = json_decode($res['controllers']);
            $booking = $tmp[$bid];
            if($booking[1]=='0'){
                $booking[1]=$user['id'];
            }else{
                if($booking[1]==$user['id']){
                    $booking[1]='0';
                }else{
                    $this->error(L('error'));
                }
            }
            $tmp[$bid] = $booking;
            $data['controllers'] = json_encode($tmp);
            $con['id']=$id;
            $res = M('Event')->where($con)->save($data);
        }
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'),ROOT_URL.'Event/view/'.$id);
        }
    }
}