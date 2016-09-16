<div class="Re-big-box">
    <div>
        <form action="/login" method="post" id="loginpage">
            <div class="Mp-main-con-text clearfix">
                <span class="clearfix">
                    <b><img src="/res/img/phone-icon.png" alt=""/></b>
                    <input type="tel" id="phonepage" name="phone" placeholder="请输入手机号码" maxlength="11" class="RephoneNumber requireds"/>
                </span>
                <strong class="RephoneNumberError" style="display: none">错误</strong>
            </div>
            <div class="Mp-main-con-text">
                <b class="register-icon"><img src="/res/img/password-icon.png" alt=""/></b>
                <span><input type="password" id="passwordpage" name="password" placeholder="密码" maxlength="32" class="RepassWord requireds"/></span>
                <strong class="RepassWordError" style="display: none">错误</strong>
                <a href="/m/user/forget-password" class="forget-password">忘记密码</a>
            </div>
            <div class="Mp-main-con-bot">
                <a href="#n" class="Re-next-step" onclick="loginpage()">登录</a>
            </div>
            <div class="Mp-main-con-bot2">
                <a href="/m/user/register">注册</a>
            </div>
        </form>
    </div>
</div>

<script>
    function loginpage() {
        $("#loginpage input.required").trigger('blur');
        var numError = $(".error").length,
            numError2 = $(".error2").length;
        if (numError) {
            return false;
        } else if (numError2) {
            return false;
        } else {
            $.post('/m/user/login?ajax=1', {phone: $("#phonepage").val(), password: $("#passwordpage").val()},
                function (data) {
                    if (data != 'ok') {
                        alert(data);
                    } else {
                        $(location).attr('href', "/m/user/info");
                        return false;
                    }
                });
        }
        return false;
    }
</script>