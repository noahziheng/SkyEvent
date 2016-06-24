<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function dashborad(){
        #
    }
    public function login($id)
    {
        $user = D('User')->get($id);
        if (!$user) {
            $this->error(L('nologin'),SSO_URL);
        }else{
            session('user',$user);
            $this->success(L("successlogin"),ROOT_URL);
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
}