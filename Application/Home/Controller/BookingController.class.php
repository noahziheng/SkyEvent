<?php
namespace Home\Controller;
use Think\Controller;
class BookingController extends Controller {
    public function index(){
        if (!token_ident(1)) {
            $this->error(L('nopermission'),'Index/index');
        }
    }
}