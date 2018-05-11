<?php

namespace app\traits;

use think\Container;
use think\exception\HttpResponseException;
use think\Response;
use think\response\Redirect;

trait Jump
{

    protected function returnSuccess($data,$msg="ok")
    {
        $result = [
            'code' => 0,
            'msg'  => $msg,
            'status' =>1,
            'data' => $data,
        ];

        $type     = "json";
        $header   = config('app.cors_header');
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }

    protected function returnError($msg = '', $code = null, $data = '')
    {
        $result = [
            'code'   => $code,
            'msg'    => $msg,
            'status' =>0,
            'data'   => $data,
        ];

        $type     = "json";
        $header = config('app.cors_header');
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }
}
