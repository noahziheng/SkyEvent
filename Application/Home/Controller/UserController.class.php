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
                $user = D("User");
                $user = $user->getUser($res);
                session('user',$user);
                $this->success(L('successlogin'));
            }
        }
    }
    public function logout()
    {
        session('user',null);
        $this->success(L("s_logout"));
    }

    public function validate()
    {
        if (!$_POST['cid'] OR !$_POST['pass'] OR !$_POST['repass'] OR !$_POST['email'] OR !$_POST['code']) {
            $this->error(L("emptyuser"));
        }else{
            if ($_POST['pass'] !== $_POST['repass']) {
                $this->error(L("nosame"));
            }
            $code = S("validate_code");
            if (!$code) {
                S("validate_code","VATPRC12138");
                $code = "VATPRC12138";
            }
            if (strtoupper($_POST['code']) !== $code) {
                $this->error(L("wrongcode"));
            }
            $User = M('User');
            $res = $User->find($_POST['cid']);
            if (!$res) {
                $data['id'] = $_POST['cid'];
                $json = \Org\Net\HttpCurl::get('http://api.vateud.net/members/id/'.$data['id'].'.json');
                $data['origin'] = json_decode($json,true);
                if(!$data['origin']){
                    $this->error('Error Code 0');
                }
                $data['email'] = $_POST['email'];
                $data['password'] = md5($_POST['pass']);
                $data['firstname'] = $data['origin']['firstname'];
                $data['lastname'] = $data['origin']['lastname'];
                $data['rating'] = $data['origin']['rating'];
                if ($data['rating'] > 5) {
                    $data['group'] = 3;
                }elseif ($data['rating'] > 1) {
                    $data['group'] = 2;
                }else {
                    $data['group'] = 1;
                }
                $data['country'] = $data['origin']['country'];
                $data['division'] = $data['origin']['division'];
                $data['reg_date'] = $data['origin']['reg_date'];
                $data['region'] = $data['origin']['region'];
                unset($data['origin']);
                S("validate_".$data['id'],$data);
                $this->assign('data',$data);
                $hu['group'] = L('usergroup_'.$data['group']);
                $hu['rating'] = L('rating_'.$data['rating']);
                $this->assign('hu',$hu);
                $this->display();
            }else{
                $this->error(L('userexist'));
            }
        }
    }

    public function confirm()
    {
        $data = S($_POST['data']);
        S($_POST['data'],null);
        $con['code'] = $data['country'];
        $data['country'] = M('countrys')->where($con)->getField('id');
        unset($con);
        $con['name'] = strtolower($data['division']);
        $data['division'] = M('divisions')->where($con)->getField('id');
        $User = D("User");
        $res = $User->data($data)->add();
        if (!$res) {
            $this->error('Error Code 1');
        }else{
            $user = D("User");
            $user = $user->getUser(intval($data['id']));
            session('user',$user);
            $this->success(L('successvalidate'),'/Index/index');
        }
    }
}