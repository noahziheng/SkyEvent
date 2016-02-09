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
        }else{
            $data['title'] = $data['title'][LANG_SET];
            $data['detail'] = $data['detail'][LANG_SET];
        }
        $data['starttime'] = $this->converttime($data['starttime']);
        $data['endtime'] = $this->converttime($data['endtime']);
        $user = M('User')->field('firstname,lastname')->find($data['author']);
        $data['author'] = $user['firstname']." ".$user['lastname'];
        return $data;
    }

    public function getAll($id)
    {
        $datas = $this->order('status desc,starttime asc')->where('status != 1')->select();
        foreach ($datas as $k => $data) {
        	$statusflaq = $this->statusCheck($data['status'],$data['starttime'],$data['endtime'],$data['id']);
        	if($statusflaq != false){
        		$datas[$k]['status'] = $statusflaq;
        	}
        }
        if (!$statusflaq) {
        	$datas = $this->order('status desc,starttime asc')->where('status != 1')->select();
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
    	$datas = $this->order('endtime asc')->field('id,title,type,status,author')->select();
    	foreach ($datas as $k => $data) {
    		$user = M('User')->field('firstname,lastname')->find(intval($data['author']));
    		$datas[$k]['author'] = $user['firstname']." ".$user['lastname'];
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

    public function statusCheck($status,$starttime,$endtime,$id)
    {
    	if($status == 1){
    		return 1;
    	}
    	if($status == 2){
    		return 2;
    	}
    	$ctime = time();
    	if ($ctime > $endtime) {
    		$data['id'] = $id;
    		$data['status'] = 2;
    		$this->save($data);
    		return false;
    	}elseif ($ctime < $starttime) {
    		if ($status == 3) {
    			return 3;
    		}
    		$data['id'] = $id;
    		$data['status'] = 3;
    		$this->save($data);
    		return false;
    	}else{
    		if ($status == 4) {
    			return 4;
    		}
    		$data['id'] = $id;
    		$data['status'] = 4;
    		$this->save($data);
    		return false;
    	}
    }

    private function converttime($data=0)
    {
    	date_default_timezone_set('UTC');
    	if (LANG_SET == 'zh-cn') {
    		$res = date('Y年 n月 j日 l Hi',$data).'z'.' (';
    		date_default_timezone_set('PRC');
    		$res = $res.date('H:i',$data).' CST)';
    	}else{
    		$res = date('l,F jS,Y Hi',$data).'z'.' (';
    		date_default_timezone_set('PRC');
    		$res = $res.date('H:i',$data).' CST)';
    	}
    	return $res;
    }
}