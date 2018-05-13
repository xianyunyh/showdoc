<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/10
 * Time: 16:42
 */

namespace app\api\controller;


use think\Controller;
use think\Response;
use app\traits\Jump;

class Base extends Controller {
    use Jump;

    /**
     * 空操作
     * @param $name
     */
    public function _empty()
    {
        $this->returnError('no api found',-3    );
    }

}