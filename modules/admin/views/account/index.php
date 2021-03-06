<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . Yii::t('app', 'Account'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return \app\models\Account::$statusLabel[$data->status];
                },
                'filter' => \app\models\Account::$statusLabel,
            ],
            [
                'attribute' => 'role',
                'value' => function ($data) {
                    return \app\models\Account::$roles[$data->role];
                },
                'filter' => \app\models\Account::$roles,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
