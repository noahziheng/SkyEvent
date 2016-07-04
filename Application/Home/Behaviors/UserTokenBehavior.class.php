<?php
namespace Home\Behaviors;
/**
 * 令牌检测 并自动更新用户数据
 */
class UserTokenBehavior extends \Think\Behavior {

    private $user;

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        if(APP_ENV=='release'){
            C('THINK_EMAIL',array(
                'SMTP_HOST'   => 'hwsmtp.exmail.qq.com', //SMTP服务器
                'SMTP_PORT'   => '465', //SMTP服务器端口
                'SMTP_USER'   => 'noreply@noahgao.net', //SMTP服务器用户名
                'SMTP_PASS'   => 'VATprc12138', //SMTP服务器密码
            ));
        }else{
            C('REDIS_HOST','45.32.20.78');
        }
        // 检测令牌
        $res=$this->checkToken();
        if(!$res){
            session("user",$this->user);
        }
    }

    /**
     * 令牌检查
     * @access private
     * @return void
     */
    private function checkToken() {
        if(session("?user")){
            $session = session("user");
            $this->user = D('User')->get($session["id"]);
            if($session["token"]!=$this->user["token"]){
                return false;
            }
        }
        return true;
    }
}
