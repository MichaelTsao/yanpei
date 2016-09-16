<?php

namespace app\models;

use Yii;
use app\models\base\CachedActiveRecord;

/**
 * This is the model class for table "user_token".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $token
 * @property string $ctime
 */
class UserToken extends CachedActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['ctime'], 'safe'],
            [['token'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户ID',
            'token' => '登录令牌',
            'ctime' => '创建时间',
        ];
    }

    public function getExpireTime()
    {
        return 86400 * 30;
    }

    public function makeToken()
    {
        $this->token = md5(time() . $this->uid . rand(100, 999));
        $this->ctime = date('Y-m-d H:i:s');
    }

    public static function loadByDb($key)
    {
        if ($token = static::findOne(['token' => $key])) {
            if (strtotime($token->ctime) > (time() - $token->expireTime)) {
                return $token;
            }
        }
        return false;
    }

    public function loadByCache()
    {
        if ($uid = Yii::$app->redis->get($this->cacheKey)) {
            $this->uid = $uid;
            return true;
        } else {
            return false;
        }
    }

    public function writeCache()
    {
        Yii::$app->redis->set($this->cacheKey, $this->uid, strtotime($this->ctime) + $this->expireTime - time());
    }

    /*------------*/

    public static function create($uid)
    {
        $token = new UserToken(['uid' => $uid]);
        $token->makeToken();
        $token->save();
        return $token;
    }

    public static function refreshToken($token_value)
    {
        if ($token = static::cache($token_value)) {
            $token->delete();
            $token->makeToken();
            $token->save();
        }
    }

    public static function auth($token_value)
    {
        if ($token_value && ($token = static::cache($token_value))) {
            return $token->uid;
        }
        return false;
    }

    public static function remove($token_value)
    {
        $token = static::cache([$token_value]);
        $token->delete();
    }
}
