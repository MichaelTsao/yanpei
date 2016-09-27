<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\HospitalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hospitals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create').Yii::t('app', 'Hospital'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'hospital_id',
            'name',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function ($data, $row) {
                    if ($data->icon) {
                        return Html::img($data->icon, ['height' => 50]);
                    }else{
                        return '';
                    }
                }
            ],
            'location',
            'contact',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
