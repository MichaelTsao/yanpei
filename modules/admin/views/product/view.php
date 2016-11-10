<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $scope string */
/* @var $feature string */
/* @var $brandList array */
/* @var $productTypeList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'name',
            [
                'attribute' => 'type',
                'value' => isset($productTypeList[$model->type]) ? $productTypeList[$model->type] : '',
            ],
            'price',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => Html::img($model->icon, ['height' => 50]),
            ],
            [
                'attribute' => 'brand',
                'value' => isset($brandList[$model->brand]) ? $brandList[$model->brand] : '',
            ],
            [
                'attribute' => 'scopes',
                'value'=> $scope,
            ],
            'battery',
            [
                'attribute' => 'info',
            ],
            [
                'format' => 'html',
                'attribute' => 'features',
                'value'=> $feature,
            ],
        ],
    ]) ?>

</div>
