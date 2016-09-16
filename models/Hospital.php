<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "hospital".
 *
 * @property integer $hospital_id
 * @property string $name
 * @property string $icon
 * @property string $location
 * @property string $desc
 */
class Hospital extends \yii\db\ActiveRecord
{
    public $iconFile = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location', 'icon', 'desc'], 'string', 'max' => 200],
            [['iconFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hospital_id' => '医院ID',
            'name' => '名字',
            'icon' => '图片',
            'iconFile' => '图片',
            'location' => '地址',
            'desc' => '描述',
        ];
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

        return parent::beforeSave($insert);
    }

    public static function getList()
    {
        $r = [];
        $data = self::find()->all();
        foreach ($data as $item) {
            $r[$item->hospital_id] = $item->name;
        }
        return $r;
    }
}
