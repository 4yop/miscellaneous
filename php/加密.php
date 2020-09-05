<?php

    $methods = openssl_get_cipher_methods();
    //print_r($arr);


    //对称加密  AES
    $data = "我是没加密的数据";//待加密的数据

    $method = "DES-CBC";//加密方式
    $key = uniqid();//
    //$iv = '12345678';//非 NULL 的初始化向量。

    $ivlen = openssl_cipher_iv_length($method);//获取密码iv长度
    $iv = openssl_random_pseudo_bytes($ivlen);//非 NULL 的初始化向量。

    echo "加密方式:{$method}".PHP_EOL
        ."key:{$key}".PHP_EOL
        ."ivlen:{$ivlen}".PHP_EOL
        ."iv:{$iv}".PHP_EOL
        ."未加密前的数据:{$data}".PHP_EOL;

    $encrypt_string = openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA ,$iv);
    echo "\n加密后的数据为:{$encrypt_string}\n";

    $decrypt_string = openssl_decrypt($encrypt_string,$method,$key,OPENSSL_RAW_DATA,$iv);

    echo "解密后的数据为:{$decrypt_string}\n";

//对称加密  AES
    $public_key = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDffctBbyZRTiqnhm+z4aMsJJqB
9EEC9pqbbgMIep4PEywpPryBGesLzb/nIkszf4q9ZpuaFz2DEvSp/NHa7ZPK5fRJ
QIURmhtvLLT8G5bpiwRbpLAqnhs4cgPdZ8lL8Vqa3KBRFRhvLrkIZ31RhfKJ0P1g
dbtuEsGWwxzXwAcqSwIDAQAB
-----END PUBLIC KEY-----";

    $private_key = "-----BEGIN PRIVATE KEY-----
MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAN99y0FvJlFOKqeG
b7PhoywkmoH0QQL2mptuAwh6ng8TLCk+vIEZ6wvNv+ciSzN/ir1mm5oXPYMS9Kn8
0drtk8rl9ElAhRGaG28stPwblumLBFuksCqeGzhyA91nyUvxWprcoFEVGG8uuQhn
fVGF8onQ/WB1u24SwZbDHNfABypLAgMBAAECgYEAlj6hF/o7Dkm4TysHiSxVX+Wz
oU2tLurOAVOx4k9cVtISzB+K5legNi05p47cc2B4yt9iF/MrvSRPKr/17HHu+iQJ
LMg6YBKBOFe2JkmHyVzKQbD3dULXvQC1NMytTesHcMZITNDJDLOt5z3fnadU+9cc
CDcGQtZNQkfccUPHPpECQQD8u723qUflg1B4839yE/ka++9I96LfFReCa5kxgYLf
WwQpsiBeVsqbNj1SdA9aaPqynO4ptacTggdAvnmu7QLnAkEA4mFLmV2GBPU2ERHn
k99nFcw2O2JnxmLIvcA77Um7+6qd4eKEMXPC+P51h4KVvjzadRUEqGsx60VqCVfF
kvzU/QJAEJr9Qh37PVc9aFUHYKVzTpSTCkZLC0FFhCoxrJEH2kkOovazLb+iHESa
DtrVT2lqX2X0OAVZbuyyMUzSje3ArQJBAJNGUPR5j5LyJDZ+u3XMRTg9HpsLrg+2
fHpV8aax7YYQvZ4Sy4WQlit+/98k6V5WIJlDD0CyXEt/YTiqzXKO4dECQQCX5ZJo
Or+JVyH/Ojqm29eaCJCgFCUdSUJ2+80uCpJ+Tcj25m0qPTVrTpwf3YY/R4q///PZ
U6w0u2L9QBaj0mX1
-----END PRIVATE KEY-----";

    //$content = "我是要加密的内容";

    openssl_private_encrypt($data,$crypted,$private_key,OPENSSL_PKCS1_PADDING);
    echo "私钥加密后:$crypted\n";
    $key = '123456';
    openssl_public_decrypt($crypted,$decrypted,$public_key,OPENSSL_PKCS1_PADDING);
    echo "公钥解密后:$decrypted\n";