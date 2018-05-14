<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/14
 * Time: 22:15
 */

namespace app\api\controller;


use app\api\model\CatalogModel;
use app\api\validate\CatalogValidate;

class Catalog extends Base
{
    protected $validate;
    protected $model;
    public function __construct(CatalogModel $model, CatalogValidate $validate)
    {
        parent::__construct();
        $this->validate = $validate;
        $this->model = $model;
    }

    /**
     * @param $itemId
     */
    public function index($itemId)
    {
        if(empty($itemId)) {
            $this->returnError('项目不能为空');
        }
        $data = $this->model->getListsByItemId($itemId);
        $this->returnSuccess($data,'获取成功');
    }

    /**
     *
     */
    public function save()
    {
        $data = $this->request->post();
        if(false === $this->validate->check($data)) {
            $this->returnError($this->validate->getError());
        }
        $res = $this->model->allowField(true)->save($data);
        if(false === $res) {
            $this->returnError('系统故障');
        }
        $lastInsertId = $this->model->getLastInsID();
        $this->returnError(['cate_id'=>$lastInsertId],'添加成功');
    }

    /**
     * @param $itemId
     * @param $cateId
     */
    public function update($itemId,$cateId)
    {
        $info = $this->model->getListsByItemId($itemId,$cateId);
        if(empty($info)) {
            $this->returnError('栏目不存在');
        }
        $data = $this->request->put();
        $res = $this->model->allowField(true)->where('cat_id',$cateId)->save($data);
        if(!$res) {
            $this->returnError('修改失败');
        }
        $this->returnSuccess([],'修改成功');
    }

    /**
     * @param $itemId
     * @param $cateId
     * @api
     */
    public function delete($itemId,$cateId) {
        $info = $this->model->getListsByItemId($itemId,$cateId);
        if(empty($info)) {
            $this->returnError('项目不存在');
        }
        $res = $this->model->where('cate_id',$cateId)->delete();
        if(!$res) {
            $this->returnError('删除失败');
        }
        $this->returnSuccess([],'删除成功');
    }

}