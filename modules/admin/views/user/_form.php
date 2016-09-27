<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'passwordRaw')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->dropDownList(\app\models\User::$statusLabel) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'profession')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'gender')->dropDownList(\app\models\User::$genderLabel) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'age')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'id_type')->dropDownList(\app\models\User::$idTypeLabels) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'id_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'iconFile')->fileInput() ?>
    <?= Html::img($model->icon, ['height' => 50]) ?>
    <br/><br/>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'relation')->dropDownList(\app\models\User::$relationLabels) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'relative_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'relative_contact')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
