<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ''//Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary'])   ?>
        <?= ''//Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->order_id], [
        //'class' => 'btn btn-danger',
        //'data' => [
        //    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        //   'method' => 'post',
        //    ],
        //])   ?>
    </p>

    <?php
    $p = [];
    foreach ($model->products as $item) {
        $p[] = $item->product->name;
    }
    $product_name = implode(', ', $p);
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            [
                'attribute' => 'doctor.user.name',
                'label' => '医师',
            ],
            [
                'attribute' => 'user.name',
                'label' => '病人',
            ],
            [
                'attribute' => 'serviceName',
                'label' => '服务项目',
            ],
            [
                'attribute' => 'product.name',
                'label' => '产品',
                'value' => $product_name
            ],
            [
                'attribute' => 'hospital.name',
                'label' => '医疗中心',
            ],
            [
                'attribute' => 'office.name',
                'label' => '验配室',
            ],
            'appoint_date',
            [
                'attribute' => 'time_section',
                'value' => isset(\app\models\Office::$time_section[$model->time_section]) ? \app\models\Office::$time_section[$model->time_section] : '未设置',
            ],
            [
                'attribute' => 'status',
                'value' => \app\models\Orders::$statusList[$model->status],
            ],
            'ctime',
        ],
    ]) ?>

</div>
