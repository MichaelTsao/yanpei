<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/3/17
 * Time: 下午2:32
 */

namespace app\models;

use yii\httpclient\Client;

class Sms
{
    public static function send($phone, $msg = '')
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://api.leancloud.cn/1.1/requestSmsCode')
            ->setFormat(Client::FORMAT_JSON)
            ->setData(['mobilePhoneNumber' => $phone, 'template' => '获取验证码', 'code' => '1234', 'ttl' => 1])
            ->addHeaders([
                'X-LC-Id' => 'LzdETQ4Wzu6jAImixLPSgLQ5-gzGzoHsz',
                'X-LC-Key' => 'juJOv92RpK8TJmiXOISmka4I',
            ])
            ->send();
        return $response->isOk;
    }
}