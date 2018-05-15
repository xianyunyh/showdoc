<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/14
 * Time: 23:17
 */

namespace app\api\validate;


use think\Validate;

class PageValidate extends Validate
{
    protected $rule = [
        'page_title' => 'require|chsAlphaNum',
        'uid' => 'require|integer',
        'item_id'=>'require',
        'cate_id'=>'integer',
    ];

    protected $message = [
        'page_title.require' => '标题必须填写',
        'uid.require' => '用户名必须填写',
        'item_id.require'=>'项目不能为空',
        //'cate_id.require'=>'栏目id必须填写',
        'cate_id.integer'=>'栏目id必须为整数',
        "page_title.chsAlphaNum" => "标题必须为中文、字母、数字",
    ];
}