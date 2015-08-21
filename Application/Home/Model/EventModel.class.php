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
        $data['title'] = $data['title'][LANG_SET];
        $data['detail'] = $data['detail'][LANG_SET];
        $data['starttime'] = $this->converttime($data['starttime']);
        $data['endtime'] = $this->converttime($data['endtime']);
        $airports = M('airports');
        foreach ($data['airports'] as $key => $value) {
        	$res = $airports->find($value);
        	$res['name'] = json_decode($res['name'],true);
        	$res['name'] = $res['name'][LANG_SET];
        	$res['remark'] = json_decode($res['remark'],true);
        	$res['remark'] = $res['remark'][LANG_SET];
        	$res['scenery'] = json_decode($res['scenery'],true);
        	$data['airports'][$key] = $res;
        } 
        $user = M('User')->field('firstname,lastname')->find($data['author']);
        $data['author'] = $user['firstname'] + " " + $user['lastname'];
        $countrys= M('countrys');
        foreach ($data['country'] as $key => $value) {
        	$res = $countrys->find($value);
        	$res['charts'] = json_decode($res['charts'],true);
        	$data['country'][$key] = $res;
        }
        $divisions= M('divisions');
        foreach ($data['divisions'] as $key => $value) {
        	$res = $divisions->find($value);
        	$data['divisions'][$key] = $res;
        }
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
	$datas[$k]['title'] = $datas[$k]['title'][LANG_SET];
	$datas[$k]['detail'] = $datas[$k]['detail'][LANG_SET];
	$datas[$k]['starttime'] = $this->converttime($data['starttime']);
	$datas[$k]['endtime'] = $this->converttime($data['endtime']);
	$countrys= M('countrys');
        	foreach ($datas[$k]['country'] as $key => $value) {
        		$res = $countrys->where('id='.$value)->getField('code');
        		$datas[$k]['country'][$key] = $res;
        	}
        }
        return $datas;
    }

    public function adminlist()
    {
    	$datas = $this->order('endtime asc')->field('id,title,type,status,country,author')->select();
    	foreach ($datas as $k => $data) {
    		$countrys= M('countrys');
    		$datas[$k]['country'] = json_decode($data['country'],true);
    		foreach ($datas[$k]['country'] as $key => $value) {
    			$res = $countrys->where('id='.$value)->getField('code');
        			$datas[$k]['country'][$key] = $res;
    		}
    		$user = M('User')->field('firstname,lastname')->find(intval($data['author']));
    		$datas[$k]['author'] = $user['firstname']." ".$user['lastname'];
    		$datas[$k]['type'] = L('post_type_'.$data['type']);
    		$datas[$k]['statusid'] = $data['status'];
    		$datas[$k]['status'] = L('event_status_'.$data['status']);
    		$datas[$k]['title'] = json_decode($data['title'],true);
    		$datas[$k]['title'] = $datas[$k]['title'][LANG_SET];
    	}
    	return $datas;
    }

    private function statusCheck($status,$starttime,$endtime,$id)
    {
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