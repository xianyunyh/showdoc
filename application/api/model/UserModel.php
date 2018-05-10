<?php
namespace  app\api\model;

use think\Model;

class UserModel extends Model {


    public function getInfoByUsername($name)
    {
        if(!empty($name)) {
            return null;
        }
        $data = $this->where('username','=',$name)->find();
        return $data;
    }

}