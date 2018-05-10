<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/10
 * Time: 16:42
 */

namespace app\api\controller;


use think\Controller;
use think\Response;
class Base extends Controller {


    /**
     * 返回json
     * @param        $data
     * @param string     $msg
     * @return \think\response\Json
     */
    public function success ($data, $msg = "ok")
    {
        $result = [
            'status'    => 1,
            'errorCode' => 0,
            'msg'       => $msg,
            'data'      => $data
        ];
        return json($result);
    }


    public function error($msg,$code='-1')
    {
        $result = [
            'status'    => 0,
            'errorCode' => $code,
            'msg'       => $msg,
        ];
        return json($result);
    }
}