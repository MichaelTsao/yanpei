<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午7:27
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>申请成为验配师</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>申请成为验配师</li>
            </ul>
        </div>
        <div class="personal_box clearfix apply-audi_box">
            <?php
            $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <table>
                <tr>
                    <td>姓名:</td>
                    <td>
                        <?= $form->field($doctor, 'name')->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>年龄:</td>
                    <td>
                        <?= $form->field($user, 'age')->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>照片:</td>
                    <td>
                        <?= $form->field($doctor, 'coverFile')->fileInput()->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>医院:</td>
                    <td>
                        <?= $form->field($doctor, 'company')->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>职称:</td>
                    <td>
                        <?= $form->field($doctor, 'title')->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>工作地:</td>
                    <td>
                        <?= $form->field($doctor, 'work_location')->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>个人简介:</td>
                    <td>
                        <?= $form->field($doctor, 'intro')->textarea()->label(false) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td>服务项目:</td>
                    <td>
                        <?= $form->field($doctor, 'services')->label(false)->checkboxList(
                            \app\models\Service::find()->select(['name', 'service_id'])
                                ->where(['status' => \app\models\Service::STATUS_ACTIVE])
                                ->indexBy('service_id')->column(),
                            [
                                'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                                'itemOptions' => [
                                    'style' => [
                                        '-webkit-appearance' => 'checkbox',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                    ]
                                ]
                            ]) ?>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="申请"></td>
                </tr>
            </table>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>

<?php if ($error = $doctor->getFirstError('uid')): ?>
    <script>
        alert("<?=$error?>");
    </script>
<?php endif; ?>
