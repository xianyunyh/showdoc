<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/12
 * Time: 16:59
 */

namespace app\api\model;


use think\Model;

class ItemModel extends Model
{
    protected $table = 'd_item';
    protected $pk = 'item_id';
    // 定义时间戳字段名
    protected $autoWriteTimestamp = true;
    protected $createTime = 'add_time';
    protected $updateTime = 'last_update_time';


    public function getListByUid($uid)
    {
        $uid = intval($uid);
        if($uid <= 0) {
            return [];
        }

        return $this->where('uid',$uid)->select()->toArray();
    }


}