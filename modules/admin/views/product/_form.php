<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Sortable;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'type')->dropDownList(\app\models\ProductType::getList()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'brand')->dropDownList(\app\models\Brand::getList()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'battery')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?= $form->field($model, 'iconFile')->fileInput() ?>
    <?php if ($model->icon): ?>
        <?= Html::img($model->icon, ['height' => 50]) ?>
    <?php endif ?>
    <br/><br/>


    <?= $form->field($model, 'info')->textArea(['rows' => 4]) ?>
    <?= $form->field($model, 'buy_url')->textInput() ?>

    <?php
    $config = [
        'options' => ['tag' => 'ul', 'style' => 'border: 1px solid #eee; min-height: 30px; list-style-type: decimal;'],
        'itemOptions' => ['tag' => 'li'],
        'clientOptions' => [
            'cursor' => 'move',
            'connectWith' => '.ui-sortable',
            'placeholder' => "ui-state-highlight",
        ],
    ];
    $types = ['scope' => \app\models\Feature::TYPE_SCOPE, 'feature' => \app\models\Feature::TYPE_COMMON];
    $format = '<h4><span class="label label-primary" id="!ID!">!NAME!</span></h4>';
    ?>

    <?php foreach ($types as $type_key => $type_value): ?>

        <?= $form->field($model, $type_key)->hiddenInput() ?>

        <?php
        $feature_no = [];
        $feature_yes = [];

        if (isset($not_select[$type_value])) {
            foreach ($not_select[$type_value] as $item) {
                $feature_no[] = str_replace('!NAME!', $item->name, str_replace('!ID!', $item->feature_id, $format));
            }
        }
        if (isset($select[$type_value])) {
            foreach ($select[$type_value] as $item) {
                $feature_yes[] = str_replace('!NAME!', $item->name, str_replace('!ID!', $item->feature_id, $format));
            }
        }

        ?>
        <div class="row">
            <div class="col-md-6">
                可选
                <?php
                $config['items'] = $feature_no;
                echo Sortable::widget($config);
                ?>
            </div>
            <div class="col-md-6">
                已选
                <?php
                $config['items'] = $feature_yes;
                $config['clientOptions']['update'] = new \yii\web\JsExpression("function( event, ui ) {setList('" . $type_key . "');}");
                echo Sortable::widget($config);
                ?>
            </div>
        </div>

        <div class="row">&nbsp;</div>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function setList(id) {
        var lid = '';
        var ids = new Array();
        if (id == 'scope') {
            lid = 'w2';
        } else {
            lid = 'w4';
        }
        $('#' + lid).children().each(function () {
            ids.push($($(this).children()[0]).children()[0].id);
        });
        $('#product-' + id).val(ids.join(','));
    }
</script>