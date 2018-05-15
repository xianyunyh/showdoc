<?php


namespace app\api\controller;


use app\api\model\PageModel;
use app\api\validate\PageValidate;

class Page extends Base
{
    protected $validate;
    protected $model;
    public function __construct(PageValidate $validate,PageModel $model)
    {
        $this->validate = $validate;
        $this->model = $model;
    }

    public function index()
    {

    }

    public function save()
    {
        $uid  = $this->request->uid;
        $data = $this->request->post();
        if(false === $this->validate->check($data)) {
            $this->returnError($this->validate->getError());
        }
        $data['uid'] = $uid;
        $res = $this->model->allowField(true)->save($data);
        if(!$res) {
            $this->returnError('系统问题');
        }
        $this->returnSuccess('添加成功');

    }

}