<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    public function getUser($id)
    {
        $data = $this->find($id);
        $data['groupname'] = M('usergroup')->where('id='.$data['group'])->getField('name');
        unset($data['password']);
        return $data;
    }
}