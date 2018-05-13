<?php

namespace app\api\validate;

use think\Validate;


class UserValidate extends Validate {
    protected $rule = [
        'username' => 'require|email|unique:user,username',
        'password' => 'require|alphaDash',
        'oldpassword'=>'require|different:password',
        'email'    => 'email',
    ];

    protected $message = [
        'username.require' => '登录账号必须填写',
        'username.email' => '登录账号格式不正确',
        'oldpassword.require'=>'旧密码不能为空',
        'oldpassword.different'=>'新旧密码不一致',
        'password.require' => "密码不能为空",
        "password.alphaDash" => "密码只能为空数字字母下划线",
        'email' => '邮箱格式错误',
    ];

    public function sceneRegister($name)
    {
        return $this->only(['username','password'])
            ->remove('oldpassword', ['require','different']);
    }

    // Login 验证场景定义
    public function sceneLogin()
    {
        return $this->only(['username','password'])
            ->remove('username', 'unique')
            ->remove('oldpassword',['require','different']);
    }
    // sceneChangePwd 验证场景定义
    public function sceneChangePwd()
    {
        return $this->only(['password','oldpassword'])
            ->remove('username', ['email','unique','require']);
    }
}