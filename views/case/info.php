<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/27
 * Time: 下午8:20
 */

use app\models\base\Common;

?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>病历</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>病历</li>
            </ul>
        </div>
    </div>
    <div class="case-details-main">
        <div class="case-details-con">
            <dl class="clearfix">
                <dt <?= "style=\"background: url('{$info->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                <dd>
                    <h1><?= $info->user->name ?></h1>
                    <h2>
                        <span>性别：</span><span><?= \app\models\User::$genderLabel[$info->user->gender] ?></span>
                        &nbsp;&nbsp;&nbsp;
                        <span>年龄：</span><span><?= $info->user->age ?></span></h2>
                    <p>
                        <span>创建时间：</span><span><?= date('Y年m月d日', strtotime($info->ctime)); ?></span>
                        <span style="margin-left: 30px;">创建人：</span><span><?= ($info->doctor_id) ? $info->doctor->name : '本人' ?></span>
                    </p>
                    <p style="margin-top: 15px">
                        <span>类型：</span><span><?= $info->type == \app\models\Cases::TYPE_ADULT ? '成人病历' : '儿童病历' ?></span>
                    </p>
                    <?php if($can_edit):?>
                    <button onclick="window.location.href='/case/update/<?=$info->case_id?>'" class="modify-btn"/>修改</button>
                    <?php endif;?>
                </dd>
            </dl>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>基本信息</h1>
            <table>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'name') ?>: <?= $info->name ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'genderName') ?>
                        : <?= $info->genderName ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'age') ?>: <?= $info->age ?></td>
                    <?php if ($info->type == 1):?>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'relation_contact') ?>
                        : <?= $info->relation_contact ?></td>
                    <?php endif;?>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'address') ?>
                        : <?= $info->address ?></td>
                </tr>
                <?php if ($info->type == \app\models\Cases::TYPE_CHILD) :?>
                    <tr class="table-show">
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'father_name') ?>
                            : <?= $info->father_name ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'father_age') ?>
                            : <?= $info->father_age ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'father_occupation') ?>
                            : <?= $info->father_occupation ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'father_edu') ?>
                            : <?= $info->father_edu ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'father_hear') ?>
                            : <?= $info->father_hear ?></td>
                    </tr>
                    <tr class="table-show">
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'mother_name') ?>
                            : <?= $info->mother_name ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'mother_age') ?>
                            : <?= $info->mother_age ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'mother_occupation') ?>
                            : <?= $info->mother_occupation ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'mother_edu') ?>
                            : <?= $info->mother_edu ?></td>
                        <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'mother_hear') ?>
                            : <?= $info->mother_hear ?></td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>耳聋史</h1>
            <table>
                <?php if ($info->type == \app\models\Cases::TYPE_CHILD) :?>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'deaf_status') ?>
                        : <?= isset(\app\models\Cases::$deaf_statuses[$info->deaf_status]) ? \app\models\Cases::$deaf_statuses[$info->deaf_status] : '' ?></td>
                </tr>
                <?php endif;?>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'deaf_date') ?>
                        : <?= $info->deaf_date ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'can_listen') ?>
                        : <?= implode('、 ', $info->canHearName) ?></td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'hard_case') ?>
                        : <?= implode('、 ', $info->hardCaseName) ?></td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'treat_result') ?>
                        : <?= $info->treat_result ?></td>
                </tr>
            </table>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">&nbsp;</td>
                </tr>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'weared') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->weared) ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'weared_side') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->weared_side) ?></td>
                </tr>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'aid_type') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$aidType, $info->aid_type) ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'left_type') ?>
                        : <?= $info->left_type ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'right_type') ?>
                        : <?= $info->right_type ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'effect') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$effects, $info->effect) ?></td>
                </tr>
                <?php if ($info->type == \app\models\Cases::TYPE_CHILD) :?>
                <tr>
                    <td class="table-show" colspan="8"><?= \yii\helpers\Html::activeLabel($info, 'school') ?>
                        : <?= $info->school ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'home_train') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$home_trains, $info->home_train) ?></td>
                </tr>
                <?php endif;?>
            </table>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">&nbsp;</td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">耳聋时伴有何其他症状:</td>
                </tr>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'er_ming') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->er_ming); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'xuan_yun') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->xuan_yun); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'er_tong') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->er_tong); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'fen_mi_wu') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$earSide, $info->fen_mi_wu); ?></td>
                </tr>
                <tr class="table-show">
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'operation_history') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->operation_history); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'zao_yin') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->zao_yin); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'wai_shang') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->wai_shang); ?></td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>家族史</h1>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'family_history') ?>
                        : <?= $info->family_history; ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($info->type == \app\models\Cases::TYPE_CHILD) :?>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>出生史</h1>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'mother_ill_history') ?>
                        : <?= $info->mother_ill_history; ?>
                    </td>
                </tr>
                <tr>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'mother_toxic') ?>
                        : <?= implode('、', $info->motherToxicName); ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'baotaiyao') ?>
                        : <?= $info->baotaiyao; ?>
                    </td>
                </tr>
                <tr>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'gaoxueya') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->gaoxueya); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'renshenfanying') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$renshen, $info->renshenfanying); ?></td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'renshen_hurt') ?>
                        : <?= $info->renshen_hurt; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'renshen_ill') ?>
                        : <?= $info->renshen_ill; ?>
                    </td>
                </tr>
                <tr>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'shunchan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->shunchan); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'zaochan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$renshen, $info->zaochan); ?></td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'birth_month') ?>
                        : <?= $info->birth_month; ?>
                    </td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'nanchan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->nanchan); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'zhuchan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->zhuchan); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'yinchan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->yinchan); ?></td>
                </tr>
                <tr>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'paofuchan') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->paofuchan); ?></td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'queyang') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->queyang); ?></td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'tizhong') ?>
                        : <?= $info->tizhong; ?>
                    </td>
                    <td class="table-show"><?= \yii\helpers\Html::activeLabel($info, 'raojing') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->raojing); ?></td>
                </tr>
            </table>
        </div>
        <?php endif;?>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>个人史</h1>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'person_history') ?>
                        : <?= $info->person_history; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'ills') ?>
                        : <?= implode('、', $info->illName); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'cure_condition') ?>
                        : <?= $info->cure_condition; ?>
                    </td>
                </tr>
            </table>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'toxics') ?>
                        : <?= implode('、', $info->toxicName); ?>

                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'use_medicine') ?>
                        : <?= Common::showArrayValue(\app\models\Cases::$has, $info->use_medicine); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'medicine') ?>
                        : <?= $info->medicine; ?>
                    </td>
                </tr>
            </table>
            <table>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'allergy') ?>
                        : <?= $info->allergy; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'kan_hua') ?>
                        : <?= $info->kan_hua; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'intelligent') ?>
                        : <?= $info->intelligent; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'mental') ?>
                        : <?= $info->mental; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        <?= \yii\helpers\Html::activeLabel($info, 'remark') ?>
                        : <?= $info->remark; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>耳科检查</h1>
            <table>
                <tr class="table-show" style="border-bottom: solid 1px; margin-bottom: 5px;">
                    <td class="table-show" colspan="8">
                        耳别
                    </td>
                    <td class="table-show" colspan="8">
                        左耳
                    </td>
                    <td class="table-show" colspan="8">
                        右耳
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        耳廓
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$erKuo, $info->left_er_kuo); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$erKuo, $info->right_er_kuo); ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        耳道
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$erDao, $info->left_er_dao); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$erDao, $info->right_er_dao); ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        骨膜
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$guMo, $info->left_gu_mo); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$guMo, $info->right_gu_mo); ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        乳突
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$ruTu, $info->left_ru_tu); ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= Common::showArrayValue(\app\models\Cases::$ruTu, $info->right_ru_tu); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>鼓室图</h1>
            <table>
                <tr class="table-show" style="border-bottom: solid 1px; margin-bottom: 5px;">
                    <td class="table-show" colspan="8">
                        耳别
                    </td>
                    <td class="table-show" colspan="8">
                        左耳
                    </td>
                    <td class="table-show" colspan="8">
                        右耳
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        纯音
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->chun_yin_left; ?> Hz
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->chun_yin_right; ?> Hz
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        SA
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->sa_left; ?> ml
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->sa_right; ?> ml
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        TPP
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->tpp_left; ?> daPa
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->tpp_right; ?> daPa
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        类型
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->gushi_type_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->gushi_type_right; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>纯音测听</h1>
            <table>
                <tr class="table-show">
                    <td class="table-show" style="width: 50%; text-align: center;">
                        左耳
                    </td>
                    <td class="table-show" style="width: 50%; text-align: center;">
                        右耳
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" style="width: 50%">
                        <?php if ($info->left_ce_ting): ?>
                            <img style="width: 100%;border-radius:5px;" src="<?= $info->left_ce_ting; ?>">
                        <?php else: ?>
                            未设置
                        <?php endif; ?>
                    </td>
                    <td class="table-show" style="width: 50%">
                        <?php if ($info->right_ce_ting): ?>
                            <img style="width: 100%;border-radius:5px;" src="<?= $info->right_ce_ting; ?>">
                        <?php else: ?>
                            未设置
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>言语识别</h1>
            <table>
                <tr class="table-show" style="border-bottom: solid 1px; margin-bottom: 5px;">
                    <td class="table-show" colspan="8">
                        耳别
                    </td>
                    <td class="table-show" colspan="8">
                        左耳
                    </td>
                    <td class="table-show" colspan="8">
                        右耳
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        测试响度
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->ceshi_qiangdu_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->ceshi_qiangdu_left; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        百分比
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->shibie_rate_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->shibie_rate_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        信噪比
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xinzao_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xinzao_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        词表
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->cibiao_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->cibiao_right; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>试听</h1>
            <table>
                <tr class="table-show" style="border-bottom: solid 1px; margin-bottom: 5px;">
                    <td class="table-show" colspan="8">
                        耳别
                    </td>
                    <td class="table-show" colspan="8">
                        左耳
                    </td>
                    <td class="table-show" colspan="8">
                        右耳
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        机型一
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->jixing1_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->jixing1_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        试听效果
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xiaoguo1_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xiaoguo1_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        备注
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->remark1_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->remark1_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        机型二
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->jixing2_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->jixing2_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        试听效果
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xiaoguo2_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->xiaoguo2_right; ?>
                    </td>
                </tr>
                <tr class="table-show">
                    <td class="table-show" colspan="8">
                        备注
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->remark2_left; ?>
                    </td>
                    <td class="table-show" colspan="8">
                        <?= $info->remark2_right; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>