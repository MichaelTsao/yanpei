<form method="post">
    <div class="Re-big-box">
        <div>
<!--            <div class="Mp-main-con-text">-->
<!--                <span><input type="tel" name="old_phone"  placeholder="原手机号码" maxlength="11" class="OriginalPhoneNumber required"/></span>-->
<!--                <strong class="OriginalPhoneNumberError"></strong>-->
<!--            </div>-->
            <div class="Mp-main-con-text">
                <span><input type="tel" id="phone" name="new_phone" placeholder="新手机号码" maxlength="11" class="NewPhoneNumber required"/></span>
                <strong class="NewPhoneNumberError"></strong>
            </div>
            <div class="Mp-main-Identifying-code">
                    <span>
                        <b><input type="tel" id="code" name="sms_code" placeholder="验证码" maxlength="6" class="Mp-VerificationCode required"/></b>
                        <b><input type="button" class="identifying-code-btn" value="获取验证码" onclick="sendSMS($('#phone').val(), '2', this)"/></b>
                    </span>
                <strong class="MverificationCodeError"></strong>
            </div>
        </div>
    </div>
    <div class="Mp-main-con-bot  Complete-PhoneNumber-button">
        <span><a href="#" onclick="doit()">提 交</a></span>
    </div>
</form>

<script>
    function doit(){
        $.post('/m/user/change-phone', {'phone':$('#phone').val(), 'code':$('#code').val()}, function (data) {
            if (data != 'ok') {
                alert(data);
            }else{
                window.location.href = "/m/user/info";
            }
        });
    }
</script>

<!--提交成功--弹出提示-->
<!--<div class="Suggestion-tips">-->
<!--    <p>手机号修改成功！</p>-->
<!--</div>-->