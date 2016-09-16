<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/4
 * Time: 下午7:25
 */
?>
<div class="Re-big-box">
    <div>
        <form action="" method="post" id="rf">
            <div class="Mp-main-con-text clearfix">
                        <span class="clearfix">
                            <b><img src="/res/img/phone-icon.png" alt=""/></b>
                            <input type="text" id="phone" name="phone" placeholder="请输入手机号码" maxlength="11" class="RephoneNumber requireds"/>
                        </span>
                <strong class="RephoneNumberError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-Identifying-code">
                        <span>
                            <b><input type="text" id="sms_code" name="code" placeholder="请填写验证码" maxlength="6" class="ReIdentifyingCode requireds"/></b>
                            <b><input type="button" class="identifying-code-btn" value="获取验证码" onclick="sendSMS($('#phone').val(), '1', this)"/></b>
                        </span>
                <strong class="ReIdentifyingCodeError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-con-text">
                <b class="register-icon"><img src="/res/img/password-icon.png" alt=""/></b>
                <span><input type="password" id="p1" name="password" placeholder="密码" maxlength="32" class="RepassWord requireds" /></span>
                <strong class="RepassWordError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-con-text">
                <b class="register-icon"><img src="/res/img/password-icon.png" alt=""/></b>
                <span><input type="password" id="p2" name="password2" placeholder="再输一遍密码" maxlength="32" class="RepassWord requireds" /></span>
                <strong class="RepassWordError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-con-text">
                <b class="register-icon"><img src="/res/img/name-icon.png" alt=""/></b>
                <span><input type="text" id="user_name" name="name" placeholder="名字" maxlength="32" class="RepassWord requireds" /></span>
                <strong class="RepassWordError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-con-bot">
                <a class="Re-next-step" onclick="reg()">注册</a>
            </div>
        </form>
    </div>
</div>

<script>
    function reg() {
        if ($('#p1').val() == '' || $('#p2').val() == ''){
            alert('请填写密码');
            return;
        }
        if ($('#sms_code').val() == ''){
            alert('请填写验证码');
            return;
        }
        if ($('#phone').val() == ''){
            alert('请填写手机号');
            return;
        }
        if ($('#user_name').val() == ''){
            alert('请填写名字');
            reutrn;
        }
        $('#rf').submit();
    }
</script>