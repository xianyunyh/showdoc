<?php
/**
 * Created by PhpStorm.
 * User: xianyun
 * Date: 2018/5/10
 * Time: 22:54
 */

namespace app\api\controller;

use think\captcha\Captcha;
class Verifycode
{

    public function index()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }

}