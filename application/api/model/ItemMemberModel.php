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

    public function  items()
    {
        return $this->hasMany('UserModel','uid','uid');
    }

}