<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add') . Yii::t('app', 'Store'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'hospital_id',
                'value' => function($data){
                    return \app\models\Hospital::getList()[$data->hospital_id];
                },
                'filter' => \app\models\Hospital::getList(),
            ],
            [
                'attribute' => 'product_id',
                'value' => function($data){
                    return \app\models\Product::getList()[$data->product_id];
                },
                'filter' => \app\models\Product::getList(),
            ],
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
