<?php
namespace Home\Behaviors;
/**
 * 令牌检测 并自动更新用户数据
 */
class UserTokenBehavior extends \Think\Behavior {

    private $user;

    // 行为扩展的执行入口必须是run
    public function run(&$params){
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
