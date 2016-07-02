<?php
namespace Home\Model;
use Think\Model;
class EventModel extends Model{
    public function getOne($id)
    {
        $data = $this->find($id);
        foreach ($data as $key => $value) {
        	if(!in_array($key, C('CUSTOM_EVENT_IGNOREJSON'))){
        		$data[$key] = json_decode($value,true);
        	}
        }
        $data['status'] = $this->statusCheck($data['status'],$data['starttime'],$data['endtime'],$data['id']);
        if (!$data['title'][LANG_SET]) {
            $data['title'] = $data['title']['en-us'];
            $data['detail'] = $data['detail']['en-us'];
            $data['notams'] = $data['notams']['en-us'];
        }else{
            $data['title'] = $data['title'][LANG_SET];
            $data['detail'] = $data['detail'][LANG_SET];
            $data['notams'] = $data['notams'][LANG_SET];
        }
        $data['starttime'] = $this->converttime($data['starttime']);
        $data['endtime'] = $this->converttime($data['endtime']);
        $data['author'] = D("User")->getFullname($data['author']);
        return $data;
    }

    public function getAll()
    {
        $datas = $this->order('status desc,starttime asc')->where('status != 1')->select();
        foreach ($datas as $k => $data) {
        	$statusflaq = $this->statusCheck($data['status'],$data['starttime'],$data['endtime'],$data['id']);
        	if($statusflaq != false){
        		$datas[$k]['status'] = $statusflaq;
        	}
        }
        if (!$statusflaq) {
        	$datas = $this->order('status desc,starttime desc')->where('status != 1')->select();
        }
        unset($statusflaq);
        foreach ($datas as $k => $data) {
	foreach ($data as $key => $value) {
	        	if(!in_array($key, C('CUSTOM_EVENT_IGNOREJSON'))){
        			$datas[$k][$key] = json_decode($value,true);
        		}
	}
            if (!$datas[$k]['title'][LANG_SET]) {
                $datas[$k]['title'] = $datas[$k]['title']['en-us'];
                $datas[$k]['detail'] = $datas[$k]['detail']['en-us'];
            }else{
	   $datas[$k]['title'] = $datas[$k]['title'][LANG_SET];
	   $datas[$k]['detail'] = $datas[$k]['detail'][LANG_SET];
            }
	$datas[$k]['starttime'] = $this->converttime($data['starttime']);
	$datas[$k]['endtime'] = $this->converttime($data['endtime']);
        }
        return $datas;
    }

    public function adminlist()
    {
    	$datas = $this->order('endtime desc')->field('id,title,type,status,author')->select();
    	foreach ($datas as $k => $data) {
    		$datas[$k]['author'] = D('User')->getFullname($data['author']);
    		$datas[$k]['type'] = L('post_type_'.$data['type']);
    		$datas[$k]['statusid'] = $data['status'];
    		$datas[$k]['status'] = L('event_status_'.$data['status']);
    		$datas[$k]['title'] = json_decode($data['title'],true);
                         if (!$datas[$k]['title'][LANG_SET]){
                            $datas[$k]['title'] = $datas[$k]['title']['en-us'];
                         }else{
                            $datas[$k]['title'] = $datas[$k]['title'][LANG_SET];
                         }
    	}
    	return $datas;
    }

    public function statusCheck($status,$starttime,$endtime,$id=0)
    {
        if($status == 1 || $status == 2){
            return $status;
        }
        $ctime = time();
        if ($ctime > $endtime) {
            $data['status'] = 2;
            if($id!=0){
                $data['id'] = $id;
                $this->save($data);
            }
        }elseif ($ctime < $starttime) {
            $data['status'] = 3;
            if($id!=0){
                $data['id'] = $id;
                $this->save($data);
            }
        }else{
            $data['status'] = 4;
            if($id!=0){
                $data['id'] = $id;
                $this->save($data);
            }
        }
        return $data['status'];
    }

    public function converttime($data=0)
    {
    	date_default_timezone_set('UTC');
    	if (LANG_SET == 'zh-cn') {
    		$res = date('Y年 n月 j日 Hi',$data).'z'.' (';
    		date_default_timezone_set('PRC');
    		$res = $res.date('H:i',$data).' CST)';
    	}else{
    		$res = date('F jS,Y Hi',$data).'z'.' (';
    		date_default_timezone_set('PRC');
    		$res = $res.date('H:i',$data).' CST)';
    	}
    	return $res;
             date_default_timezone_set('UTC');
    }
}