<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/10
 * Time: 16:51
 */

namespace app\api\controller;


use think\Request;
use app\api\validate\UserValidate;
use app\api\model\UserModel;

class User extends Base
{
    protected $model;

    public function __construct(UserModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 用户注册接口
     * /api/user/login POST
     * @param Request $request
     * @return \think\response\Json
     */
    public function register(Request $request)
    {
        $data = $request->post();
        $count = $this->model->where('username',$data['username'])->count();
        if($count >= 1) {
            return $this->error('用户已存在', 20002);
        }
        $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);
        $res = $this->model->insert($data);
        if ($res) {
            return $this->success(["token" => "11" . $res]);
        }
        return $this->error("更新失败", 20001);
    }

    /**
     * 用户登陆接口
     * @url /api/user/login
     * @method POST
     * @return string
     */
    public function login()
    {
        $data = $this->request->post();
        $username = $data['username'];
        $result = $this->model->getInfoByUsername($username);
        if (!$data) {
            return $this->error('用户不存在', 20002);
        }

        if (!password_verify($data['password'], $result['password'])) {
            return $this->error('密码不正确', 20003);
        }

        return $this->success([], "登陆成功");

    }

    /**
     * 校验用户接口
     * /api/user/check
     * @method POST
     * @return \think\response\Json
     */
    public function check()
    {
        $username = $this->request->post('account');
        $count = $this->model->where('username',$username)->count();
        if($count >= 1) {
            return $this->error('用户已存在', 20004);
        }
        return $this->success([],'ok');
    }


    public function changePwd()
    {


    }

    public function bindEmail()
    {

    }

}