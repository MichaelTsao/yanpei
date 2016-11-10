<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'passwordRaw')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'status')->dropDownList(\app\models\Account::$statusLabel) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'role')->dropDownList(\app\models\Account::$roles) ?>
        </div>
    </div>

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
