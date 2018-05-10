<?php

namespace app\http\middleware;

class Api
{
    public function handle($request, \Closure $next)
    {
//        $token = $request->header('token');
//        if(!$token) {
//            return json(['error'=>"token is null"]);
//        }
        return $next($request);
    }
}
