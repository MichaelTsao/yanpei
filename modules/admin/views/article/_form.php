<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'type')->dropDownList(\app\models\ArticleType::getList()) ?>
    <?= $form->field($model, 'iconFile')->fileInput() ?>
    <?= Html::img($model->icon, ['height' => 50]) ?>
    <br/><br/>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
