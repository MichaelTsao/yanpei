<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $form yii\widgets\ActiveForm */
/* @var $user app\models\User */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($user, 'passwordRaw')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($user, 'profession')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($user, 'gender')->dropDownList(\app\models\User::$genderLabel) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($user, 'age')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($user, 'id_type')->dropDownList(\app\models\User::$idTypeLabels) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($user, 'id_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'uid')->label(false)->hiddenInput() ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>

        <div class="col-md-1">
            <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-1">
            <?= $form->field($model, 'on_job')->dropDownList(\app\models\Doctor::$on_jobs) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'work_location')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($user, 'iconFile')->fileInput() ?>
            <?= Html::img($user->icon, ['height' => 50]) ?>
            <br/>
            <br/>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'coverFile')->fileInput() ?>
            <?= Html::img($model->cover, ['height' => 150]) ?>
            <br/>
            <br/>
        </div>

        <div class="col-md-7">
            <?= $form->field($model, 'intro')->textarea(['rows' => 9]) ?>
        </div>
    </div>

    <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'services')->checkboxList(\app\models\Service::getList()) ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'status')->dropDownList(\app\models\Doctor::$statuses) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'top')->dropDownList(\app\models\Doctor::$tops) ?>
        </div>
        <div class="col-md-9">
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
