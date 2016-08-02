<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    public function __construct($name='') {

    }

    public function get($id)
    {
        $data = S('user-'.$id);
        if(!$data){
            return false;
        }else{
            return $this->format($data);
        }
    }

    public function getAll()
    {
        $data = S('usergroup');
        if(!$data){
            return false;
        }else{
            $res = array();
            foreach ($data as $key => $v) {
                foreach ($v as $va) {
                    $name=$this->getFullname($va);
                    if(!$name){
                        $name=$this->getFullnameAPI($va);
                    }
                    $res[] = array('id' => $va, 'name'=>$name,'group'=>$key);
                }
            }
            return $res;
        }
    }

    public function AddUser($id,$group)
    {
        $data = S('usergroup');
        if(!$data){
            return false;
        }else{
            $res = array();
            foreach ($data as $key => $v) {
                foreach ($v as $va) {
                    $name=$this->getFullname($va);
                    if(!$name){
                        $name=$this->getFullnameAPI($va);
                    }
                    $res[] = array('id' => $va, 'name'=>$name,'group'=>$key);
                }
            }
            return true;
        }
    }

    public function DelUser($id,$group)
    {}

    public function getUserEmail($id)
    {
        $data = S('user-'.$id.'-email');
        if(!$data){
            return false;
        }else{
            return $data;
        }
    }

    public function SetUserEmail($id,$email)
    {
        $data = S('user-'.$id.'-email',$email);
        if(!$data){
            return false;
        }else{
            return $data;
        }
    }

    public function getUserGroup($id)
    {
        $group=S('usergroup');
        if(!$group){
            $group=array();
            $group[4]=array("1248613");
            $group[3]=array(
                "1191126",
                "1193569",
                "1255570",
                "1251477",
                "1212751",
                "1282162",
                "1259390",
                "1279052",
            );
            S('usergroup',$group);
        }
        foreach ($group as $key => $v) {
            if(in_array($id, $v)){
                return $key;
            }
        }
        return 1;
    }

    public function setUserGroup($id,$groupid)
    {
        $group=S('usergroup');
        foreach ($group as $key => $v) {
            foreach ($v as $i => $c) {
                if($c==$id){
                    unset($group[$key][$i]);
                }
            }
        }
        $group[$groupid][]=$id;
        return S("usergroup",$group);
    }

    public function delUserGroup($id)
    {
        $group=S('usergroup');
        foreach ($group as $key => &$v) {
            array_splice($v, array_search($id,$v,false), 1);
        }
        return S("usergroup",$group);
    }

    public function getFullname($id)
    {
        $data = $this->get($id);
        if(!$data){
            return false;
        }else{
            return $data['firstname']." ".$data['lastname'];
        }
    }

    public function getFullnameAPI($id)
    {
        $data = json_decode(\Org\Net\HttpCurl::get('http://api.vateud.net/members/id/'.$id.'.json'),true);
        return $data['firstname']." ".$data['lastname'];
    }

    private function format($orig)
    {
        $arr=array();
        $arr['id']=$orig['id'];
        $arr['firstname']=$orig['name_first'];
        $arr['lastname']=$orig['name_last'];
        $arr['group']=$this->getUserGroup($orig['id']);
        $arr['rating']=$orig['rating']['id'];
        $arr['reg_date']=$orig['reg_date'];
        $arr["division"]=$orig["division"]["code"];
        $arr["region"]=$orig["region"]["code"];
        $arr["country"]=$orig["country"]["code"];
        $arr['email']=$this->getUserEmail($orig['id']);
        $arr["token"]=$orig["token"];
        return $arr;
    }
}