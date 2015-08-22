<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
        if (!session('?user')) {
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error("Bad Request!");
        }
        $users = D('User')->getAll();
        $this->assign('users',$users);
        $this->assign('user',$user);
        $this->display();
    }
    public function usergroup(){
        if (!session('?user') OR !IS_POST) {
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
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
            $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
        }
        $user = session('user');
        if ($user['group'] < 1) {
            $this->error("Bad Request!");
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
}