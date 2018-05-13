<?php
/**
 * Created by PhpStorm.
 * User: tianlei
 * Date: 2018/5/12
 * Time: 21:35
 */

namespace app\api\controller;

use app\traits\Jump;
use think\Request;
class Error
{
    use Jump;
    public function index(Request $request)
    {
        $this->returnError('not found',-3);

    }

}