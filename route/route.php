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
    Route::post('user/register', 'api/user/register')
        ->validate('app\api\validate\UserValidate','register');
    //登录接口
    Route::post('user/login', 'api/user/login')
        ->validate('app\api\validate\UserValidate','login');

    //项目路由
    Route::get('item/index','api/item/index');
    Route::post('item/add','api/item/save');
    Route::get('item/:itemId$','api/item/read');
    Route::put('item/:itemId','api/item/update');
    Route::delete('item/:itemId','api/item/delete');
    Route::get('item/detail/:itemId','api/item/info');

    Route::resource('catalog','api/catalog');

    Route::resource('member','api/itemMember');

    Route::post('page/save','api/page/save');
    Route::get('item/info:itemId','api/item/info');
})->middleware('Api')->header($header)->allowCrossDomain();
