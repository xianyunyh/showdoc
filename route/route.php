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
Route::group('api', function () {
    Route::post('user/register', 'api/user/register')->validate('app\api\validate\UserValidate','register');
})->middleware('Api')->allowCrossDomain();

Route::get('/index',function(){
   $cron = new \app\api\behavior\CronRun();
   var_dump(get_class_methods($cron));
});