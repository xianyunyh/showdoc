<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/12
 * Time: 16:53
 */

namespace app\api\validate;


use think\Validate;

class ItemValidate extends Validate
{
    protected $rule = [
        'item_name' => 'require|chsAlphaNum',
        'uid' => 'require|integer',
        'item_description'=>'require',
        'password'=>''
    ];

    protected $message = [
        'item_name.require' => '项目名称必须填写',
        'uid.require' => '用户名必须填写',
        'item_description.require'=>'项目描述必须填写',
        "item_name.chsAlphaNum" => "项目名字必须为中文、字母、数字",
        'password' => '邮箱格式错误',
    ];

}