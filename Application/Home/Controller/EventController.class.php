<?php
namespace Home\Controller;
use Think\Controller;
class EventController extends Controller {
    public function index(){
        $this->show("<span style=\"font-size:48px;\"><strong>Bad Request!</strong></span>");
    }
    public function view(){
    	echo $_GET['id'];
    	echo '<br />';
    	echo $_GET['type'];
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
}