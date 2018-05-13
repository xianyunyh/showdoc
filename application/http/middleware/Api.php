<?php

namespace app\http\middleware;

use app\traits\Jump;
use app\traits\Tools;

class Api
{
    use Jump,Tools;
    //排除路由
    protected $excludeRoute  = [
        "api/user/login",
        "api/user/register"
    ];
    public function handle($request, \Closure $next)
    {
        //获取路由
        $route = $request->path();
        if(!in_array($route,$this->excludeRoute)){
            $token = $request->header("Token");
            if(empty($token)) {
                $this->returnError('token不能为空',1000);
            }

            $res = $this->decryptToken($token);

            if(false === $res){
                $this->returnError('token无效',1001);
            }
            if($res['expire'] < time()) {
                $this->returnError('token已过期',1002);
            }

            $request->uid = $res['uid'];
            //加入到request里


        }

        return $next($request);
    }
}
