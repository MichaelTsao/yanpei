<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cases */

$this->title = $model->user->name . '-' . $model->case_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->case_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->case_id], [
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
            'case_id',
            [
                'attribute' => 'user.name',
                'label' => '用户',
            ],
            [
                'attribute' => 'doctor.name',
                'label' => '验配师',
            ],
            'name',
            [
                'attribute' => 'gender',
                'value' => $model->genderName,
            ],
            'age',
            'address',
            'relation_contact',
            'deaf_date',
            [
                'attribute' => 'can_listen',
                'value' => implode('、', $model->canHearName),
            ],
            [
                'attribute' => 'hard_case',
                'value' => implode('、', $model->hardCaseName),
            ],
            [
                'attribute' => 'deaf_side',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$earSide, $model->deaf_side),
            ],
            'treat_result',
            [
                'attribute' => 'weared',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->weared)
            ],
            [
                'attribute' => 'weared_side',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$earSide, $model->weared_side)
            ],
            [
                'attribute' => 'aid_type',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$aidType, $model->aid_type)
            ],
            'left_type',
            'right_type',
            [
                'attribute' => 'effect',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$effects, $model->effect)
            ],
            [
                'attribute' => 'er_ming',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$earSide, $model->er_ming)
            ],
            [
                'attribute' => 'xuan_yun',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->xuan_yun)
            ],
            [
                'attribute' => 'er_tong',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$earSide, $model->er_tong)
            ],
            [
                'attribute' => 'fen_mi_wu',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$earSide, $model->fen_mi_wu)
            ],
            [
                'attribute' => 'operation_history',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->operation_history)
            ],
            [
                'attribute' => 'zao_yin',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->zao_yin)
            ],
            [
                'attribute' => 'wai_shang',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->wai_shang)
            ],
            'family_history',
            'person_history',
            [
                'attribute' => 'ill_condition',
                'value' => implode('、', $model->illName),
            ],
            'cure_condition',
            [
                'attribute' => 'toxic',
                'value' => implode('、', $model->toxicName),
            ],
            [
                'attribute' => 'use_medicine',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$has, $model->use_medicine)
            ],
            'medicine',
            'allergy',
            'kan_hua',
            'intelligent',
            'mental',
            'remark',
            [
                'attribute' => 'left_er_kuo',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$erKuo, $model->left_er_kuo)
            ],
            [
                'attribute' => 'right_er_kuo',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$erKuo, $model->right_er_kuo)
            ],
            [
                'attribute' => 'left_er_dao',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$erDao, $model->left_er_dao)
            ],
            [
                'attribute' => 'right_er_dao',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$erDao, $model->right_er_dao)
            ],
            [
                'attribute' => 'left_gu_mo',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$guMo, $model->left_gu_mo)
            ],
            [
                'attribute' => 'right_gu_mo',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$guMo, $model->right_gu_mo)
            ],
            [
                'attribute' => 'left_ru_tu',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$ruTu, $model->left_ru_tu)
            ],
            [
                'attribute' => 'right_ru_tu',
                'value' => \app\models\base\Common::showArrayValue(\app\models\Cases::$ruTu, $model->right_ru_tu)
            ],
            [
                'attribute' => 'left_ce_ting',
                'format' => 'raw',
                'value' => Html::img($model->left_ce_ting, ['height' => 100]),
            ],
            [
                'attribute' => 'right_ce_ting',
                'format' => 'raw',
                'value' => Html::img($model->right_ce_ting, ['height' => 100]),
            ],
            'chun_yin_left',
            'sa_left',
            'tpp_left',
            'gushi_type_left',
            'ceshi_qiangdu_left',
            'shibie_rate_left',
            'xinzao_left',
            'cibiao_left',
            'jixing1_left',
            'xiaoguo1_left',
            'remark1_left',
            'jixing2_left',
            'xiaoguo2_left',
            'remark2_left',
            'chun_yin_right',
            'sa_right',
            'tpp_right',
            'gushi_type_right',
            'ceshi_qiangdu_right',
            'shibie_rate_right',
            'xinzao_right',
            'cibiao_right',
            'jixing1_right',
            'xiaoguo1_right',
            'remark1_right',
            'jixing2_right',
            'xiaoguo2_right',
            'remark2_right',
            'ctime',
        ],
    ]) ?>

</div>
