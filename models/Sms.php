<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/3/17
 * Time: 下午2:32
 */

namespace app\models;

use app\models\base\Common;

class Sms
{
    public static function send($phone, $msg)
    {
        $url = 'http://xtx.telhk.cn:8080/sms.aspx?action=send';

        $post_data = [];
        $post_data['account'] = 'a10322';
        $post_data['password'] = '454124';
        $post_data['userid'] = '5778';
        $post_data['sendTime'] = '';

        if (is_array($phone)) {
            $post_data['mobile'] = implode(',', $phone);
        } else {
            $post_data['mobile'] = $phone;
        }

        $tail = '（微信服务号：e听）请勿回复本短信【e听】';  // TODO: CX get from msg-sys
        $post_data['content'] = mb_convert_encoding($msg . $tail, 'UTF-8', 'auto');

        return Common::request($url, $post_data);
    }
}