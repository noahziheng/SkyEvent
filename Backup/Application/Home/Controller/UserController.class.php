<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function dashborad(){
        #
    }
    public function login()
    {
        $res = json_decode(\Org\Net\HttpCurl::post(SSO_URL.'/index.php',array('callback' => U('User/callback','','',true), )),true);
        if (!$res) {
            $this->error(L('error'));
        }else{
            session('vatsimauth',$res);
            header('Location: ' . $res[2]);
            die();
        }
    }
    public function logout()
    {
        session('user',null);
        $this->success(L("s_logout"));
    }

    public function callback()
    {
        $session = session('vatsimauth');
        $data['key'] = $session[0];
        $data['secret'] = $session[1];
        $data['oauth_verifier'] = $_GET['oauth_verifier'];
        $res = \Org\Net\HttpCurl::post(SSO_URL.'/confirm.php', $data );
        $res = json_decode($res,true);
        dump($res);
        $user['id'] = $res['id'];
        $m = M('User')
        unset($data);
        session('vatsimauth',null);
        $data = $m->find();
        if (!$data) {
            $this->display();
        }else{
            session('user',$data);
            $this->success(L('successlogin'));
        }
    }
    public function confirm()
    {
        #
    }
}