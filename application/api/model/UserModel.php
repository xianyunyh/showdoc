<?php
namespace  app\api\model;

use think\Model;

class UserModel extends Model {

    /**
     * @var string 用户表名
     */
    protected $table = 'd_user';

    protected $pk ='uid';

    public $uid;


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
        $data = $this->where('username','=',$name)->find()->toArray();

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
        if(empty($uid) || empty($data)) {

            return false;
        }
        $where = ["uid"=>$uid];
        return $this->update($data, $where);
    }

    public function items()
    {
        return $this->belongsToMany('ItemModel','\\app\\api\\model\\ItemMemberModel','item_id','uid');
    }


}