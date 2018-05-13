<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/12
 * Time: 16:47
 */

namespace app\api\controller;

use app\api\model\ItemModel;
use app\api\validate\ItemValidate;

class Item extends Base
{
    protected $model;
    protected $validate;
    public function __construct(ItemModel $model,ItemValidate $validate)
    {
        parent::__construct();
        $this->model = $model;
        $this->validate = $validate;
    }

    /**
     * 获取项目列表
     *
     * @api GET /api/item
     */
    public function index()
    {
        $uid = $this->request->uid;
        $lists = $this->model->getListByUid($uid);
        $this->returnSuccess($lists,'获取成功');
    }

    /**
     * 获取项目详细信息
     *
     * @param $itemId
     * @api  GET /api/item/:id
     */
    public function read($itemId)
    {
        $uid = $this->request->uid;
        $where = [
            'uid'=>$uid,
            'item_id'=>$itemId
        ];
        $itemInfo = $this->model->where($where)->find();
        $this->returnSuccess($itemInfo,'获取成功');
    }

    /**
     * 更新项目信息
     * @api  PUT /api/item/:id
     * @param $itemId
     */
    public function update($itemId)
    {
        $uid = $this->request->uid;
        $where = [
            'uid'=>$uid,
            'item_id'=>$itemId
        ];
        $itemInfo = $this->model->where($where)->find();

        if(empty($itemInfo)) {
            $this->returnError('项目不存在');
        }

        $updateData = $this->request->put();

        $res = $this->model->allowField(true)
            ->save($updateData,$where);
        if(!$res) {
            $this->returnError('系统故障',-3);
        }
        $this->returnSuccess([],'更新成功');

    }

    /**
     * 添加项目
     * @api POST /api/item
     */
    public function save()
    {
        $data = $this->request->post();

        $data['uid'] = $this->request->param('uid');

        if(false == $this->validate->check($data)) {
            $this->returnError($this->validate->getError(),1000);
        }
        $itemId = $this->model->allowField(true)->save($data);
        if(!$itemId) {
            $this->returnError('系统故障',-3);
        }
        $this->returnSuccess([],'创建成功');
    }

    /**
     * @param $itemId integer 项目id
     * @api  DELETE /api/item/:id
     */
    public function delete($itemId)
    {
        $uid = $this->request->uid;
        $where = [
            'uid'=>$uid,
            'item_id'=>$itemId
        ];
        $itemInfo = $this->model->where($where)->find();
        if(!empty($itemInfo)) {
            $this->returnError('项目不存在',1000);
        }
        $res = $this->model->delete($itemId);
        if(!$res) {
            $this->returnError('系统故障',-2);
        }
        $this->returnSuccess([],'删除成功');


    }

}