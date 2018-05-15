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


}