<?php
namespace app\api\controller;
use app\api\model\UserModel;
use think\facade\Config;
class Index extends Base
{
    public function index()
    {
        $model = new UserModel();
        $res =  $model->where('uid',1)->select();
        var_dump($model->items());
    }
}
