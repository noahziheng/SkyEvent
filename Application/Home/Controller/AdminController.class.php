<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $users = D('User')->getAll();
        $this->assign('users',$users);
        $this->assign('user',$user);
        $this->display();
    }
    public function useredit(){
        if (!IS_POST) {
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
        }
        if (!session('?user')) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error("Bad Request!");
        }
        $data=$_POST;
        $res = M('User')->save($data);
        if (!$res) {
            echo 1;
        }else{
            echo 0;
        }
    }

    public function userdel($id){
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $res = M('User')->where('id='.$id)->delete();
        if (!$res) {
            echo 1;
        }else{
            echo 0;
        }
    }

    public function validatecode($code)
    {
        F("validate_code",$code);
        $this->show('<div class="alert alert-success" role="alert">Success !</div>','utf-8');
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
        $con = array('type' => 1, 'eid' => $id );
        $flights = M('Booking')->where($con)->order('id asc')->select();
        $con['type'] = 2;
        $controllers = M('Booking')->where($con)->order('custom asc,id asc')->select();
        date_default_timezone_set('UTC');
        foreach ($flights as $key => $value) {
            if ($value['user']==0) {
                $flights[$key]['user'] = L('unbooked');
                $flights[$key]['usermark'] = 0;
            }else{
                $flights[$key]['user'] = D('User')->getFullname($value['user']);
                $flights[$key]['usermark'] = 1;
            }
            $flights[$key]['info'] = json_decode($value['info'],true);
            $flights[$key]['time'] = date('Hi',$value['time']).'z';
        }
        foreach ($controllers as $key => $value) {
            if ($value['user']==0) {
                $controllers[$key]['user'] = L('unbooked');
                $controllers[$key]['usermark'] = 0;
            }else{
                $controllers[$key]['user'] = D('User')->getFullname($value['user']);
                $controllers[$key]['usermark'] = 1;
            }
            $controllers[$key]['info'] = json_decode($value['info'],true);
            $controllers[$key]['time'] = date('Hi',$value['time']).'z';
        }
        $this->assign('flights',$flights);
        $this->assign('eid',$id);
        $this->assign('controllers',$controllers);
        $this->display();
    }

    public function bookingadd($type,$eid)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        date_default_timezone_set('UTC');
        $data['callsign'] = $_POST['callsign'];
        if ($type == '1') {
            $data['info']['airport'] = $_POST['airport'];
            $data['info']['route'] = $_POST['route'];
        }else{
            $data['info']['name'] = $_POST['name'];
            $data['custom'] = $_POST['custom'];
        }
        $data['info'] = json_encode($data['info']);
        $data['time'] = "2015-01-01 ".substr($_POST['time'],0,2).":".substr($_POST['time'],2,2).":00";
        $data['time'] = strtotime($data['time']);
        $data['user'] = 0;
        $data['eid'] = $eid;
        $res = M('Booking')->add($data);
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function bookingclean($id)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
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

    public function bookingdel($id)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $res = M('Booking')->where('id='.$id)->delete();
        if (!$res) {
            $this->error(L('error'));
        }else{
            $this->success(L('success'));
        }
    }

    public function bookingimport($type,$eid)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
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
        foreach ($result as $key => $r) {
            $data['user'] = 0;
            $data['eid'] = $eid;
            $data['type'] = $type;
            $data['callsign'] = $r[0];
            if ($type == '1') {
                $data['info']['airport'] = $r[1];
                $data['info']['route'] = $r[2];
                $data['time'] = "2015-01-01 ".substr($r[3],0,2).":".substr($r[3],2,2).":00";
            }else{
                $data['info']['name'] = $r[1];
                $data['time'] = "2015-01-01 ".substr($r[2],0,2).":".substr($r[2],2,2).":00";
                $data['custom'] = $r[3];
            }
            $data['info'] = json_encode($data['info']);
            $data['time'] = strtotime($data['time']);
            $res = M('Booking')->add($data);
            unset($data);
            if (!$res) {
                fclose($handle); //关闭指针
                $this->error(L('error'));
            }
        }
        fclose($handle); //关闭指针 
        $this->success(L('success'));
    }

    public function bookingexport($type,$eid)
    {
        if (!session('?user')) {
            $this->error(L('nologin'),ROOT_URL.'Index/index');
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $con['eid'] = $eid;
        $con['type'] = $type;
        $res = M('Booking')->where($con)->field('callsign,info,time,user')->select();
        if (!$res) {
            $this->error(L('error'));
        }
        $str='';
        foreach ($res as $key => $r) {
            $r['info'] = json_decode($r['info'],true);
            if ($type=='1') {
                $r['info'] = $r['info']['airport'].','.$r['info']['route'];
            }else{
                $r['info'] = $r['info']['name'];
            }
            $r['time'] = date('Hi',$r['time']);
            if ($r['user']==0) {
                $r['user'] = "";
            }else{
                $r['user'] = ','.D('User')->getFullname($r['user']);
            }
            $str = $str.$r['callsign'].','.$r['info'].','.$r['time'].$r['user']."\n";
        }
        if ($type=='1') {
            $type="flights";
        }else{
            $type="controllers";
        }
        $filename = 'event'.$eid.$type.'.csv'; //设置文件名 
        export_csv($filename,$str); //导出
    }
}