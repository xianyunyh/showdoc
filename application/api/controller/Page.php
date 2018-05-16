<?php


namespace app\api\controller;


use app\api\model\ItemMemberModel;
use app\api\model\PageModel;
use app\api\validate\PageValidate;
use app\traits\Tools;

class Page extends Base
{
    use Tools;
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

    /**
     * 读取单个文章
     * @param $pageId
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
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
//        if (!in_array($uid, $members)) {
//            $this->returnError('没有权限');
//        }
        $this->returnSuccess($data, '获取成功');
    }

    /**
     * 更新文档列表
     */
    public function save()
    {
        $uid = $this->request->uid;
        $data = $this->request->post();
        $data['uid'] = $uid;
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


    /**
     * 获取菜单列表
     * @param $itemId
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function menus($itemId)
    {
        $data = $this->model->where('item_id',$itemId)->select()->toArray();
        $data = $this->list_to_tree($data,'page_id','pid','child');
        $this->returnSuccess($data);

    }



}