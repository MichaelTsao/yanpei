<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MarqueeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Marquees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marquee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . Yii::t('app', 'Marquee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($data, $row) {
                    if ($data->image) {
                        return Html::img($data->image, ['height' => 100]);
                    }else{
                        return '';
                    }
                }
            ],
            'sort',
            [
                'attribute' => 'status',
                'filter' => \app\models\Marquee::$statusLabel,
                'value' => function($model){
                    return \app\models\Marquee::$statusLabel[$model->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
