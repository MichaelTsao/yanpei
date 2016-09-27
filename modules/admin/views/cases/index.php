<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . Yii::t('app', 'Cases'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'case_id',
            [
                'attribute' => 'uid',
                'value' => 'user.name',
                'label' => '病人',
                'filter' => \app\models\Cases::getUsers(),
            ],
            [
                'attribute' => 'doctor_id',
                'value' => 'doctor.name',
                'label' => '验配师',
                'filter' => \app\models\Cases::getDoctors(),
            ],
            'deaf_date',
//            'can_listen',
            // 'hard_case',
            // 'deaf_side',
            // 'treat_result',
            // 'weared',
            // 'weared_side',
            // 'aid_type',
            // 'left_type',
            // 'right_type',
            // 'effect',
            // 'er_ming',
            // 'xuan_yun',
            // 'er_tong',
            // 'fen_mi_wu',
            // 'operation_history',
            // 'zao_yin',
            // 'wai_shang',
            // 'family_history',
            // 'person_history',
            // 'ill_condition',
            // 'cure_condition',
            // 'toxic',
            // 'use_medicine',
            // 'medicine',
            // 'allergy',
            // 'kan_hua',
            // 'intelligent',
            // 'mental',
            // 'remark',
            // 'left_er_kuo',
            // 'right_er_kuo',
            // 'left_er_dao',
            // 'right_er_dao',
            // 'left_gu_mo',
            // 'right_gu_mo',
            // 'left_ru_tu',
            // 'right_ru_tu',
            // 'left_ce_ting',
            // 'right_ce_ting',
            'ctime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
