<?php
namespace Home\Controller;
use Think\Controller;
class EventController extends Controller {
    public function index(){
    	$this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
    }
    public function view($id){
    	$event = D('Event')->getOne($id);
    	$this->assign('event',$event);
    	$this->display();
    }
    public function post()
    {
    	# code...
    }

    public function edit()
    {
    	# code...
    }

    public function delete()
    {
    	# code...
    }

    public function eventlist()
    {
    	# code...
    }

    public function calendar()
    {
    	# code...
    }
}