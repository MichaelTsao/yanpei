<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/10
 * Time: 下午5:04
 */

namespace app\models;

use app\models\base\Common;
use Yii;

class LeanCloud
{
    static public function createConversation($uids)
    {
        $r = Common::request('https://api.leancloud.cn/1.1/classes/_Conversation',
            json_encode(array('m' => $uids)),
            array(
                'X-LC-Id: ' . Yii::$app->params['lean_cloud_id'],
                'X-LC-Key: ' . Yii::$app->params['lean_cloud_key'],
                'Content-Type: application/json',
            ));
        if ($r) {
            $data = json_decode($r, true);
            if (isset($data['objectId'])) {
                return $data['objectId'];
            }
        }
        return false;
    }
}