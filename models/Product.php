<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property string $name
 * @property integer $type
 * @property integer $price
 * @property string $icon
 * @property integer $brand
 * @property string $battery
 * @property string $info
 * @property integer $sort
 * @property string $buy_url
 */
class Product extends \yii\db\ActiveRecord
{
    public $iconFile = null;
    public $features = [];
    public $scopes = [];
    public $feature = '';
    public $scope = '';
    public static $priceSection = [
        1 => '0~1500',
        2 => '1500~6000',
        3 => '6000~15000',
        4 => '15000~30000',
        5 => '>30000',
    ];
    public static $priceSectionArray = [
        1 => [0, 1500],
        2 => [1501, 6000],
        3 => [6001, 15000],
        4 => [15001, 30000],
        5 => [30001, 1000000],
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'brand', 'type', 'sort'], 'integer'],
            [['name', 'icon', 'battery'], 'string', 'max' => 200],
            [['buy_url'], 'string', 'max' => 1000],
            [['iconFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['info'], 'string'],
            [['features', 'scopes', 'feature', 'scope'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => '产品ID',
            'name' => '名字',
            'type' => '分类',
            'price' => '价格',
            'icon' => '图片',
            'iconFile' => '图标',
            'brand' => '品牌',
            'battery' => '电池',
            'info' => '描述',
            'features' => '功能点',
            'scopes' => '验配范围',
            'feature' => '功能点',
            'scope' => '验配范围',
            'sort' => '排序',
            'buy_url' => '购买链接',
        ];
    }

    public function afterFind()
    {
        $data = ProductFeature::find()->where(['product_id' => $this->product_id])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($data as $item) {
            if ($feature = Feature::findOne($item->feature_id)) {
                if ($feature->type == Feature::TYPE_SCOPE) {
                    $this->scopes[] = $feature->feature_id;
                }
                if ($feature->type == Feature::TYPE_COMMON) {
                    $this->features[] = $feature->feature_id;
                }
            }
        }
        $this->scope = implode(',', $this->scopes);
        $this->feature = implode(',', $this->features);
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

    public function afterSave($insert, $changedAttributes)
    {
        $this->scopes = explode(',', $this->scope);
        $this->features = explode(',', $this->feature);

        ProductFeature::deleteAll(['product_id' => $this->product_id]);

        $sort = 1;
        foreach ($this->scopes as $fid) {
            $pf = new ProductFeature();
            $pf->product_id = $this->product_id;
            $pf->feature_id = $fid;
            $pf->sort = $sort;
            $pf->save();
            $sort++;
        }

        $sort = 1;
        foreach ($this->features as $fid) {
            $pf = new ProductFeature();
            $pf->product_id = $this->product_id;
            $pf->feature_id = $fid;
            $pf->sort = $sort;
            $pf->save();
            $sort++;
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public static function getList()
    {
        return self::find()->select(['name'])->indexBy('product_id')->asArray()->column();
    }

    public static function getData($keyword = '', $brand = '', $battery = '', $price = '')
    {
        $query = self::find()->orderBy(['sort' => SORT_DESC]);
        if ($keyword) {
            $query->where(['like', 'name', $keyword]);
        }
        if ($brand) {
            $query->andWhere(['brand' => $brand]);
        }
        if ($battery) {
            $query->andWhere(['battery' => $battery]);
        }
        if ($price && isset(self::$priceSectionArray[$price])) {
            $query->andWhere(['between', 'price', self::$priceSectionArray[$price][0], self::$priceSectionArray[$price][1]]);
        }
        return $query->all();
    }

    public static function getBattery()
    {
        return self::find()
            ->select('battery')
            ->distinct(true)
            ->where(['not', ['battery' => '']])
            ->indexBy('battery')
            ->asArray()
            ->column();
    }
}
