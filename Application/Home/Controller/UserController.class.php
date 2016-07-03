<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function dashborad(){
        if (session('?user')) {
            $user = session('user');
        }else{
            $user['group'] = -1;
        }
        $userall=S("user-".$user['id']);
        $this->assign('userall',$userall);
        $this->assign('user',$user);
        $con['user'] = $user['id'];
        $bookings = M('Booking')->where($con)->select();
        $this->assign('bookings',$bookings);
        $this->display();
    }

    public function login($id)
    {
        if (session('?user')) {
            $this->success(L("successlogin"),ROOT_URL);
        }else{
            $user = D('User')->get($id);
            if (!$user) {
                $this->error(L('nologin'),SSO_URL);
            }else{
                if(!$user['email']){
                    $this->assign('user',$user);
                    $this->display();
                }else{
                    session('user',$user);
                    $this->success(L("successlogin"),ROOT_URL);
                }
            }
        }
    }

    public function email($id)
    {
        $token = md5($id.time());
        $data['id'] = $id;
        $data['email'] = $_POST['email'];
        $r=S("tmpmail-".$token,$data);
        $r=true;
        if($r){
            $user=D("User")->get($id);
            $user['email'] = $_POST['email'];
            $r=\send_mail($user,'usercheck',array($token));
        }
        if (!$r) {
            echo 0;
        }else{
            $this->ajaxReturn($token);
        }
    }

    public function emailcheck($token)
    {
        $r=S("tmpmail-".$token);
        $id=$r['id'];
        if($r){
            $r=D('User')->SetUserEmail($r['id'],$r['email']);
        }
        if (!$r) {
            $this->error(L('error'),ROOT_URL);
        }else{
            S("tmpmail-".$token,null);
            session('user',D('User')->get($id));
            $this->error(L('success'),ROOT_URL);
        }
    }

    public function logout()
    {
        session('user',null);
        $this->success(L("s_logout"),ROOT_URL.'Index/index');
    }

    public function usergroup(){
        if (!IS_POST) {
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
        }
        if (!session('?user')||!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $data=$_POST;
        dump($data);
        $res = D('User')->setUserGroup($data['id'],$data['group']);
        if ($data['ajax']==1) {
            if (!$res) {
                echo 1;
            }else{
                echo 0;
            }
        }else{
            if (!$res) {
                $this->error(L('error'),ROOT_URL.'Admin/index');
            }else{
                $this->success(L('success'),ROOT_URL.'Admin/index',1000000);
            }
        }
    }

    public function userdel()
    {
        if (!IS_POST) {
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
        }
        if (!session('?user')||!token_ident(3)) {
            $this->error(L('nopermission'),ROOT_URL.'Index/index');
        }
        $data=$_POST;
        $res = D('User')->delUserGroup($data['id']);
        if ($data['ajax']==1) {
            if (!$res) {
                echo 1;
            }else{
                echo 0;
            }
        }else{
            if (!$res) {
                $this->error(L('error'),ROOT_URL.'Admin/index');
            }else{
                $this->success(L('success'),ROOT_URL.'Admin/index');
            }
        }
    }
}