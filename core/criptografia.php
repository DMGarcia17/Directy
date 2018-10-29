<?php
class cripto{
    private $key;
    function __construct(){
        $this->key = 'ITSclULyJ8chMBOEBwbc5RrwldsFzHlgkvCQmFfSFA4=';
    }


    protected function encrypt($data){
        $clave_cifrado = base64_decode($this->key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $cifrado = openssl_encrypt($data, 'aes-256-cbc', $clave_cifrado, 0, $iv);
        return base64_encode($cifrado . '::' . $iv);
    }

    protected function decrypt($data){
        $clave_cifrado = base64_decode($this->key);
        list($cifrado, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($cifrado, 'aes-256-cbc', $clave_cifrado, 0, $iv);
    }
}
