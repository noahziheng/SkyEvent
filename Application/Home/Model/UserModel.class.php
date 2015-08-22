<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    public function getUser($id)
    {
        $data = $this->find($id);
        unset($data['password']);
        return $data;
    }

    public function getAll()
    {
        $datas = $this->select();
        foreach ($datas as $key => $data) {
            unset($datas[$key]['password']);
        }
        return $datas;
    }
}