<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午4:41
 */

use yii\widgets\ActiveForm;

?>

<div class="Re-big-box" xmlns="http://www.w3.org/1999/html">
    <!--    <form action="/m/case/new--><? //= !empty($id) ? '/' . $id : '' ?><!--" method="post" id="new"></form>-->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>病历类型</span>
                </h1>
                <div class="product-point-con clearfix">

                    <div class="clearfix">
                        <?php foreach (\app\models\Cases::$types as $id => $value): ?>
                            <label><input type="radio" name="Cases[type]" value="<?= $id ?>"
                                          class="radio-c" <?php if ($model->type == $id) echo "checked" ?>
                                          onclick="window.location.href='?type='+this.value">
                                <?= $value ?>
                            </label>
                            &nbsp;
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>


        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>基本信息</span>
                </h1>
                <div class="product-point-con clearfix">

                    <div class="clearfix">
                        <b>姓名</b>
                        <?= \yii\helpers\Html::textInput('Cases[name]', $model->name, ['style' => 'border: 1px solid']); ?>
                        &nbsp;&nbsp;
                        <b>姓别</b>
                        <?= \yii\helpers\Html::dropDownList('Cases[gender]', $model->gender, \app\models\User::$genderLabel); ?>
                        &nbsp;&nbsp;
                        <b>年龄</b>
                        <?= \yii\helpers\Html::textInput('Cases[age]', $model->age, ['style' => 'border: 1px solid; width: 50px']); ?>
                    </div>

                    <div class="clearfix">&nbsp;</div>

                    <div class="clearfix">
                        <b>现居住地</b>
                        <?= \yii\helpers\Html::textInput('Cases[address]', $model->address, ['style' => 'border: 1px solid; width: 80%']); ?>
                    </div>

                    <div class="clearfix">&nbsp;</div>

                    <?php if ($type == 1): ?>
                        <div class="clearfix">
                            <b>家属姓名及联系方式</b>
                            <?= \yii\helpers\Html::textInput('Cases[relation_contact]', $model->relation_contact, ['style' => 'border: 1px solid; width: 60%']); ?>
                        </div>
                    <?php else: ?>
                        <div class="clearfix">
                            <b>父亲姓名</b>
                            <?= \yii\helpers\Html::textInput('Cases[father_name]', $model->father_name, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>父亲年龄</b>
                            <?= \yii\helpers\Html::textInput('Cases[father_age]', $model->father_age, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>父亲职业</b>
                            <?= \yii\helpers\Html::textInput('Cases[father_occupation]', $model->father_occupation, ['style' => 'border: 1px solid; width: 50px']); ?>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">
                            <b>父亲文化程度</b>
                            <?= \yii\helpers\Html::textInput('Cases[father_edu]', $model->father_edu, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>父亲听力情况</b>
                            <?= \yii\helpers\Html::textInput('Cases[father_hear]', $model->father_hear, ['style' => 'border: 1px solid; width: 100px']); ?>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">
                            <b>母亲姓名</b>
                            <?= \yii\helpers\Html::textInput('Cases[mother_name]', $model->mother_name, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>母亲年龄</b>
                            <?= \yii\helpers\Html::textInput('Cases[mother_age]', $model->mother_age, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>母亲职业</b>
                            <?= \yii\helpers\Html::textInput('Cases[mother_occupation]', $model->mother_occupation, ['style' => 'border: 1px solid; width: 50px']); ?>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="clearfix">
                            <b>母亲文化程度</b>
                            <?= \yii\helpers\Html::textInput('Cases[mother_edu]', $model->mother_edu, ['style' => 'border: 1px solid; width: 50px']); ?>
                            <b>母亲听力情况</b>
                            <?= \yii\helpers\Html::textInput('Cases[mother_hear]', $model->mother_hear, ['style' => 'border: 1px solid; width: 100px']); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>


        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>耳聋史</span>
                </h1>
                <div class="product-point-con clearfix">

                    <?php if ($type == 2): ?>
                        <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>幼时耳聋情况</b>
                            <select name="Cases[deaf_status]">
                            <?php foreach (\app\models\Cases::$deaf_statuses as $id => $value): ?>
                                &nbsp;
                                <option
                                    value="<?= $id ?>" <?php if ($model->deaf_status == $id) echo "selected" ?>><?= $value ?></option>
                            <?php endforeach; ?>
                                </select>
                        </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>
                    <?php endif; ?>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>耳聋时间:</b>
                            <?= \yii\helpers\Html::textInput('Cases[deaf_date]', $model->deaf_date); ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>受损耳</b>
                            <?php foreach (\app\models\Cases::$earSide as $id => $value): ?>
                                <label><input type="radio" name="Cases[deaf_side]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->deaf_side == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-con clearfix">
                        <div class="clearfix">
                            <span>对何种声音可以听见</span>
                            <span class="clearfix" id="can_listen_container">
                    <?php foreach (\app\models\Cases::$canHear as $id => $name): ?>
                        <b id="<?= $id ?>"
                           onclick="check_data('can_listen', this.id)" <?php if (in_array($id, $model->canHears)) echo 'class="active"'; ?>><?= $name ?></b>
                    <?php endforeach; ?>
                </span>
                        </div>
                    </div>
                    <input type="hidden" name="Cases[can_listen]" id="can_listen" value="<?= $model->can_listen ?>">

                    <div class="apply-con clearfix">
                        <div class="clearfix">
                            <span>交流困难的情况</span>
                            <span class="clearfix" id="hard_case_container">
                    <?php foreach (\app\models\Cases::$hardCase as $id => $name): ?>
                        <b id="<?= $id ?>"
                           onclick="check_data('hard_case', this.id)" <?php if (in_array($id, $model->hardCases)) echo 'class="active"'; ?>><?= $name ?></b>
                    <?php endforeach; ?>
                </span>
                        </div>
                    </div>
                    <input type="hidden" name="Cases[hard_case]" id="hard_case" value="<?= $model->hard_case ?>">

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>诊断结果</b>
                <input type="text" placeholder="曾去何地诊治及诊断结果" name="Cases[treat_result]"
                       value="<?= $model->treat_result ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>是否佩戴过助听器</b>
                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                    <label><input type="radio" name="Cases[weared]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->weared == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>佩戴边</b>
                <?php foreach (\app\models\Cases::$earSide as $id => $value): ?>
                    <label><input type="radio" name="Cases[weared_side]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->weared_side == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>助听器类型</b>
                <?php foreach (\app\models\Cases::$aidType as $id => $value): ?>
                    <label><input type="radio" name="Cases[aid_type]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->aid_type == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>左耳型号</b>
                <input type="text" placeholder="左耳佩戴助听器型号" name="Cases[left_type]" value="<?= $model->left_type ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>右耳型号</b>
                <input type="text" placeholder="右耳佩戴助听器型号" name="Cases[right_type]" value="<?= $model->right_type ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>佩戴效果</b>
                <?php foreach (\app\models\Cases::$effects as $id => $value): ?>
                    <label><input type="radio" name="Cases[effect]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->effect == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <?php if ($type == 2): ?>
                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>进入语言训练机构</b>
                                <input type="text" placeholder="语言训练机构" name="Cases[school]"
                                       value="<?= $model->school ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>家庭训练情况</b>
                                <?php foreach (\app\models\Cases::$home_trains as $id => $value): ?>
                                    <label><input type="radio" name="Cases[home_train]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->home_train == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>
                    <?php endif; ?>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>耳鸣情况</b>
                <?php foreach (\app\models\Cases::$earSide as $id => $value): ?>
                    <label><input type="radio" name="Cases[er_ming]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->er_ming == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>眩晕情况</b>
                            <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                <label><input type="radio" name="Cases[xuan_yun]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->xuan_yun == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>耳痛情况</b>
                            <?php foreach (\app\models\Cases::$earSide as $id => $value): ?>
                                <label><input type="radio" name="Cases[er_tong]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->er_tong == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>耳分泌物情况</b>
                            <?php foreach (\app\models\Cases::$earSide as $id => $value): ?>
                                <label><input type="radio" name="Cases[fen_mi_wu]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->fen_mi_wu == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>耳部手术史情况</b>
                            <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                <label><input type="radio" name="Cases[operation_history]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->operation_history == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>噪音暴露</b>
                            <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                <label><input type="radio" name="Cases[zao_yin]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->zao_yin == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>头部外伤史</b>
                            <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                <label><input type="radio" name="Cases[wai_shang]" value="<?= $id ?>"
                                              class="radio-c" <?php if ($model->wai_shang == $id) echo "checked" ?>><?= $value ?></label>
                                &nbsp;
                            <?php endforeach; ?>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                </div>
            </div>
        </div>

        <div class="apply-text clearfix">
            <span class="clearfix">
                <b>家族病史</b>
                <input type="text" placeholder="家族病史" name="Cases[family_history]"
                       value="<?= $model->family_history ?>"/>
            </span>
            <!--            <strong class="">错误</strong>-->
        </div>

        <?php if ($type == 2): ?>
            <div class="product-function-point">
                <div class="clearfix">
                    <h1 class="clearfix">
                        <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                        <span>出生史</span>
                    </h1>
                    <div class="product-point-con clearfix">

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>母亲传染病史</b>
                                <input type="text" placeholder="母亲传染病史" name="Cases[mother_ill_history]"
                                       value="<?= $model->mother_ill_history ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-con clearfix">
                            <div class="clearfix">
                                <span>母亲耳中毒药物史</span>
                                <span class="clearfix" id="mother_toxic_container">
                                <?php foreach (\app\models\Ill::getList(\app\models\Ill::TYPE_TOXIC) as $id => $name): ?>
                                    <b id="<?= $id ?>"
                                       onclick="check_data('mother_toxic', this.id)" <?php if (in_array($id, $model->mother_toxics)) echo 'class="active"'; ?>><?= $name ?></b>
                                <?php endforeach; ?>
                            </span>
                            </div>
                        </div>
                        <input type="hidden" name="Cases[mother_toxic]" id="mother_toxic"
                               value="<?= $model->mother_toxic ?>">

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>母亲用药情况</b>
                                <input type="text" placeholder="" name="Cases[mother_medicine]"
                                       value="<?= $model->mother_medicine ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>保胎药情况</b>
                                <input type="text" placeholder="" name="Cases[baotaiyao]"
                                       value="<?= $model->baotaiyao ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>高血压情况</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[gaoxueya]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->gaoxueya == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>妊娠反应情况</b>
                                <?php foreach (\app\models\Cases::$renshen as $id => $value): ?>
                                    <label><input type="radio" name="Cases[renshenfanying]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->renshenfanying == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>妊娠外伤史</b>
                                <input type="text" placeholder="" name="Cases[renshen_hurt]"
                                       value="<?= $model->renshen_hurt ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>妊娠期其他疾病</b>
                                <input type="text" placeholder="" name="Cases[renshen_ill]"
                                       value="<?= $model->renshen_ill ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>足月顺产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[shunchan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->shunchan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>早产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[zaochan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->zaochan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>生产月份</b>
                                <input type="text" placeholder="" name="Cases[birth_month]"
                                       value="<?= $model->birth_month ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>难产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[nanchan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->nanchan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>助产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[zhuchan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->zhuchan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>引产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[yinchan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->yinchan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>剖腹产</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[paofuchan]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->paofuchan == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>生产时缺氧</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[queyang]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->queyang == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>脐带绕颈</b>
                                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                                    <label><input type="radio" name="Cases[raojing]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->raojing == $id) echo "checked" ?>><?= $value ?></label>
                                    &nbsp;
                                <?php endforeach; ?>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                        <div class="apply-text clearfix">
                            <span class="clearfix">
                                <b>孩子体重</b>
                                <input type="text" placeholder="" name="Cases[tizhong]"
                                       value="<?= $model->tizhong ?>"/>
                            </span>
                            <!--            <strong class="">错误</strong>-->
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>个人病史</span>
                </h1>
                <div class="product-point-con clearfix">

                    <div class="apply-con clearfix">
                        <div class="clearfix">
                            <span>耳聋前传染病史</span>
                            <span class="clearfix" id="ill_condition_container">
                                <?php foreach (\app\models\Ill::getList(\app\models\Ill::TYPE_ILL) as $id => $name): ?>
                                    <b id="<?= $id ?>"
                                       onclick="check_data('ill_condition', this.id)" <?php if (in_array($id, $model->ills)) echo 'class="active"'; ?>><?= $name ?></b>
                                <?php endforeach; ?>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="Cases[ill_condition]" id="ill_condition"
                           value="<?= $model->ill_condition ?>">

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>患病时情况</b>
                            <input type="text" placeholder="患病时情况" name="Cases[person_history]"
                                   value="<?= $model->person_history ?>"/>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>治疗情况</b>
                            <input type="text" placeholder="以上疾病治疗情况" name="Cases[cure_condition]"
                                   value="<?= $model->cure_condition ?>"/>
                        </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-con clearfix">
                        <div class="clearfix">
                            <span>中毒史</span>
                            <span class="clearfix" id="toxic_container">
                                <?php foreach (\app\models\Ill::getList(\app\models\Ill::TYPE_TOXIC) as $id => $name): ?>
                                    <b id="<?= $id ?>"
                                       onclick="check_data('toxic', this.id)" <?php if (in_array($id, $model->toxics)) echo 'class="active"'; ?>><?= $name ?></b>
                                <?php endforeach; ?>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="Cases[toxic]" id="toxic" value="<?= $model->toxic ?>">

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>是否服药</b>
                <?php foreach (\app\models\Cases::$has as $id => $value): ?>
                    <label><input type="radio" name="Cases[use_medicine]" value="<?= $id ?>"
                                  class="radio-c" <?php if ($model->use_medicine == $id) echo "checked" ?>><?= $value ?></label>
                    &nbsp;
                <?php endforeach; ?>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>服用的药物</b>
                <input type="text" placeholder="" name="Cases[medicine]" value="<?= $model->medicine ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>过敏史</b>
                <input type="text" placeholder="" name="Cases[allergy]" value="<?= $model->allergy ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>看话能力</b>
                <input type="text" placeholder="" name="Cases[kan_hua]" value="<?= $model->kan_hua ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>智力情况</b>
                <input type="text" placeholder="" name="Cases[intelligent]" value="<?= $model->intelligent ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>心理情况</b>
                <input type="text" placeholder="" name="Cases[mental]" value="<?= $model->mental ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                    <div class="apply-text clearfix">
            <span class="clearfix">
                <b>备注</b>
                <input type="text" placeholder="" name="Cases[remark]" value="<?= $model->remark ?>"/>
            </span>
                        <!--            <strong class="">错误</strong>-->
                    </div>

                </div>
            </div>
        </div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>耳科检查</span>
                </h1>
                <div class="product-point-con clearfix">
                    <table style="border: 1px solid; width: 100%">
                        <tr style="border: 1px solid">
                            <td class="td-t">耳别</td>
                            <td class="td-t">左耳</td>
                            <td class="td-t">右耳</td>
                        </tr>
                        <tr>
                            <td class="td-c">耳廓</td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$erKuo as $id => $value): ?>
                                    <label><input type="radio" name="Cases[left_er_kuo]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->left_er_kuo == $id) echo "checked" ?>> <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$erKuo as $id => $value): ?>
                                    <label>
                                        <input type="radio" name="Cases[right_er_kuo]" value="<?= $id ?>"
                                               class="radio-c" <?php if ($model->right_er_kuo == $id) echo "checked" ?>>
                                        <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-c">耳道</td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$erDao as $id => $value): ?>
                                    <label><input type="radio" name="Cases[left_er_dao]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->left_er_dao == $id) echo "checked" ?>> <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$erDao as $id => $value): ?>
                                    <label>
                                        <input type="radio" name="Cases[right_er_dao]" value="<?= $id ?>"
                                               class="radio-c" <?php if ($model->right_er_dao == $id) echo "checked" ?>>
                                        <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-c">骨膜</td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$guMo as $id => $value): ?>
                                    <label><input type="radio" name="Cases[left_gu_mo]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->left_gu_mo == $id) echo "checked" ?>> <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$guMo as $id => $value): ?>
                                    <label>
                                        <input type="radio" name="Cases[right_gu_mo]" value="<?= $id ?>"
                                               class="radio-c" <?php if ($model->right_gu_mo == $id) echo "checked" ?>>
                                        <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-c">乳突</td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$ruTu as $id => $value): ?>
                                    <label><input type="radio" name="Cases[left_ru_tu]" value="<?= $id ?>"
                                                  class="radio-c" <?php if ($model->left_ru_tu == $id) echo "checked" ?>> <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                            <td class="td-c">
                                <?php foreach (\app\models\Cases::$ruTu as $id => $value): ?>
                                    <label>
                                        <input type="radio" name="Cases[right_ru_tu]" value="<?= $id ?>"
                                               class="radio-c" <?php if ($model->right_ru_tu == $id) echo "checked" ?>>
                                        <?= $value ?>
                                    </label>
                                    <br/>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>鼓室图</span>
                </h1>
                <div class="product-point-con clearfix">
                    <table style="border: 1px solid; width: 100%">
                        <tr style="border: 1px solid">
                            <td class="td-t">耳别</td>
                            <td class="td-t">左耳</td>
                            <td class="td-t">右耳</td>
                        </tr>
                        <tr>
                            <td class="td-t">纯音</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[chun_yin_left]', $model->chun_yin_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                                Hz
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[chun_yin_right]', $model->chun_yin_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                                Hz
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">SA</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[sa_left]', $model->sa_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                                ml
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[sa_right]', $model->sa_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                                ml
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">TPP</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[tpp_left]', $model->tpp_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                                daPa
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[tpp_right]', $model->tpp_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                                daPa
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">类型</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[gushi_type_left]', $model->gushi_type_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[gushi_type_right]', $model->gushi_type_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>言语识别</span>
                </h1>
                <div class="product-point-con clearfix">
                    <table style="border: 1px solid; width: 100%">
                        <tr style="border: 1px solid">
                            <td class="td-t">耳别</td>
                            <td class="td-t">左耳</td>
                            <td class="td-t">右耳</td>
                        </tr>
                        <tr>
                            <td class="td-t">测试响度</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[ceshi_qiangdu_left]', $model->ceshi_qiangdu_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[ceshi_qiangdu_right]', $model->ceshi_qiangdu_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">百分比</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[shibie_rate_left]', $model->shibie_rate_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[shibie_rate_right]', $model->shibie_rate_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">信噪比</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xinzao_left]', $model->xinzao_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xinzao_right]', $model->xinzao_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">词表</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[cibiao_left]', $model->cibiao_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[cibiao_right]', $model->cibiao_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>试听</span>
                </h1>
                <div class="product-point-con clearfix">
                    <table style="border: 1px solid; width: 100%">
                        <tr style="border: 1px solid">
                            <td class="td-t">耳别</td>
                            <td class="td-t">左耳</td>
                            <td class="td-t">右耳</td>
                        </tr>
                        <tr>
                            <td class="td-t">机型一</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[jixing1_left]', $model->jixing1_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[jixing1_right]', $model->jixing1_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">试听效果</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xiaoguo1_left]', $model->xiaoguo1_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xiaoguo1_right]', $model->xiaoguo1_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">备注</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[remark1_left]', $model->remark1_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[remark1_right]', $model->remark1_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">机型二</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[jixing2_left]', $model->jixing2_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[jixing2_right]', $model->jixing2_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">试听效果</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xiaoguo2_left]', $model->xiaoguo2_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[xiaoguo2_right]', $model->xiaoguo2_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-t">备注</td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[remark2_left]', $model->remark2_left, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                            <td class="td-t">
                                <?= \yii\helpers\Html::textInput('Cases[remark2_right]', $model->remark2_right, ['style' => 'border: 1px solid; width: 80px']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="product-function-point">
            <div class="clearfix">
                <h1 class="clearfix">
                    <span><img src="/res/img/h1-left-border.png" alt=""/></span>
                    <span>纯音测听</span>
                </h1>
                <div class="product-point-con clearfix">
                    <table style="width: 100%">
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <label style="margin-bottom: 20px">左耳: </label>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <img src="" id="ceting_left" style="width: 100%" onload="myScroll.refresh();">
                                <input type="hidden" name="Cases[ceting_img_left]" id="img_left">
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <input type="button"
                                       style="-webkit-appearance: button;"
                                       value="上传"
                                       onclick="showPic('left')">
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <label style="margin-bottom: 20px">右耳: </label>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <img src="" id="ceting_right" style="width: 100%" onload="myScroll.refresh();">
                                <input type="hidden" name="Cases[ceting_img_right]" id="img_right">
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px; text-align: center;">
                                <input type="button"
                                       style="-webkit-appearance: button;"
                                       value="上传"
                                       onclick="showPic('right')">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="apply-button" style="margin-bottom: 20px">
            <a href="#" onclick="$('#w0').submit()">确定</a>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    function check_data(type, id) {
        var r = [];
        $('#' + type + '_container').children().each(function (index, obj) {
            if (obj.id == id) {
                $(obj).toggleClass('active');
            }
            if ($(obj).hasClass('active')) {
                r.push(obj.id);
            }
        });
        $('#' + type).val(r.join(','));
    }
</script>

<script>
    var side = '';
    function showPic(type) {
        side = type;
        $(".P-upload-avatar-black").css("display", "block");
        $(".P-upload-avatar").css("display", "block");
    }

    function hidePic() {
        $(".P-upload-avatar-black").css("display", "none");
        $(".P-upload-avatar").css("display", "none");
    }
</script>

<!--上传头像-->
<div class="P-upload-avatar-black"></div>
<div class="P-upload-avatar">
    <p>
        上传
        <input type="file" id="file" class="upload_icon_button" accept="image/*"/>
    </p>
    <p class="P-cancel" onclick="hidePic()">取消</p>
</div>

<link rel="stylesheet" href="/css/tailor.css?v=2">
<div id="tailor" style="display: none">
    <!--加载资源-->
    <div class="lazy_tip" id="lazy_tip"><span>1%</span><br> 载入中......</div>
    <div class="lazy_cover"></div>
    <div class="resource_lazy hide"></div>
    <div class="pic_edit">
        <div id="clipArea"></div>
        <input type="button" id="upload2" value=" 取 消 ">
        <input type="button" id="clipBtn" value="上传图片">
    </div>

    <img src="" fileName="" id="hit" style="display:none;z-index: 9">

    <script src="/js/public/jquery-2.1.0.min.js"></script>
    <script src="/js/public/sonic.js"></script>
    <script src="/js/public/comm.js"></script>
    <script src="/js/public/hammer.js"></script>
    <script src="/js/public/iscroll-zoom.js"></script>
    <script src="/js/public/jquery.photoClip.js?v=1"></script>
    <script>
        var hammer = '';
        var currentIndex = 0;

        $("#clipArea").photoClip({
            width: 330,
            height: 330,
            file: "#file",
            view: "#hit",
            ok: "#clipBtn",
            loadStart: function () {
                $(".P-cancel").triggerHandler("click");
                $("#tailor").css("display", "block");
                //console.log("照片读取中");
                $('.lazy_tip span').text('');
                $('.lazy_cover,.lazy_tip').show();
            },
            loadComplete: function () {
                //console.log("照片读取完成");
                $('.lazy_cover,.lazy_tip').hide();
            },
            clipFinish: function (dataURL) {
                if (dataURL == "") {
                    alert('图片获取错误');
                }
                $('#img_' + side).val(dataURL);
                document.getElementById('ceting_' + side).src = dataURL;
                myScroll.refresh();
                hidePic();
                $('.lazy_cover,.lazy_tip').hide();
                $("#tailor").css("display", "none");
            }
        });

        /*获取文件拓展名*/
        function getFileExt(str) {
            var d = /\.[^\.]+$/.exec(str);
            return d;
        }

        //图片上传结束
        $(function () {
            $("#upload2").click(function () {
                $("#tailor").css("display", "none");
            });
        })

    </script>
</div>
<div class="rotate" id="loading"></div>