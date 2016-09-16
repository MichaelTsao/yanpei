<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Marquee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marquee-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'imageFile')->fileInput() ?>
            <?= Html::img($model->image, ['height' => 200]) ?>
            <br/><br/>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'url')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'sort')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->dropDownList(\app\models\Marquee::$statusLabel) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
