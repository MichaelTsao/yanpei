<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_type".
 *
 * @property integer $id
 * @property string $name
 */
class ArticleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名字',
        ];
    }

    public static function getList()
    {
        $r = [];
        $data = self::find()->all();
        foreach ($data as $item) {
            $r[$item->id] = $item->name;
        }
        return $r;
    }
}
