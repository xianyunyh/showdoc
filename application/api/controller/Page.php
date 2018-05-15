<?php


namespace app\api\controller;


use app\api\model\ItemMemberModel;
use app\api\model\PageModel;
use app\api\validate\PageValidate;

class Page extends Base
{
    protected $validate;
    protected $model;

    public function __construct(PageValidate $validate, PageModel $model)
    {
        parent::__construct();
        $this->validate = $validate;
        $this->model = $model;
    }

    public function index()
    {

    }

    public function lists($itemId)
    {

    }

    public function read($pageId)
    {
        $uid = $this->request->uid;
        $data = $this->model->find($pageId);
        if (empty($data)) {
            $this->returnError('项目不存在');
        }
        $itemId = $data['item_id'];
        $itemModel = new ItemMemberModel();
        $result = $itemModel->getItemUsers($itemId);
        $members = array_column($result, 'uid');

        //用户不在项目组里
        if (!in_array($uid, $members)) {
            $this->returnError('没有权限');
        }
        $this->returnSuccess($data, '获取成功');
    }

    public function save()
    {
        $uid = $this->request->uid;
        $data = $this->request->post();
        $data['uid'] = $uid;
        var_dump($data);
        if (false === $this->validate->check($data)) {
            $this->returnError($this->validate->getError());
        }
        $data['uid'] = $uid;
        $res = $this->model->allowField(true)->save($data);
        if (!$res) {
            $this->returnError('系统问题');
        }
        $this->returnSuccess('添加成功');

    }

    public function menus($itemId)
    {
        $data = [];


    }

}