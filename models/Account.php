<?php

namespace app\models;

use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $passwordRaw
 * @property integer $status
 * @property string $role
 */
class Account extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = 'admin';
    const ROLE_VIEWER = 'viewer';
    const ARTICLE_EDITOR = 'article-editor';
    const PRODUCT_EDITOR = 'product-editor';
    const STORE_EDITOR = 'store-editor';
    const DOCTOR_AUDITOR = 'doctor-auditor';
    public static $roles = [
        self::ROLE_ADMIN => '管理员',
        self::ROLE_VIEWER => '普通用户',
        self::ARTICLE_EDITOR => '文章编辑',
        self::PRODUCT_EDITOR => '产品维护',
        self::STORE_EDITOR => '库存管理',
        self::DOCTOR_AUDITOR => '验配师审核员',
    ];

    public $auth_key;
    private $_passwordRaw = '';
    public $role = null;

    const STATUS_CLOSED = 2;
    const STATUS_ACTIVE = 1;
    static public $statusLabel = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_CLOSED => '关闭',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
            [['passwordRaw'], 'string', 'max' => 32],
            [['passwordRaw'], 'string', 'min' => 6],
            [['role'], 'string', 'max' => 50],
            ['role', 'in', 'range' => array_keys(self::$roles)],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'passwordRaw' => '密码',
            'status' => '状态',
            'role' => '角色',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::findOne(['id' => $id]);
        if ($user && $user->status == self::STATUS_ACTIVE) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    public function setPasswordRaw($password)
    {
        if ($password) {
            $this->_passwordRaw = $password;
            $this->password = md5($password);
        }
    }

    public function getPasswordRaw()
    {
        return $this->_passwordRaw;
    }

    public function afterFind()
    {
        if ($roles = Yii::$app->authManager->getRolesByUser($this->id)) {
            $this->role = array_keys($roles)[0];
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->role) {
            Yii::$app->authManager->revokeAll($this->id);
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($this->role), $this->id);
        }
    }
}
