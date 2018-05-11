<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

$header = config('app.cors_header');

Route::group('api', function ()  {
    //注册接口
    Route::post('user/register', 'api/user/register')->validate('app\api\validate\UserValidate','register');
    //登录接口
    Route::post('user/login', 'api/user/login')->validate('app\api\validate\UserValidate','login');

})->middleware('Api')->header($header)->allowCrossDomain();