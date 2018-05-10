<?php

namespace app\api\validate;

use think\Validate;


class UserValidate extends Validate {
    protected $rule = [
        'username' => 'require|email|unique:user,username',
        'password' => 'require|alphaDash',
        'email'    => 'email',
    ];

    protected $message = [
        'username.require' => '登录账号必须填写',
        'username.email' => '登录账号格式不正确',
        'password.require' => "密码不能为空",
        "password.alphaDash" => "密码只能为空数字字母下划线",
        'email' => '邮箱格式错误',
    ];

    protected $scene = [
        'register' => [
            'username',
            'password'
        ],
        'login'    => [
            'username',
            'password'
        ]
    ];
}