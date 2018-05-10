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
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>   5,
            'imageH'=>50,
            'imageW'=>200,
            // 关闭验证码杂点
            'useNoise'    =>    true,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

}