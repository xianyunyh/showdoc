<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/10
 * Time: 16:51
 */

namespace app\api\controller;


use app\traits\Tools;
use think\Log;
use think\Request;
use app\api\validate\UserValidate;
use app\api\model\UserModel;

class User extends Base {

    use Tools;
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
        $data  = [];
        $data['username'] = $request->post('username');
        $data['password'] = $request->post('password');
        $count = $this->model->where('username', $data['username'])->count();
        if ($count >= 1) {
            $this->returnError('用户已存在', 20002);
        }


        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['reg_time'] = time();

        $res = $this->model->insert($data);

        $tokenData = [
            'uid'=>$res,
            'expire'=>time()+24*3600
        ];
        $token = $this->encryptToken($tokenData);

        $returnData = [
            'token'=>$token,
            'uid'=>$res,
            'username'=>$data['username']
        ];
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

        $data = [
            'uid' =>$result['uid'],
            'expire'=>time()+24*3600
        ];
        $token = $this->encryptToken(json_encode($data));
        $updateData['cookie_token'] = $token;
        $updateData['last_login_time'] = time();

        //更新用户
        $res = $this->model->updateInfoByUid($result['uid'], $updateData);

        if (!$res) {
            $this->returnError('系统故障'.$this->model->getLastSql(), '-2');
        }
        $returnData = [
            'token'=>$token,
            'uid'=>$result['uid'],
            'username'=>$result['username']
        ];
        $this->returnSuccess($returnData, "登陆成功");

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


    /**
     * 修改密码
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function changePwd ()
    {
        //用户id
        $uid = $this->request->post('uid');
        $userInfo = $this->model->find($uid)->toArray();
        if(empty($userInfo)) {
            $this->returnError('用户不存在',20005);
        }

        $oldPwd = $this->request->post('oldpassword');
        //校验密码
        if(!password_verify($oldPwd,$userInfo['password'])) {
           $this->returnError('旧密码输入不正确',20006);
        }
        $newPwd = $this->request->post('password');

        if(!password_verify($newPwd,$userInfo['password'])){
            $this->returnSuccess([],'新密码和旧密码一致无需修改');
        }
        $updateData = [
            'password'=>password_hash($newPwd,PASSWORD_BCRYPT)
        ];

        //更新用户信息
        $res = $this->model->updateInfoByUid($uid,$updateData);

        if(!$res) {
            $this->returnError('系统故障','-3');
        }

        $this->returnSuccess([],'更新成功');

    }

    public function bindEmail ()
    {

    }

}