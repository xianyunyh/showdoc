<?php
namespace  app\traits;

trait Tools {

    public function encryptToken($data)
    {
        $method = 'AES-256-ECB';
        $key = "helloWorld";
        $token = openssl_encrypt($data,$method,$key);
        return $token;
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


}