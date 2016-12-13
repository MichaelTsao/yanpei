<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "doctor".
 *
 * @property integer $uid
 * @property string $name
 * @property string $cover
 * @property string $education
 * @property string $school
 * @property string $title
 * @property string $company
 * @property string $intro
 * @property string $work_location
 * @property integer $on_job
 * @property string $remark
 * @property integer $status
 * @property integer $sort
 * @property integer $top
 * @property integer $rate
 */
class Doctor extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL = 1;
    const STATUS_APPLY = 2;
    public static $statuses = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_APPLY => '申请',
    ];

    const TOP_NO = 0;
    const TOP_YES = 1;
    public static $tops = [
        self::TOP_NO => '不置顶',
        self::TOP_YES => '置顶',
    ];

    const ON_JOB_YES = 1;
    const ON_JOB_NO = 2;
    public static $on_jobs = [
        self::ON_JOB_YES => '在职',
        self::ON_JOB_NO => '不在职',
    ];

    public $_user = null;
    public $_service = null;
    public $coverFile = null;
    public $services = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'name', 'company', 'title', 'work_location', 'intro', 'services'], 'required'],
            [['status', 'sort', 'top'], 'integer'],
            [['intro'], 'string'],
            [['education', 'school', 'company', 'cover'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 100],
            [['uid'], 'string', 'max' => 11],
            [['user', 'service', 'services'], 'safe'],
            [['coverFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['on_job'], 'integer'],
            [['name', 'cover', 'education', 'school', 'company', 'work_location'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户ID',
            'name' => '姓名',
            'cover' => '封面',
            'coverFile' => '封面',
            'education' => '学历',
            'school' => '毕业学校',
            'title' => '职称',
            'company' => '公司',
            'intro' => '个人介绍',
            'work_location' => '工作地址',
            'on_job' => '是否在职',
            'services' => '服务项目',
            'status' => '状态',
            'sort' => '排序',
            'top' => '置顶',
            'remark' => '备注',
        ];
    }

    public function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::findOne($this->uid);
        }
        return $this->_user;
    }


    public function getUsers()
    {
        return $this->hasOne(User::className(), ['uid' => 'uid']);
    }

    public function getService()
    {
        if (!$this->_service) {
            $this->_service = DoctorService::findAll($this->uid);
        }
        return $this->_service;
    }

    public function afterFind()
    {
        $s = [];
        $data = DoctorService::findAll(['uid' => $this->uid]);
        foreach ($data as $item) {
            $s[] = $item->service_id;
        }
        $this->services = $s;
    }

    public function beforeSave($insert)
    {
        DoctorService::deleteAll(['uid' => $this->uid]);
        foreach ($this->services as $service) {
            $ds = new DoctorService();
            $ds->uid = $this->uid;
            $ds->service_id = $service;
            $ds->save();
        }

        foreach ($this->validators as $item) {
            $reflect = new \ReflectionClass($item);
            if ($reflect->getShortName() == 'ImageValidator') {
                foreach ($item->attributes as $key) {
                    $url_key = str_replace('File', '', $key);
                    if ($this->$key && $this->validate([$key], false)) {
                        $file = "/$url_key/" . md5($this->$key->baseName . rand(100, 999))
                            . '.' . $this->$key->extension;
                        $this->$url_key = $file;
                        $this->$key->saveAs(Yii::getAlias('@webroot') . $file);
                    }
                }
            }
        }

        return parent::beforeSave($insert);
    }

    public function beforeValidate()
    {
        foreach ($this->validators as $item) {
            $reflect = new \ReflectionClass($item);
            if ($reflect->getShortName() == 'ImageValidator') {
                foreach ($item->attributes as $key) {
                    $this->$key = UploadedFile::getInstance($this, $key);
                }
            }
        }

        return parent::beforeValidate();
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
            $data[$item->uid] = $item->name;
        }
        return $data;
    }

    public static function getLocations()
    {
        return ['0' => '全部'] + self::find()->select(['work_location'])->distinct()->indexBy('work_location')
                ->asArray()->column();
    }

    public function getRate()
    {
        $query = Orders::find()->where(['doctor_id' => $this->uid, 'status' => Orders::STATUS_FINISH]);
        if ($all = $query->count()) {
            return round($query->sum('rate') / $all);
        } else {
            return 0;
        }
    }
}
