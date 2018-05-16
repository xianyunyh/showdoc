<?php
namespace  app\traits;

trait Tools {

    protected $key = '';

    /**
     * 加密token
     * @param $data
     * @return string
     */
    public function encryptToken($data)
    {
        $method = 'AES-256-ECB';
        $key = config('app.secret_key');
        $token = openssl_encrypt($data,$method,$key);
        return $token;
    }

    /**
     * 解密token
     * @param $token
     * @return bool|mixed
     */
    public function decryptToken($token)
    {
        $method  = 'AES-256-ECB';
        $key = config('app.secret_key');
        $data = openssl_decrypt($token,$method,$key);
        $res = json_decode($data,true);
        if($res == JSON_ERROR_NONE) {
            return false;
        }
        return $res;

    }

    protected function randomString($length=8)
    {
        $key = "";
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';    //字符池
        for($i=0; $i<$length; $i++) {
            $key .= $pattern[mt_rand(0,35)];
        }
        return $key;
    }

    public function list_to_tree($list, $pk='id', $pid = 'pid', $child = 'catalogs', $root = 0) {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }


}