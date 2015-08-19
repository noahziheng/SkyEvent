<?php
namespace Home\Model;
use Think\Model;
class EventModel extends Model{
    public function getOne($id)
    {
        $data = $this->find($id);
        foreach ($data as $key => $value) {
        	if ($key != 'id' and $key != 'starttime' and $key != 'endtime' and $key != 'banner') {
        		$data[$key] = json_decode($value,true);
        	}
        }
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
        $datas = $this->order('starttime desc')->select();
        foreach ($datas as $k => $data) { 
	foreach ($data as $key => $value) {
		if ($key != 'id' and $key != 'starttime' and $key != 'endtime' and $key != 'banner') {
			$datas[$k][$key] = json_decode($value,true);
	        	}
	}
	$datas[$k]['title'] = $datas[$k]['title'][LANG_SET];
	$datas[$k]['detail'] = $datas[$k]['detail'][LANG_SET];
	$countrys= M('countrys');
        	foreach ($datas[$k]['country'] as $key => $value) {
        		$res = $countrys->find($value);
        		$datas[$k]['country'][$key] = $res['code'];
        	}
        }
        return $datas;
    }

    public function converttime($data=0)
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