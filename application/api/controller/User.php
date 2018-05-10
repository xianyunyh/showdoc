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
        $data = $request->post();

        return $this->returnSuccess($data);


    }

    public function login ()
    {

    }

    public function  check()
    {

    }
}