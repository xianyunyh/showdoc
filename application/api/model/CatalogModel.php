<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/14
 * Time: 22:10
 */

namespace app\api\model;


use think\Model;

class CatalogModel extends Model
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'd_catalog';
    /**
     * 主键
     * @var string
     */
    protected $pk = 'cat_id';
    /**
     * 时间戳自动转换
     * @var bool
     */
    protected $autoWriteTimestamp = true;
    protected $createTime = 'add_time';
    /**
     * 自动完成的字段
     * @var array
     */
    protected $insert = ['cate_order'];

    /**
     * 自动填充cate_order字段
     *
     * @param $value
     * @return int
     */
    protected function setCateOderAttr($value)
    {
        return (empty($value)) ? 1 : $value;
    }

    /**
     * 获取栏目列表
     * @param $itemId
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getListsByItemId($itemId,$cateId='')
    {
        if(empty($itemId)) {
            return [];
        }
        $model = $this->where('cate_item_id','=',$itemId);
        if(!empty($cateId)) {
            $model = $model->where('cat_id',$cateId);
        }
        $data = $model->select();
        return $data;
    }
}