<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function dashborad(){
        #
    }
    public function login()
    {
        if (!$_GET['oauth_verifier']) {
            $res = \Org\Net\HttpCurl::get('http://sso.skyevent.tk/sso/index.php?callback='.$_SERVER['HTTP_HOST'],'json');
            dump($res);
            $res = json_decode($res,true);
            if (!$res) {
                //$this->error(L('error'));
            }else{
                session('vatsimauth',$res);
                header('Location: ' . $res[2]);
                die();
            }
        }else{
            $session = session('vatsimauth');
            $data['key'] = $session[0];
            $data['secret'] = $session[1];
            $data['oauth_verifier'] = $_GET['oauth_verifier'];
            $res = \Org\Net\HttpCurl::post(SSO_URL.'/confirm.php', $data );
            $res = json_decode($res,true);
            $user['id'] = $res['id'];
            $m = M('User');
            unset($data);
            session('vatsimauth',null);
            $data = $m->find();
            if (!$data) {
                $this->confirm();
            }else{
                session('user',$data);
            }
        }
    }
    public function logout()
    {
        session('user',null);
        $this->success(L("s_logout"));
    }

    public function post($id)
    {
        $data = $_POST['data'];
    }

    public function delete($id)
    {
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
    protected function confirm()
    {
        echo "Hello";
        //$this->display();
    }
}