<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (session('?user')) {
            $user = session('user');
        }else{
            $user['group'] = -1;
        }
        $this->assign('user',$user);
        $Announcement = M("Announcement");
        $datas = $Announcement->limit(5)->order('top desc,time desc')->select();
        $this->assign('announcements',$datas);
        $Event = D('Event');
        $Page = new \Think\Page($Event->count(),6);
        $show = $Page->show();// 分页显示输出
        $event = $Event->limit($Page->firstRow.','.$Page->listRows)->getAll();
        $this->assign('page_event',$show);
        $this->assign('event',$event);
        $this->display();
    }

    public function _empty($id)
    {
        $Announcement = M("Announcement");
        $data = $Announcement->find($id);
        if(IS_AJAX){
            $data['title'] = htmlspecialchars_decode($data['title']);
            $data['title_ch'] = htmlspecialchars_decode($data['title_ch']);
            $data['detail'] = htmlspecialchars_decode($data['detail']);
            $data['detail_ch'] = htmlspecialchars_decode($data['detail_ch']);
            $this->ajaxReturn($data);
        }else{
            if (session('?user')) {
                $user = session('user');
            }else{
                $user['group'] = -1;
            }
            $this->assign('user',$user);
            $this->assign('data',$data);
            $this->display("announcement");
        }
    }

    public function testAPI($data)
    {
    	dump(json_decode(\Org\Net\HttpCurl::get('http://api.vateud.net/members/id/1248613.json'),true));
    }

    public function json()
    {
        $data = array(
        	'zh-cn' => array('所有机组在M503航线 PONEN 至 LELIM 航段向南运行时，实施航路向右6海里的侧向偏置飞行。如无法执行航路偏置，请务必通知管制员！','香港只提供英文管制服务！'),
        	'en-us' => array('All aircraft shall establish a lateral offset at a distance of 6 nautical miles to the west side of M503 while operating from PONEN to LELIM.','In case of aircraft without parallel offset function, pilot shall inform the relevant ATC unit of this situation before joining M503.'),
        );
        echo json_encode($data);
        exit;
    }
    public function testmail()
    {
        dump(think_send_mail("ziheng1719@163.com","Noah Gao","SkyEvent Test Mail2","SkyEvent E-mail 测试2"));
    }
}