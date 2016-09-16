<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CasesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'case_id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'deaf_date') ?>

    <?= $form->field($model, 'can_listen') ?>

    <?php // echo $form->field($model, 'hard_case') ?>

    <?php // echo $form->field($model, 'deaf_side') ?>

    <?php // echo $form->field($model, 'treat_result') ?>

    <?php // echo $form->field($model, 'weared') ?>

    <?php // echo $form->field($model, 'weared_side') ?>

    <?php // echo $form->field($model, 'aid_type') ?>

    <?php // echo $form->field($model, 'left_type') ?>

    <?php // echo $form->field($model, 'right_type') ?>

    <?php // echo $form->field($model, 'effect') ?>

    <?php // echo $form->field($model, 'er_ming') ?>

    <?php // echo $form->field($model, 'xuan_yun') ?>

    <?php // echo $form->field($model, 'er_tong') ?>

    <?php // echo $form->field($model, 'fen_mi_wu') ?>

    <?php // echo $form->field($model, 'operation_history') ?>

    <?php // echo $form->field($model, 'zao_yin') ?>

    <?php // echo $form->field($model, 'wai_shang') ?>

    <?php // echo $form->field($model, 'family_history') ?>

    <?php // echo $form->field($model, 'person_history') ?>

    <?php // echo $form->field($model, 'ill_condition') ?>

    <?php // echo $form->field($model, 'cure_condition') ?>

    <?php // echo $form->field($model, 'toxic') ?>

    <?php // echo $form->field($model, 'use_medicine') ?>

    <?php // echo $form->field($model, 'medicine') ?>

    <?php // echo $form->field($model, 'allergy') ?>

    <?php // echo $form->field($model, 'kan_hua') ?>

    <?php // echo $form->field($model, 'intelligent') ?>

    <?php // echo $form->field($model, 'mental') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'left_er_kuo') ?>

    <?php // echo $form->field($model, 'right_er_kuo') ?>

    <?php // echo $form->field($model, 'left_er_dao') ?>

    <?php // echo $form->field($model, 'right_er_dao') ?>

    <?php // echo $form->field($model, 'left_gu_mo') ?>

    <?php // echo $form->field($model, 'right_gu_mo') ?>

    <?php // echo $form->field($model, 'left_ru_tu') ?>

    <?php // echo $form->field($model, 'right_ru_tu') ?>

    <?php // echo $form->field($model, 'left_ce_ting') ?>

    <?php // echo $form->field($model, 'right_ce_ting') ?>

    <?php // echo $form->field($model, 'ctime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
