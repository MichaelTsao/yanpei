<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= ''//Html::a(Yii::t('app', 'Create') . Yii::t('app', 'Orders'), ['create'], ['class' => 'btn btn-success'])   ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            [
                'value' => 'doctor.users.name',
                'label' => '医生',
            ],
            [
                'value' => 'user.name',
                'label' => '病人',
            ],
            [
                'value' => 'service.name',
                'label' => '服务',
            ],
            [
                'value' => function($data){
                    $p = [];
                    foreach ($data->products as $item) {
                        $p[] = $item->product->name;
                    }
                    return implode(', ', $p);
                },
                'label' => '产品',
            ],
            [
                'attribute' => 'status',
                'value' => function($data){
                    return \app\models\Orders::$statusList[$data->status];
                },
                'filter' => \app\models\Orders::$statusList,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
