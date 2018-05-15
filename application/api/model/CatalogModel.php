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

    public function pages()
    {
        return $this->hasMany('PageModel','cate_id');
    }

    public function getLists($itemId)
    {
        $data = [];
        $cates = $this->where('cate_item_id',$itemId)->select();
        $data = $cates;
        foreach ($cates as $key=>$cate) {
            $data[$key]['pages'] = $cate->pages;
        }
        $data = $data->toArray();
        $data = $this->list_to_tree($data,'cat_id','cate_pid');
        return $data;

    }

    public function list_to_tree($list, $pk='id', $pid = 'pid', $child = 'catalogs', $root = 0) {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}