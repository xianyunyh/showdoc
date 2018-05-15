<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/14
 * Time: 22:07
 */

namespace app\api\validate;


use think\Validate;

class CatalogValidate extends Validate
{
    protected $rule = [
        'cate_name' => 'require|chsAlphaNum',
        'cate_item_id' => 'require|integer',
    ];

    protected $message = [
        'cate_name.require' => '项目名称必须填写',
        'cate_item_id.require' => '项目id不能为空',
        'cate_item_id.integer'=>'项目id必须为整',
        "cate_name.chsAlphaNum" => "项目名字必须为中文、字母、数字",
    ];

}