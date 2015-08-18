<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function dashborad(){
        #
    }
    public function login()
    {
        if (!$_POST['cid'] OR !$_POST['pass']) {
            $this->error(L("emptyuser"));
        }else{
            $User = D("User");
            $cond = array('id' => $_POST['cid'] , 'password' => md5($_POST['pass']));
            $res = $User->where($cond)->getField('id');
            if (!$res) {
                $this->error(L("nouser"));
            }else{
                session('user',$res);
                $this->success(L('successlogin'));
            }
        }
    }
    public function logout()
    {
        #
    }
}