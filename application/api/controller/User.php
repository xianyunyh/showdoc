<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/10
 * Time: 16:51
 */

namespace app\api\controller;


use think\Request;
use app\api\validate\UserValidate;

class User extends Base {

    public function register (Request $request)
    {
        $validate = new UserValidate();
        $res      = $validate->scene('login')->check($request->get());

    }

    public function login ()
    {

    }

    public function  check()
    {

    }
}