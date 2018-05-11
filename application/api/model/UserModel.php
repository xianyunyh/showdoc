<?php
namespace  app\api\model;

use think\Model;

class UserModel extends Model {

    /**
     * @var string 用户表名
     */
    protected $table = 'd_user';


    /**
     * 根据用户名获取用户信息
     *
     * @param $name
     * @return array|null|\PDOStatement|string|Model
     */
    public function getInfoByUsername($name)
    {
        if(empty($name)) {
            return null;
        }
        $data = $this->where('username','=',$name)->find();

        return $data;
    }

    /**
     * 根据用户id更新用户信息
     *
     * @param       $uid
     * @param array $data
     * @return bool|static
     */
    public function updateInfoByUid($uid,$data = [])
    {

        $uid = intval($uid);
        if(empty($uid) || empty($update)) {
            return false;
        }
        $where = ["uid"=>$uid];
        return $this->update($data, $where);
    }

}