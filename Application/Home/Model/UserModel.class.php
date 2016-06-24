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
                    $res[] = array('id' => $va, 'name'=>$this->getFullname($va),'group'=>$key);
                }
            }
            return $res;
        }
    }

    public function getFullname($id)
    {
        $data = $this->get($id);
        return $data['firstname']." ".$data['lastname'];
    }

    private function format($orig)
    {
        $arr=array();
        $arr['id']=$orig['id'];
        $arr['firstname']=$orig['name_first'];
        $arr['lastname']=$orig['name_last'];
        $arr['group']=$this->checkgroup($orig['id']);
        $arr['rating']=$orig['rating']['id'];
        $arr['reg_date']=$orig['reg_date'];
        $arr["division"]=$orig["division"]["code"];
        $arr["region"]=$orig["region"]["code"];
        $arr["country"]=$orig["country"]["code"];
        $arr["token"]=$orig["token"];
        return $arr;
    }

    private function checkgroup($id)
    {
        $group=S('usergroup');
        foreach ($group as $key => $v) {
            if(in_array($id, $v)){
                return $key;
            }
        }
        return 0;
    }
}