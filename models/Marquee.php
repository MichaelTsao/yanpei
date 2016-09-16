<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "marquee".
 *
 * @property integer $id
 * @property string $image
 * @property string $url
 * @property integer $sort
 * @property integer $status
 */
class Marquee extends \yii\db\ActiveRecord
{
    const STATUS_OK = 1;
    const STATUS_CLOSED = 2;
    public static $statusLabel = [
        self::STATUS_OK => '打开',
        self::STATUS_CLOSED => '关闭',
    ];
    public $imageFile = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marquee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'required'],
            [['sort', 'status'], 'integer'],
            [['image'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 1000],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => '图片',
            'imageFile' => '图片',
            'url' => '网址',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

    public function beforeSave($insert)
    {
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
}
