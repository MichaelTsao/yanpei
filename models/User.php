<?php
namespace app\models;

use app\models\base\ModelInfo;
use app\models\base\CachedActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $uid
 * @property string $name
 * @property string $password
 * @property string $passwordRaw
 * @property string $phone
 * @property integer $gender
 * @property string $icon
 * @property string $title
 * @property string $company
 * @property string $intro
 * @property integer $status
 * @property string $ctime
 * @property string $platform
 * @property integer $age
 * @property integer $id_type
 * @property string $id_number
 * @property string $email
 * @property string $address
 * @property string $profession
 * @property integer $relation
 * @property string $relative_name
 * @property string $relative_contact
 * @property object $doctor
 * @property string $remark
 */
class User extends CachedActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;
    static public $statusLabel = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_DELETED => '关闭',
    ];

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    static public $genderLabel = [
        self::GENDER_MALE => '男',
        self::GENDER_FEMALE => '女',
    ];

    const ID_TYPE_SFZ = 1;
    const ID_TYPE_JRZ = 2;
    const ID_TYPE_PASSPORT = 3;
    static public $idTypeLabels = [
        self::ID_TYPE_SFZ => '身份证',
        self::ID_TYPE_JRZ => '军人证',
        self::ID_TYPE_PASSPORT => '护照',
    ];

    const RELATION_SELF = 1;
    const RELATION_PARENT = 2;
    const RELATION_MATE = 3;
    const RELATION_CHILD = 4;
    const RELATION_KIN = 5;
    static public $relationLabels = [
        self::RELATION_SELF => '本人',
        self::RELATION_PARENT => '父母',
        self::RELATION_MATE => '配偶',
        self::RELATION_CHILD => '子女',
        self::RELATION_KIN => '其他亲戚',
    ];

    const SCENARIO_PRE = 'pre';
    const SCENARIO_LOGIN = 'login';

    const LOGIN_FAIL = 1;
    const USER_CLOSED = 2;
    const WRONG_PASSWORD = 3;

    private $_passwordRaw = '';
    private $_expertId = 0;
    private $_doctor = false;
    public $iconFile = null;
    public $auth_key = '';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            ModelInfo::className(),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PRE] = ['phone', 'password'];
        $scenarios[self::SCENARIO_LOGIN] = ['phone', 'password'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'age', 'id_type', 'relation', 'status'], 'integer'],
            ['gender', 'in', 'range' => array_keys(self::$genderLabel)],
            ['id_type', 'in', 'range' => array_keys(self::$idTypeLabels)],
            ['relation', 'in', 'range' => array_keys(self::$relationLabels)],

            [['icon'], 'string', 'max' => 200],
            [['uid'], 'string', 'max' => 11],
            [['iconFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],

            [['name'], 'string', 'max' => 10],
            ['name', 'string', 'min' => 1],
            [['name'], 'required'],

            [['password'], 'required'],
            [['passwordRaw'], 'string', 'max' => 32],
            [['passwordRaw'], 'string', 'min' => 6],

            [['phone'], 'string', 'max' => 20], // TODO: CX phone filter
            [['phone'], 'string', 'min' => 11],
            [['phone'], 'unique'],
            [['phone'], 'required'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::$statusLabel)],

            [['id_number', 'email', 'profession', 'relative_name', 'relative_contact'], 'string', 'max' => 100],
            ['email', 'email'],
            [['address', 'remark'], 'string', 'max' => 1000],

            [['ctime'], 'safe'],
        ];
    }

    public function fields()
    {
        return [
            'uid',
            'name',
            'phone',
            'gender',
            'icon' => 'iconUrl',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户ID',
            'phone' => '手机号',
            'password' => '密码',
            'passwordRaw' => '密码',
            'name' => '姓名',
            'gender' => '性别',
            'genderName' => '性别',
            'icon' => '头像',
            'iconUrl' => '头像',
            'age' => '年龄',
            'id_type' => '证件类型',
            'idTypeName' => '证件类型',
            'id_number' => '证件号码',
            'email' => '电子邮箱',
            'address' => '住址',
            'profession' => '职业',
            'relation' => '与患者关系',
            'relative_name' => '家属名字',
            'relative_contact' => '家属联系方式',
            'status' => '状态',
            'ctime' => '创建时间',
            'remark' => '备注',
        ];
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->uid;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
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

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getIconUrl()
    {
        $icon = $this->icon;
        if (!$icon) {
            $icon = '/images/sys/icon_default.png';
        }
        return Yii::$app->params['img_host'] . $icon;
    }

    public function getExpertId()
    {
        if (!$this->_expertId) {
            $expert = Expert::findOne(['uid' => $this->uid]);
            $this->_expertId = $expert->expert_id;
        }
        return $this->_expertId;
    }

    /*-------------------*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = static::cache($id);
        if ($user && $user->status == self::STATUS_ACTIVE) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($uid = UserToken::auth($token)) {
            return static::findIdentity($uid);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['phone' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone]);
    }

    public static function login($phone, $password, $platform = 0, $device_id = '')
    {
        if (!$user = static::findOne(['phone' => $phone, 'password' => md5($password)])) {
            return self::LOGIN_FAIL;
        }

        if ($user->status != User::STATUS_ACTIVE) {
            return self::USER_CLOSED;
        }

        $user->login_time = date('Y-m-d H:i:s');
        $user->save();

        Yii::$app->db->createCommand('insert into login_log(uid, platform) VALUES (:uid, :platform)')
            ->bindValues([':uid' => $user->uid, ':platform' => $platform])
            ->execute();

        DeviceUser::create($user->uid, $device_id, $platform);

        $token = UserToken::create($user->uid);
        return ['user' => $user, 'token' => $token];
    }

    public static function logout($token, $uid, $device_id = '')
    {
        UserToken::remove($token);
        DeviceUser::remove($uid, $device_id);
    }

    public function changePwd($old_password, $password)
    {
        if (!$this->validatePassword($old_password)) {
            $this->addError('password', '原密码填写不正确');
            return false;
        }
        $this->passwordRaw = $password;
        if ($this->validate() && $this->save()) {
            return true;
        }
        return false;
    }

    public function beforeSave($insert)
    {
        foreach ($this->validators as $item) {
            $reflect = new \ReflectionClass($item);
            if ($reflect->getShortName() == 'ImageValidator') {
                foreach ($item->attributes as $key) {
                    $url_key = str_replace('File', '', $key);
                    $this->$key = UploadedFile::getInstance($this, $key);
                    if ($this->$key && $this->validate([$key], false)) {
                        $file = "/$url_key/" . md5($this->$key->baseName . rand(100, 999))
                            . '.' . $this->$key->extension;
                        $this->$url_key = $file;
                        $this->$key->saveAs(Yii::getAlias('@webroot') . $file);
                    }
                }
            }
        }
        if ($this->isNewRecord) {
            $this->uid = $this->makeUserId();
        }

        return parent::beforeSave($insert);
    }

    public function getGenderName()
    {
        return isset(User::$genderLabel[$this->gender]) ? User::$genderLabel[$this->gender] : '';
    }

    public function getStatusName()
    {
        return isset(User::$statusLabel[$this->status]) ? User::$statusLabel[$this->status] : '';
    }

    public function getIdTypeName()
    {
        return isset(User::$idTypeLabels[$this->id_type]) ? User::$idTypeLabels[$this->id_type] : '';
    }

    public function getRelationName()
    {
        return isset(User::$relationLabels[$this->relation]) ? User::$relationLabels[$this->relation] : '';
    }

    public function getDoctor()
    {
        if ($this->_doctor === false) {
            $this->_doctor = Doctor::findOne(['uid' => $this->uid, 'status' => Doctor::STATUS_NORMAL]);
        }
        return $this->_doctor;
    }

    public static function getList($name = '')
    {
        $d = self::find();
        if ($name) {
            $d->where(['like', 'name', $name]);
        }
        $d->orderBy(['name' => SORT_ASC]);
        $data = [];
        foreach ($d->all() as $item) {
            if (!$item->doctor) {
                $data[$item->uid] = $item->name;
            }
        }
        return $data;
    }

    public function makeUserId()
    {
        return substr(date('ymdH', strtotime($this->ctime)), 1) . rand(1000, 9999);
    }
}
