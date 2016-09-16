<form method="post" id="forgetpassword">
    <div class="Re-big-box">
        <div>
            <div class="Mp-main-con-text">
                <span><input type="text" id="forgetpasswordphone" name="forgetpasswordphone" placeholder="请输入手机号"
                             maxlength="11" class="forgetpasswordphoneNumber required"/></span>
                <strong class="forgetpasswordphoneNumberError"></strong>
            </div>

            <div class="Mp-main-Identifying-code">
                    <span>
                        <b><input type="text" name="sms_code" id="sms_code" placeholder="请输入验证码" maxlength="6"
                                  class="Mp-VerificationCode required"/></b>
                        <b><input type="button" class="identifying-code-btn" value="获取验证码"
                                  onclick="sendSMS($('#forgetpasswordphone').val(), '3', this)"/></b>
                    </span>
                <strong class="MverificationCodeError"></strong>
            </div>

            <div class="Mp-main-con-text">
                <span><input type="password" id="forgetpasswordpassword" name="forgetpasswordpassword"
                             placeholder="新密码，6~32个字符" maxlength="11" class="forgetpasswordRepassWord required"/></span>
                <strong class="forgetpasswordRepassWordError"></strong>
            </div>

        </div>
    </div>
    <div class="Mp-main-con-bot">
        <a href="#" onclick="doit();">重置密码</a>
    </div>
</form>

<script>
    function doit() {
        $.post('/m/user/forget-password', {'phone':$('#forgetpasswordphone').val(),
            'sms_code':$('#sms_code').val(), 'password':$('#forgetpasswordpassword').val()}, function (data) {
            if (data != 'ok') {
                alert(data);
            }else{
                window.location.href = "/m/user/login";
            }
        });
    }
</script>
<!--提交成功--弹出提示-->
<!--<div class="Suggestion-tips">-->
<!--    <p>密码重置成功！</p>-->
<!--</div>-->