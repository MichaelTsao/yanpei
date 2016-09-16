<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午2:55
 */

use app\models\base\Common;

?>

<div class="case-details-top">
    <dl>
        <dt <?= "style=\"background: url('{$info->user->icon}')no-repeat center center; background-size: cover\"" ?>
            id="icon_"></dt>
        <dd>
            <h1><?= $info->user->name ?></h1>
            <p>
                <!--                <span>-->
                <!--                    <b>年龄：</b><b>--><?= ''//$info->user->age     ?><!--岁</b>-->
                <!--                </span>-->
                <!--                <span>-->
                <!--                    <b>性别：</b><b>-->
                <?= ''//\app\models\User::$genderLabel[$info->user->gender]     ?><!--</b>-->
                <!--                </span>-->
                <span>
                    <b>创建时间：</b><b><?= date('Y年m月d日', strtotime($info->ctime)); ?></b>
                </span>
                <br/>
                <br/>
                <span>
                    <b>创建人：</b><b><?= ($info->doctor_id) ? $info->doctor->name : '本人' ?></b>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <b>类型：</b><b><?= $info->type == \app\models\Cases::TYPE_ADULT ? '成人病历' : '儿童病历' ?></b>
                </span>
            </p>
            <?php if ($can_edit): ?>
                <input type="button" value="修改" class="modify-btn"
                       onclick="window.location.href='/m/case/update/<?= $info->case_id ?>'"/>
            <?php endif; ?>
        </dd>
    </dl>
</div>

<div class="product-function-point">
    <div class="clearfix">
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>基本信息</span>
        </h1>
        <div class="product-point-con clearfix">
            <ul class="product-point-line">
                <li>病人名字: <?= $info->name; ?></li>
                <li>性别: <?= $info->genderName; ?></li>
                <li>年龄: <?= $info->age; ?></li>
                <li>现居住地: <?= $info->address; ?></li>
                <?php if ($info->type == 1): ?>
                    <li>家属姓名及联系方式: <?= $info->relation_contact; ?></li>
                <?php else: ?>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'father_name') ?>: <?= $info->father_name; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'father_age') ?>: <?= $info->father_age; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'father_occupation') ?>
                        : <?= $info->father_occupation; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'father_edu') ?>: <?= $info->father_edu; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'father_hear') ?>: <?= $info->father_hear; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'mother_name') ?>: <?= $info->mother_name; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'mother_age') ?>: <?= $info->mother_age; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'mother_occupation') ?>
                        : <?= $info->mother_occupation; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'mother_edu') ?>: <?= $info->mother_edu; ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'mother_hear') ?>: <?= $info->mother_hear; ?></li>
                <?php endif; ?>
            </ul>
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
            <ul class="product-point-line">
                <?php if ($info->type == \app\models\Cases::TYPE_CHILD) : ?>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'deaf_status') ?>
                        : <?= isset(\app\models\Cases::$deaf_statuses[$info->deaf_status]) ? \app\models\Cases::$deaf_statuses[$info->deaf_status] : '' ?></li>
                <?php endif; ?>
                <li>发生时间: <?= $info->deaf_date; ?></li>
                <li>对何种声音可听见: <?= implode('、', $info->canHearName); ?></li>
                <li>交流困难的情形: <?= implode('、', $info->hardCaseName); ?></li>
                <li>曾去何地诊治及诊断结果: <?= $info->treat_result; ?></li>
                <li>&nbsp;</li>
                <li>是否配戴过助听器: <?= Common::showArrayValue(\app\models\Cases::$has, $info->weared); ?></li>
                <?php if ($info->weared): ?>
                    <li>配戴位置: <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->weared_side); ?></li>
                    <li>助听器类型: <?= Common::showArrayValue(\app\models\Cases::$aidType, $info->aid_type); ?></li>
                    <li>左耳型号: <?= $info->left_type; ?></li>
                    <li>右耳型号: <?= $info->right_type; ?></li>
                    <li>效果: <?= Common::showArrayValue(\app\models\Cases::$effects, $info->effect); ?></li>
                <?php endif; ?>

                <?php if ($info->type == \app\models\Cases::TYPE_CHILD) : ?>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'school') ?>: <?= $info->school ?></li>
                    <li><?= \yii\helpers\Html::activeLabel($info, 'home_train') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$home_trains, $info->home_train) ?></li>
                <?php endif; ?>

                <li>&nbsp;</li>
                <li style="font-weight: bold;">耳聋时伴有何其他症状</li>
                <li>耳鸣: <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->er_ming); ?></li>
                <li>眩晕: <?= Common::showArrayValue(\app\models\Cases::$has, $info->xuan_yun); ?></li>
                <li>耳痛: <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->er_tong); ?></li>
                <li>耳分泌物: <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->fen_mi_wu); ?></li>
                <li>耳部手术史: <?= Common::showArrayValue(\app\models\Cases::$has, $info->operation_history); ?></li>
                <li>噪音暴露: <?= Common::showArrayValue(\app\models\Cases::$has, $info->zao_yin); ?></li>
                <li>头部外伤史: <?= Common::showArrayValue(\app\models\Cases::$has, $info->wai_shang); ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="product-function-point">
    <div class="clearfix">
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>家族史</span>
        </h1>
        <div class="product-point-con clearfix">
            <ul class="product-point-line">
                <li><?= $info->family_history; ?></li>
            </ul>
        </div>
    </div>
</div>

<?php if ($info->type == \app\models\Cases::TYPE_CHILD) :?>
<div class="product-function-point">
    <div class="clearfix">
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>出生史</span>
        </h1>
        <div class="product-point-con clearfix">
            <ul class="product-point-line">
                <li><?= \yii\helpers\Html::activeLabel($info, 'mother_ill_history') ?>
                    : <?= $info->mother_ill_history; ?></li>
                <li><?= \yii\helpers\Html::activeLabel($info, 'mother_toxic') ?>
                    : <?= implode('、', $info->motherToxicName); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'baotaiyao') ?>
                    : <?= $info->baotaiyao; ?>
                </li>
                <?= \yii\helpers\Html::activeLabel($info, 'gaoxueya') ?>
                : <?= Common::showArrayValue(\app\models\Cases::$has, $info->gaoxueya); ?><li>
                </li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'renshenfanying') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$renshen, $info->renshenfanying); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'renshen_hurt') ?>
                    : <?= $info->renshen_hurt; ?>
                </li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'renshen_ill') ?>
                    : <?= $info->renshen_ill; ?>
                </li>
                <?= \yii\helpers\Html::activeLabel($info, 'shunchan') ?>
                : <?= Common::showArrayValue(\app\models\Cases::$has, $info->shunchan); ?><li>
                </li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'zaochan') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$renshen, $info->zaochan); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'birth_month') ?>
                    : <?= $info->birth_month; ?>
                </li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'nanchan') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->nanchan); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'zhuchan') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->zhuchan); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'yinchan') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->yinchan); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'paofuchan') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->paofuchan); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'queyang') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->queyang); ?></li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'tizhong') ?>
                    : <?= $info->tizhong; ?>
                </li>
                <li>
                    <?= \yii\helpers\Html::activeLabel($info, 'raojing') ?>
                    : <?= Common::showArrayValue(\app\models\Cases::$has, $info->raojing); ?></li>
            </ul>
        </div>
    </div>
</div>
<?php endif;?>

<div class="product-function-point">
    <div class="clearfix">
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>个人史</span>
        </h1>
        <div class="product-point-con clearfix">
            <ul class="product-point-line">
                <li>耳聋前传染病史: <?= $info->person_history; ?></li>
                <li>曾经患过: <?= implode('、', $info->illName); ?></li>
                <li>治疗情况: <?= $info->cure_condition; ?></li>
                <li>&nbsp;</li>
                <li>耳聋前耳中毒药物史: <?= implode('、', $info->toxicName); ?></li>
                <li>现在是否在服药: <?= Common::showArrayValue(\app\models\Cases::$has, $info->use_medicine) ?></li>
                <li>所用药物: <?= $info->medicine; ?></li>
                <li>&nbsp;</li>
                <li>药物过敏史: <?= $info->allergy; ?></li>
                <li>看话能力: <?= $info->kan_hua; ?></li>
                <li>精神智力状况: <?= $info->intelligent; ?></li>
                <li>心理状况: <?= $info->mental; ?></li>
                <li>备注: <?= $info->remark; ?></li>
            </ul>
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
                    <td class="td-t">耳廓</td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$erKuo, $info->left_er_kuo); ?>
                    </td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$erKuo, $info->right_er_kuo); ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">耳道</td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$erDao, $info->left_er_dao); ?>
                    </td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$erDao, $info->right_er_dao); ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">骨膜</td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$guMo, $info->left_gu_mo); ?>
                    </td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$guMo, $info->right_gu_mo); ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">乳突</td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$ruTu, $info->left_ru_tu); ?>
                    </td>
                    <td class="td-t">
                        <?= Common::showArrayValue(\app\models\Cases::$ruTu, $info->right_ru_tu); ?>
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
                        <?= $info->chun_yin_left; ?> Hz
                    </td>
                    <td class="td-t">
                        <?= $info->chun_yin_right; ?> Hz
                    </td>
                </tr>
                <tr>
                    <td class="td-t">SA</td>
                    <td class="td-t">
                        <?= $info->sa_left; ?> ml
                    </td>
                    <td class="td-t">
                        <?= $info->sa_right; ?> ml
                    </td>
                </tr>
                <tr>
                    <td class="td-t">TPP</td>
                    <td class="td-t">
                        <?= $info->tpp_left; ?> daPa
                    </td>
                    <td class="td-t">
                        <?= $info->tpp_right; ?> daPa
                    </td>
                </tr>
                <tr>
                    <td class="td-t">类型</td>
                    <td class="td-t">
                        <?= $info->gushi_type_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->gushi_type_right; ?>
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
            <ul class="product-point-line">
                <?php if ($info->left_ce_ting): ?>
                    <li>左耳:</li>
                    <li><img style="width: 100%;border-radius:5px;" src="<?= $info->left_ce_ting; ?>"></li>
                <?php else: ?>
                    <li>左耳: 未设置</li>
                <?php endif; ?>
                <?php if ($info->right_ce_ting): ?>
                    <li>右耳:</li>
                    <li><img style="width: 100%;border-radius:5px;" src="<?= $info->right_ce_ting; ?>"></li>
                    <?php ;
                else: ?>
                    <li>右耳: 未设置</li>
                    <?php ;endif; ?>
            </ul>
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
                        <?= $info->ceshi_qiangdu_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->ceshi_qiangdu_left; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">百分比</td>
                    <td class="td-t">
                        <?= $info->shibie_rate_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->shibie_rate_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">信噪比</td>
                    <td class="td-t">
                        <?= $info->xinzao_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->xinzao_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">词表</td>
                    <td class="td-t">
                        <?= $info->cibiao_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->cibiao_right; ?>
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
                        <?= $info->jixing1_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->jixing1_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">试听效果</td>
                    <td class="td-t">
                        <?= $info->xiaoguo1_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->xiaoguo1_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">备注</td>
                    <td class="td-t">
                        <?= $info->remark1_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->remark1_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">机型二</td>
                    <td class="td-t">
                        <?= $info->jixing2_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->jixing2_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">试听效果</td>
                    <td class="td-t">
                        <?= $info->xiaoguo2_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->xiaoguo2_right; ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-t">备注</td>
                    <td class="td-t">
                        <?= $info->remark2_left; ?>
                    </td>
                    <td class="td-t">
                        <?= $info->remark2_right; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>