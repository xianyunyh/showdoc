<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/13
 * Time: 21:51
 */

namespace app\api\model;


use think\Model;

class ItemMemberModel extends \think\model\Pivot
{
    protected $table = 'd_item_member';

    // 定义时间戳字段名
    protected $autoWriteTimestamp = true;
    protected $createTime = 'add_time';

    /**
     * 获取用户的项目
     *
     * @param $uid
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getUserItems($uid)
    {
        if(!$uid) {
            return [];
        }
        $result = $this->alias('m')
            ->leftJoin('item i','m.item_id = i.item_id')
            ->where('m.uid',$uid)
            ->select();

        return $result;
    }

    /**
     * 获取项目项目下的用户列表
     *
     * @param $itemId
     * @return array
     */
    public function getItemUsers($itemId)
    {
        if(empty($itemId)) {
            return [];
        }
        $result = $this->alias('m')
            ->leftJoin('user u','m.uid = u.uid')
            ->field('u.username,u.uid,u.name,m.add_time')
            ->where('m.item_id',$itemId)
            ->select();
        return $result;
    }

}