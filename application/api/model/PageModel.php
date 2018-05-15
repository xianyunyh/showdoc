<?php

namespace app\api\model;


use think\Model;

class PageModel extends Model
{
    protected $table = 'd_page';
    protected $pk = 'page_id';
    // 定义时间戳字段名
    protected $autoWriteTimestamp = true;
    protected $createTime = 'add_time';
    protected $insert = ['page_order'];

    protected function setPageOrderAttr($value)
    {
        if(empty($value)) return 0;
            return $value;
    }

    /**
     * 单页page
     *
     * @param $itemId
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSingle($itemId)
    {
        if(empty($itemId)) {
            return [];
        }

        $where = [
            "cate_id" => 0,
            "item_id"=>$itemId
        ];
        return $this->where($where)->select();
    }

}