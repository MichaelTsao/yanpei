<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $icon
 * @property string $content
 * @property integer $type
 * @property integer $typeName
 * @property string $ctime
 */
class Article extends \yii\db\ActiveRecord
{
    public $iconFile = null;
    private $_typeName = '';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title', 'icon'], 'string', 'max' => 200],
            [['iconFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['type'], 'integer'],
            [['ctime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'icon' => '图标',
            'iconFile' => '图标',
            'content' => '文章内容',
            'type' => '分类',
            'typeName' => '分类',
            'ctime' => '创建时间',
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

    public function getTypeName()
    {
        if (!$this->_typeName) {
            if ($at = ArticleType::findOne($this->type)){
                $this->_typeName = $at->name;
            }
        }
        return $this->_typeName;
    }
}
