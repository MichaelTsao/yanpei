<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'uid')->dropDownList(\app\models\User::getList()) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'doctor_id')->dropDownList(\app\models\Doctor::getList()) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>

        <div class="col-md-1">
            <?= $form->field($model, 'gender')->dropDownList(\app\models\User::$genderLabel) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'age')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'relation_contact')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <b>耳聋发生时间</b>
            <?php
            echo \yii\jui\DatePicker::widget([
                'model' => $model,
                'attribute' => 'deaf_date',
                'language' => 'zh-CN',
                'dateFormat' => 'yyyy-MM-dd',
            ]);
            ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'deaf_side')->dropDownList(\app\models\Cases::$earSide) ?>
        </div>
    </div>

    <?= $form->field($model, 'canHears')->checkboxList(\app\models\Cases::$canHear) ?>

    <?= $form->field($model, 'hardCases')->checkboxList(\app\models\Cases::$hardCase) ?>

    <?= $form->field($model, 'treat_result')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'weared')->dropDownList(\app\models\Cases::$has) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'weared_side')->dropDownList(\app\models\Cases::$earSide) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'aid_type')->dropDownList(\app\models\Cases::$aidType) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'left_type')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'right_type')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'effect')->dropDownList(\app\models\Cases::$effects) ?>
        </div>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">耳聋时伴有何其他症状</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 col-md-1">
                    <?= $form->field($model, 'er_ming')->dropDownList(\app\models\Cases::$earSide) ?>
                </div>

                <div class="col-xs-3 col-md-1">
                    <?= $form->field($model, 'xuan_yun')->dropDownList(\app\models\Cases::$has) ?>
                </div>

                <div class="col-xs-3 col-md-1">
                    <?= $form->field($model, 'er_tong')->dropDownList(\app\models\Cases::$earSide) ?>
                </div>

                <div class="col-xs-4 col-md-2">
                    <?= $form->field($model, 'fen_mi_wu')->dropDownList(\app\models\Cases::$earSide) ?>
                </div>

                <div class="col-xs-4 col-md-2">
                    <?= $form->field($model, 'operation_history')->dropDownList(\app\models\Cases::$has) ?>
                </div>

                <div class="col-xs-3 col-md-1">
                    <?= $form->field($model, 'zao_yin')->dropDownList(\app\models\Cases::$has) ?>
                </div>

                <div class="col-xs-3 col-md-2">
                    <?= $form->field($model, 'wai_shang')->dropDownList(\app\models\Cases::$has) ?>
                </div>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'family_history')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_history')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ills')->checkboxList(\app\models\Ill::getList(\app\models\Ill::TYPE_ILL)) ?>

    <?= $form->field($model, 'cure_condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'toxics')->checkboxList(\app\models\Ill::getList(\app\models\Ill::TYPE_TOXIC)) ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'use_medicine')->dropDownList(\app\models\Cases::$has) ?>
        </div>

        <div class="col-md-11">
            <?= $form->field($model, 'medicine')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'allergy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kan_hua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intelligent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mental')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">耳科检查</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'left_er_kuo')->dropDownList(\app\models\Cases::$erKuo) ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'right_er_kuo')->dropDownList(\app\models\Cases::$erKuo) ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'left_er_dao')->dropDownList(\app\models\Cases::$erDao) ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'right_er_dao')->dropDownList(\app\models\Cases::$erDao) ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'left_gu_mo')->dropDownList(\app\models\Cases::$guMo) ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'right_gu_mo')->dropDownList(\app\models\Cases::$guMo) ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'left_ru_tu')->dropDownList(\app\models\Cases::$ruTu) ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'right_ru_tu')->dropDownList(\app\models\Cases::$ruTu) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">鼓室图</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'chun_yin_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'chun_yin_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'sa_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'sa_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'tpp_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-1">
                    <?= $form->field($model, 'tpp_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'gushi_type_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'gushi_type_right')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">言语识别</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'ceshi_qiangdu_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'ceshi_qiangdu_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'shibie_rate_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'shibie_rate_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xinzao_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xinzao_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'cibiao_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'cibiao_right')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">试听</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'jixing1_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xiaoguo1_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'remark1_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'jixing2_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xiaoguo2_left')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'remark2_left')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'jixing1_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xiaoguo1_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'remark1_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'jixing2_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'xiaoguo2_right')->textInput() ?>
                </div>

                <div class="col-xs-6 col-md-2">
                    <?= $form->field($model, 'remark2_right')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-md-6">
            <?= $form->field($model, 'left_ce_tingFile')->fileInput() ?>
            <?= Html::img($model->left_ce_ting, ['height' => 50]) ?>
            <br/><br/>
        </div>
        <div class="col-xs-6 col-md-6">
            <?= $form->field($model, 'right_ce_tingFile')->fileInput() ?>
            <?= Html::img($model->right_ce_ting, ['height' => 50]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

