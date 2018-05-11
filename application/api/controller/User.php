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

class User extends Base {
    protected $model;

    public function __construct (UserModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 用户注册接口
     * /api/user/login POST
     *
     * @param Request $request
     * @return \think\response\Json
     */
    public function register (Request $request)
    {
        $data  = $request->post();
        $count = $this->model->where('username', $data['username'])->count();
        if ($count >= 1) {
            $this->returnError('用户已存在', 20002);
        }

        unset($data['v_code']);
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $res              = $this->model->insert($data);
        if ($res) {
            $this->returnSuccess(["token" => "11" . $res]);
        }
        $this->returnError("更新失败", 20001);
    }

    /**
     * 用户登陆接口
     *
     * @url /api/user/login
     * @method POST
     * @return string
     */
    public function login ()
    {
        $data     = $this->request->post();
        $username = $data['username'];
        $result   = $this->model->getInfoByUsername($username);

        if (!$result) {
            $this->returnError('用户不存在', 20002);
        }

        if (!password_verify($data['password'], $result['password'])) {
            $this->returnError('密码不正确', 20003);
        }

        $data['last_login_time'] = time();

        //更新用户
        $res = $this->model->updateInfoByUid($result['uid'], $data);

        if (!$res) {
            $this->returnError('系统故障', '-2');
        }

        $this->returnSuccess([], "登陆成功");

    }

    /**
     * 校验用户接口
     * /api/user/check
     * @method POST
     *
     * @return \think\response\Json
     */
    public function check ()
    {
        $username = $this->request->post('account');
        $count    = $this->model->where('username', $username)->count();
        if ($count >= 1) {
            $this->returnError('用户已存在', 20004);
        }
        $this->returnSuccess([], 'ok');
    }


    public function changePwd ()
    {


    }

    public function bindEmail ()
    {

    }

}