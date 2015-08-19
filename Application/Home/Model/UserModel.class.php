<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    public function getUser($id)
    {
        $data = $this->find($id);
        $data['groupname'] = L('usergroup_'.strval($data['group']));
        unset($data['password']);
        return $data;
    }
}