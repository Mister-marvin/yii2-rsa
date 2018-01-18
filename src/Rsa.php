<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2018/1/18
 * Time: 19:42
 */
namespace mistermarvin\rsa;

class Rsa{

    public $public_key;
    public $private_key;

    public $config = [
                    "digest_alg" => "sha512",
                    "private_key_bits" => 4096,           //字节数  512 1024 2048  4096 等
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,   //加密类型
            ];


    //_________________________________________________________________________________________
    public function generateKey()
    {
        $res = openssl_pkey_new($this->config);
        openssl_pkey_export($res, $private_key);
        $public_key = openssl_pkey_get_details($res);

        $this->public_key = $private_key;
        $this->public_key = $public_key['key'];

        return ['private_key' => $this->public_key, 'public_key' => $this->private_key];
    }


    //_________________________________________________________________________________________
    public function encrypt($data)
    {
        openssl_public_encrypt($data, $encrypted, $this->public_key);
        return base64_encode($encrypted);
    }


    //_________________________________________________________________________________________
    public function decrypt($data)
    {
        $decrypted = base64_decode($data);
        openssl_private_decrypt($decrypted, $decrypted, $this->private_key);
        return $decrypted;
    }
}