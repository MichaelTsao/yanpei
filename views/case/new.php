<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 上午10:14
 */

use yii\widgets\ActiveForm;

?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>新建病历</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>专家团队 &gt; </li>
                <li>联系专家 &gt; </li>
                <li>查看病历 &gt; </li>
                <li>新建病历</li>
            </ul>
        </div>
        <div class="personal_box clearfix new-cases_box">
            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>病历类型</h1>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <button <?= $type == 1 ? 'class="active"' : ''?> onclick="window.location.href='?type=1'">
                                成人病历
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button <?= $type == 2 ? 'class="active"' : ''?> onclick="window.location.href='?type=2'">
                                儿童病历
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($model, 'type')->hiddenInput()->label(false); ?>
            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>基本信息</h1>
                <table>
                    <tr>
                        <td>姓名:</td>
                        <td>
                            <?= $form->field($model, 'name')->label(false); ?>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td> 性别:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'gender')->radioList(\app\models\User::$genderLabel, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>年龄:</td>
                        <td>
                            <?= $form->field($model, 'age')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>现居住地:</td>
                        <td>
                            <?= $form->field($model, 'address')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <?php if ($type == 1):?>
                        <tr>
                            <td>家属姓名及联系方式:</td>
                            <td>
                                <?= $form->field($model, 'relation_contact')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                    <?php else:?>
                        <tr>
                            <td>父亲姓名:</td>
                            <td>
                                <?= $form->field($model, 'father_name')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>父亲年龄:</td>
                            <td>
                                <?= $form->field($model, 'father_age')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>父亲职业:</td>
                            <td>
                                <?= $form->field($model, 'father_occupation')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>父亲文化程度:</td>
                            <td>
                                <?= $form->field($model, 'father_edu')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>父亲听力情况:</td>
                            <td>
                                <?= $form->field($model, 'father_hear')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>母亲姓名:</td>
                            <td>
                                <?= $form->field($model, 'mother_name')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>母亲年龄:</td>
                            <td>
                                <?= $form->field($model, 'mother_age')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>母亲职业:</td>
                            <td>
                                <?= $form->field($model, 'mother_occupation')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>母亲文化程度:</td>
                            <td>
                                <?= $form->field($model, 'mother_edu')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>母亲听力情况:</td>
                            <td>
                                <?= $form->field($model, 'mother_hear')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                    <?php endif;?>
                </table>
            </div>
            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>耳聋史</h1>
                <table>
                    <?php if ($type == 2):?>
                        <tr>
                            <td>幼时耳聋情况:</td>
                            <td>
                                <?= $form->field($model, 'deaf_status')->
                                dropDownList(\app\models\Cases::$deaf_statuses, ['style' => '-webkit-appearance: menulist'])
                                    ->label(false); ?>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                    <?php endif;?>
                    <tr>
                        <td>耳聋时间:</td>
                        <td>
                            <?= $form->field($model, 'deaf_date')->label(false); ?>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>受损耳:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'deaf_side')->radioList(\app\models\Cases::$earSide, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>对何种声音可以听见:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'canHears')->checkboxList(\app\models\Cases::$canHear, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'checkbox',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>交流困难的情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'hardCases')->checkboxList(\app\models\Cases::$hardCase, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'checkbox',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>诊断结果:</td>
                        <td>
                            <?= $form->field($model, 'treat_result')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>是否佩戴过助听器:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'weared')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>佩戴边:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'weared_side')->radioList(\app\models\Cases::$earSide, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>助听器类型:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'aid_type')->radioList(\app\models\Cases::$aidType, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>左耳型号:</td>
                        <td>
                            <?= $form->field($model, 'left_type')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>右耳型号:</td>
                        <td>
                            <?= $form->field($model, 'right_type')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>佩戴效果:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'effect')->radioList(\app\models\Cases::$effects, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <?php if ($type == 2):?>
                        <tr>
                            <td>进入语言训练机构:</td>
                            <td>
                                <?= $form->field($model, 'school')->label(false); ?>
                                <p> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>家庭训练情况:</td>
                            <td>
                                <?= $form->field($model, 'home_train')->
                                dropDownList(\app\models\Cases::$home_trains, ['style' => '-webkit-appearance: menulist'])
                                    ->label(false); ?>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                    <?php endif;?>
                    <tr>
                        <td>耳鸣情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'er_ming')->radioList(\app\models\Cases::$earSide, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>眩晕情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'xuan_yun')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>耳痛情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'er_tong')->radioList(\app\models\Cases::$earSide, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>耳分泌物情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'fen_mi_wu')->radioList(\app\models\Cases::$earSide, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>耳部手术史情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'operation_history')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>噪音暴露:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'zao_yin')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>头部外伤史:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'wai_shang')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>家族病史:</td>
                        <td>
                            <?= $form->field($model, 'family_history')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                </table>
            </div>

            <?php if ($type == 2):?>
            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>出生史</h1>
                <table>
                    <tr>
                        <td>母亲传染病史:</td>
                        <td>
                            <?= $form->field($model, 'mother_ill_history')->label(false); ?>
                            <p> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>母亲耳中毒药物史:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'mother_toxics')->checkboxList(\app\models\Ill::getList(\app\models\Ill::TYPE_TOXIC), [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'checkbox',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>母亲用药情况:</td>
                        <td>
                            <?= $form->field($model, 'mother_medicine')->label(false); ?>
                            <p> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>保胎药情况:</td>
                        <td>
                            <?= $form->field($model, 'baotaiyao')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>高血压情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'gaoxueya')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>妊娠反应情况:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'renshenfanying')->radioList(\app\models\Cases::$renshen, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>妊娠外伤史:</td>
                        <td>
                            <?= $form->field($model, 'renshen_hurt')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>妊娠期其他疾病:</td>
                        <td>
                            <?= $form->field($model, 'renshen_ill')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>足月顺产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'shunchan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                        <td>早产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'zaochan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>生产月份:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'birth_month')->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>难产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'nanchan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                        <td>助产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'zhuchan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>引产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'yinchan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                        <td>剖腹产:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'paofuchan')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>生产时缺氧:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'queyang')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                        <td>脐带绕颈:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'raojing')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>孩子体重:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'tizhong')->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                </table>
            </div>
            <?php endif;?>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>个人病史</h1>
                <table>
                    <tr>
                        <td>耳聋前传染病史:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'ills')->checkboxList(\app\models\Ill::getList(\app\models\Ill::TYPE_ILL), [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'checkbox',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>患病时情况:</td>
                        <td>
                            <?= $form->field($model, 'person_history')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>治疗情况:</td>
                        <td>
                            <?= $form->field($model, 'cure_condition')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>中毒史:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'toxics')->checkboxList(\app\models\Ill::getList(\app\models\Ill::TYPE_TOXIC), [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'checkbox',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>是否服药:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <?= $form->field($model, 'use_medicine')->radioList(\app\models\Cases::$has, [
                                    'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                    'itemOptions' => [
                                        'style' => [
                                            '-webkit-appearance' => 'radio',
                                            'width' => 'auto',
                                            'height' => 'auto',
                                        ]
                                    ]
                                ])->label(false); ?>
                            </div>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>服用的药物:</td>
                        <td>
                            <?= $form->field($model, 'medicine')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>过敏史:</td>
                        <td>
                            <?= $form->field($model, 'allergy')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>看话能力:</td>
                        <td>
                            <?= $form->field($model, 'kan_hua')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>智力情况:</td>
                        <td>
                            <?= $form->field($model, 'intelligent')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>心理情况:</td>
                        <td>
                            <?= $form->field($model, 'mental')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                    <tr>
                        <td>备注:</td>
                        <td>
                            <?= $form->field($model, 'remark')->label(false); ?>
                            <p><font> </font></p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>耳科检查</h1>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: center;">左耳</td>
                        <td style="text-align: center;">右耳</td>
                    </tr>
                    <tr>
                        <td>耳廓</td>
                        <td>
                            <?= $form->field($model, 'left_er_kuo')->radioList(\app\models\Cases::$erKuo, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'right_er_kuo')->radioList(\app\models\Cases::$erKuo, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>耳道</td>
                        <td>
                            <?= $form->field($model, 'left_er_dao')->radioList(\app\models\Cases::$erDao, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'right_er_dao')->radioList(\app\models\Cases::$erDao, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>骨膜</td>
                        <td>
                            <?= $form->field($model, 'left_gu_mo')->radioList(\app\models\Cases::$guMo, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '10px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'right_gu_mo')->radioList(\app\models\Cases::$guMo, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '10px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>乳突</td>
                        <td>
                            <?= $form->field($model, 'left_ru_tu')->radioList(\app\models\Cases::$ruTu, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'right_ru_tu')->radioList(\app\models\Cases::$erKuo, [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'radio',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'margin-left' => '20px',
                                    ]
                                ]
                            ])->label(false); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>鼓室图</h1>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: center;">左耳</td>
                        <td style="text-align: center;">右耳</td>
                    </tr>
                    <tr>
                        <td>纯音</td>
                        <td>
                            <?= $form->field($model, 'chun_yin_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'chun_yin_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>SA</td>
                        <td>
                            <?= $form->field($model, 'sa_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'sa_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>TPP</td>
                        <td>
                            <?= $form->field($model, 'tpp_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'tpp_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>类型</td>
                        <td>
                            <?= $form->field($model, 'gushi_type_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'gushi_type_right')->label(false); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>言语识别</h1>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: center;">左耳</td>
                        <td style="text-align: center;">右耳</td>
                    </tr>
                    <tr>
                        <td>测试响度</td>
                        <td>
                            <?= $form->field($model, 'ceshi_qiangdu_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'ceshi_qiangdu_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>百分比</td>
                        <td>
                            <?= $form->field($model, 'shibie_rate_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'shibie_rate_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>信噪比</td>
                        <td>
                            <?= $form->field($model, 'xinzao_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'xinzao_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>词表</td>
                        <td>
                            <?= $form->field($model, 'cibiao_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'cibiao_right')->label(false); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>试听</h1>
                <table>
                    <tr>
                        <td>机型一</td>
                        <td>
                            <?= $form->field($model, 'jixing1_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'jixing1_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>试听效果</td>
                        <td>
                            <?= $form->field($model, 'xiaoguo1_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'xiaoguo1_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td>
                            <?= $form->field($model, 'remark1_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'remark1_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>机型二</td>
                        <td>
                            <?= $form->field($model, 'jixing2_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'jixing2_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>试听效果</td>
                        <td>
                            <?= $form->field($model, 'xiaoguo2_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'xiaoguo2_right')->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td>
                            <?= $form->field($model, 'remark2_left')->label(false); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'remark2_right')->label(false); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="doctor-details-introduction">
                <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>纯音测听</h1>
                <table>
                    <tr>
                        <td>左耳</td>
                        <td>
                            <?= $form->field($model, 'left_ce_tingFile')->fileInput()->label(false); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>右耳</td>
                        <td>
                            <?= $form->field($model, 'right_ce_tingFile')->fileInput()->label(false); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <table>
                <tr>
                    <td></td>
                    <td><input type="submit" value="确定"></td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>