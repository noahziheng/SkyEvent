<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
        $user = D('User')->get("1248613");
        if (session('?user')) {
            $user = session('user');
        }else{
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $users = D('User')->getAll();
        $this->assign('users',$users);
        $this->assign('user',$user);
        $this->display();
    }

    public function event()
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

    public function announcement()
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $this->assign('user',$user);
        $datas = M('Announcement')->select();
        $this->assign('datas',$datas);
        $this->display();
    }

    public function editannouncement($id=0)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $Announcement = M("Announcement"); // 实例化User对象
        // 根据表单提交的POST数据创建数据对象
        if($Announcement->create()){
            $user=session("user");
            if($id!=0){
                $Announcement->id=$id;
            }
            $Announcement->user=$user['id'];
            $Announcement->time=time();
            if($Announcement->top=='on'){
                $Announcement->top=1;
            }else{
                $Announcement->top=0;
            }
            if($id!=0){
                $result = $Announcement->save();
            }else{
                $result = $Announcement->add();
            }
            if (!$result) {
                $this->error(L('error'));
            }else{
                $this->success(L('success'));
            }
        }else{
            $this->error(L('error'));
        }
    }

    public function delannouncement($id)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $res = M('Announcement')->delete(intval($id));
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function booking($id)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        $this->assign('user',$user);
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $con = array('eid' => $id );
        $flights = M('Booking')->where($con)->order('type asc,pushtime desc')->select();
        date_default_timezone_set('UTC');
        foreach ($flights as $key => $value) {
            if ($value['user']==0) {
                $flights[$key]['user'] = L('unbooked');
                $flights[$key]['usermark'] = 0;
            }else{
                $flights[$key]['user'] = D('User')->getFullname($value['user']);
                $flights[$key]['usermark'] = 1;
            }
        }
        $event = D('Event')->getOne($id);
        $this->assign('event',$event);
        $this->assign('flights',$flights);
        $this->assign('eid',$id);
        $this->display();
    }

    public function bookingimport($eid)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if (!token_ident(1)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $filename = $_FILES['file']['tmp_name'];
        if (empty ($filename)) {
            $this->error(L('error'));
        }
        $handle = fopen($filename, 'r');
        $result = \input_csv($handle); //解析csv
        $len_result = count($result);
        if($len_result==0){
            $this->error('没有任何数据！');
        }
        date_default_timezone_set('UTC');
        foreach ($result as $key => $r) {
            $data['user'] = 0;
            $data['eid'] = $eid;
            $data['type'] = 0;
            $data['callsign'] = $r[0];
            $data['dep'] = $r[1]=='*' ? $data['dep'] : $r[1];
            $data['arr'] = $r[2]=='*' ? $data['arr'] : $r[2];
            $data['route'] = $r[3]=='*' ? $data['route'] : $r[3];
            $data['time'] = substr($r[4],0,4).'-'.substr($r[4],4,2).'-'.substr($r[4],6,2).' '.substr($r[4],8,2).":".substr($r[4],8,2).":00";
            $data['info'] = json_encode($data['info']);
            $data['pushtime'] = strtotime($data['time']);
            $res = M('Booking')->add($data);
            if (!$res) {
                fclose($handle); //关闭指针
                $this->error(L('error'));
            }
        }
        fclose($handle); //关闭指针
        $this->success(L('success'));
    }

    public function bookingexport($eid)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if (!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $Booking = M('Booking');
        $res = $Booking->where('eid='.$eid)->select();
        if (!$res) {
            $this->error(L('error'));
        }
        $str='';
        foreach ($res as $key => &$r) {
            date_default_timezone_set('UTC');
            $r['time'] = date('YmdHi',$r['pushtime']);
            if ($r['user']!=0) {
                $r['user'] = $r['user'].','.D('User')->getFullname($r['user']);
                $str = $str.$r['callsign'].','.$r['dep'].','.$r['arr'].','.$r['route'].','.$r['time'].','.$r['user']."\n";
            }
        }
        $filename = 'event'.$eid.'.csv'; //设置文件名
        export_csv($filename,$str); //导出
    }
}