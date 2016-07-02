<?php
namespace Home\Controller;
use Think\Controller;
class BookingController extends Controller {
    public function _empty($name)
    {
        $eid=$name;
        if ($eid == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if (!token_ident(1)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $event = D('Event')->getOne($eid);
        if ($event['status'] == 2) {
            $this->error(L('event_outdate'));
        }
        $con = array('eid' => $eid );
        $bookings = M('Booking')->where($con)->order('pushtime asc')->select();
        date_default_timezone_set('UTC');
        $con = array('eid' => $eid,'user' => $user['id']);
        $booked = M('Booking')->where($con)->field('id,callsign')->find();
        foreach ($bookings as $key => $value) {
            if ($value['user']==0) {
                $bookings[$key]['user'] = L('unbooked');
                $bookings[$key]['usermark'] = 0;
            }else{
                $bookings[$key]['user'] = \getUserFullname($value['user']);
                $bookings[$key]['usermark'] = 1;
            }
            $bookings[$key]['pushtime'] = \timeformat($value['pushtime']);
            $bookings[$key]['time'] = \timeformat($value['pushtime']);
        }
        $this->assign('bookings',$bookings);
        $this->assign('booked',$booked);
        $this->assign('type',$type);
        $this->assign('event',$event);
        $this->display('list');
    }

    public function view($id)
    {
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if (!token_ident(1)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $Booking=M('Booking');
        $booking=$Booking->find($id);
        $userall=S("user-".$booking['user']);
        $userall['group']=D('User')->getUserGroup($userall['id']);
        $this->assign('booking',$booking);
        $this->assign('userall',$userall);
        $this->display();
    }

    public function submit($id=0)
    {
        $admin=isset($_GET[1]) ? $_GET[1] : 1 ;
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if($admin==0){
            $ident=3;
        }else{
            $ident=1;
        }
        if (!token_ident($ident)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $Booking=M('Booking');
        if($Booking->create()){
            $data['eid'] = $id;
            $data['user'] = $user['id'];
            if($admin==0){
                $Booking->user=0;
                $Booking->type=0;
            }else{
                $Booking->user=$data['user'];
                $Booking->type=1;
            }
            date_default_timezone_set('UTC');
            $Booking->pushtime = strtotime($Booking->pushtime);
            $Booking->eid=$data['eid'];
            $res = $Booking->add();
            if (!$res) {
                $this->error(L('error'),'',100000);
            }else{
                if($admin!=0){
                    $con['eid'] = $data['eid'];
                    $con['user'] = $data['user'];
                    $bid=$Booking->field('id')->where($con)->find();
                    $this->email($bid['id']);
                }
                $this->success(L('success'),'',100000);
            }
        }else{
            $this->error(L('error'),'',100000);
        }
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
        $Booking = M('Booking');
        $data = $Booking->find($id);
        if (!token_ident(1)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        if($data['type']==0 && $data['user'] != $user['id']){
          $Booking->user=$user['id'];
          $res = $Booking->save();
        }else{
          $res = false;
        }
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->email($id);
            $this->success(L('success'));
        }
    }

    public function cancel($id=0,$admin=-1)
    {
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        $Booking = M('Booking');
        $data = $Booking->find($id);
        if($admin!=-1){
            $ident=3;
        }else{
            $ident=1;
        }
        if (!token_ident($ident) || $data['user'] != $user['id']) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        if($admin==-1){
            $this->email($id,true);
        }
        if($data['type']==0){
          $Booking->user=0;
          $res = $Booking->save();
        }else{
          $res = $Booking->delete();
        }
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function delete($id=0)
    {
        if ($id == 0) {
            $this->error("Bad Request!");
        }
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $Booking = M('Booking');
        $res = $Booking->delete($id);
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    private function email($id,$cancel=false)
    {
        $booking=M("Booking")->find($id);
        $user=D('User')->get($booking['user']);
        $booking['title'] = \getEventTitle($booking['eid']);
        $data[]=$booking['title'];
        $data[]=L('booking_type_'.$booking['type']);
        $data[]=$booking['callsign'];
        $data[]=$booking['dep'];
        $data[]=$booking['arr'];
        $data[]=$booking['route'];
        $data[]=\timeformat($booking['pushtime']);
        if(!$cancel){
            $data[]=\getUserFullname($booking['user']);
            $data[]=L('rating_'.$user['rating']);
        }else{
            $user = session('user');
            $data[]=\getUserFullname($user['id']);
            $data[]={:L('usergroup_'.$user['group'])};
        }
        $r=\send_mail($user,$cancel ? 'booking_cancel' : 'booking',$data);
    }
}