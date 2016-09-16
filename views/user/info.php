<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午7:27
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>个人资料与账户设置</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>个人资料与账户设置 </li>
            </ul>
        </div>
        <div class="personal_box clearfix apply-audi_box">
            <form method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>手机号:</td>
                        <td>
                            <input type="text" name="User[phone]" placeholder="手机号" value="<?= $user->phone ?>">
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>密码:</td>
                        <td>
                            <input type="password" name="User[password]" placeholder="密码" value="">
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>姓名:</td>
                        <td>
                            <input type="text" name="User[name]" placeholder="姓名" value="<?= $user->name ?>">
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>性别:</td>
                        <td>
                            <div class="apply-audi-sex">
                                <a href="#"<?php if ($user->gender == \app\models\User::GENDER_MALE) echo 'class="sex_active"' ?>
                                   onclick="$('#gender').val(1)">男</a>
                                <a href="#"<?php if ($user->gender == \app\models\User::GENDER_FEMALE) echo 'class="sex_active"' ?>
                                   onclick="$('#gender').val(2)">女</a>
                            </div>
                            <input type="hidden" name="User[gender]" id="gender" value="<?= $user->gender ?>">
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>头像:</td>
                        <td>
                            <img src="<?= $user->icon ?>" style="border-radius: 8px;">
                            <br/>
                            <input type="file" name="User[iconFile]">
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <!--                <tr>-->
                    <!--                    <td>医院:</td>-->
                    <!--                    <td>-->
                    <!--                        <input type="text" placeholder="请填写医院">-->
                    <!--                        <p><font>错误</font></p>-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td>职称:</td>-->
                    <!--                    <td>-->
                    <!--                        <input type="text" placeholder="请填写职称">-->
                    <!--                        <p><font>错误</font></p>-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td class="apply_case">病历:</td>-->
                    <!--                    <td>-->
                    <!--                        <textarea name="" id=""  placeholder="专家简介 1998年6月毕业于河南省郑州大学。1998年10月至2002年5月工作于广东省佛山美声听觉言语技术产品有限公司，跟随听力学硕士兰明学习听力学及助听器专业知识."></textarea>-->
                    <!--                        <p><font>错误</font></p>-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <tr>
                        <td></td>
                        <td><input type="submit" value="修改"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>