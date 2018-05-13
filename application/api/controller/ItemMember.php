<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/13
 * Time: 21:50
 */

namespace app\api\controller;


use app\api\model\ItemMemberModel;
use app\api\model\ItemModel;
use app\api\model\UserModel;

class ItemMember extends Base
{
    protected $model;
    protected $itemModel;
    protected $userModel;

    public function __construct(ItemMemberModel $model, ItemModel $itemModel, UserModel $userModel)
    {
        parent::__construct();
        $this->model = $model;
        $this->itemModel = $itemModel;
        $this->userModel = $userModel;
    }

    public function save()
    {
        $UID = $this->request->uid;
        $itemId = $this->request->post('item_id');
        $userName = $this->request->post('username');
        $userInfo = $this->userModel->getInfoByUsername($userName);

        if (!$userInfo) {
            $this->returnError('用户不存在');
        }

        if ($UID == $userInfo['uid']) {
            $this->returnError('不能添加自己');
        }

        $where = [
            'uid' => $UID,
            'item_id' => $itemId
        ];
        $itemInfo = $this->itemModel->where($where)->find();
        if (empty($itemInfo)) {
            $this->returnError('项目不存在');
        }

        $data = [
            'uid' => $userInfo['uid'],
            'item_id' => $itemId
        ];
        $res = $this->model->save($data);

        if (!$res) {
            $this->returnError('新增失败');
        }

        $this->returnSuccess([], '新增成功');

    }


}